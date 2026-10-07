<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\UserCalendar;
use App\RemovalOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CalendarSyncController extends Controller
{
    // ---------------------------------------------------------------
    //  SETTINGS PAGE
    // ---------------------------------------------------------------

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function settingsPage()
    {
        $adminId = Auth::user()->id;
        $google = UserCalendar::where('admin_id', $adminId)->where('provider', 'google')->first();
        $microsoft = UserCalendar::where('admin_id', $adminId)->where('provider', 'microsoft')->first();

        return view('backend.pages.removal.calendar-settings', compact('google', 'microsoft'));
    }

    public function disconnect(Request $request)
    {
        $adminId = Auth::user()->id;
        $provider = $request->input('provider', 'google');

        UserCalendar::where('admin_id', $adminId)->where('provider', $provider)->delete();

        return back()->with(['msg' => ucfirst($provider) . ' Calendar disconnected.', 'type' => 'success']);
    }

    // ---------------------------------------------------------------
    //  GOOGLE OAUTH
    // ---------------------------------------------------------------

    public function redirectToGoogle()
    {
        $this->configureGoogle();

        return Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/calendar.events'])
            ->with(['access_type' => 'offline', 'prompt' => 'consent'])
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        $this->configureGoogle();

        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('admin.calendar.settings')
                ->with(['msg' => 'Google authentication failed: ' . $e->getMessage(), 'type' => 'danger']);
        }

        $adminId = Auth::user()->id;

        UserCalendar::updateOrCreate(
            ['admin_id' => $adminId, 'provider' => 'google'],
            [
                'access_token' => $googleUser->token,
                'refresh_token' => $googleUser->refreshToken ?? '',
                'expires_at' => Carbon::now()->addSeconds($googleUser->expiresIn ?? 3600),
            ]
        );

        return redirect()->route('admin.calendar.settings')
            ->with(['msg' => 'Google Calendar connected successfully!', 'type' => 'success']);
    }

    // ---------------------------------------------------------------
    //  SYNC — called from BookController after every new booking
    // ---------------------------------------------------------------

    public static function syncNewBookingToAllAdmins(RemovalOrder $order)
    {
        $connections = UserCalendar::all();

        foreach ($connections as $cal) {
            try {
                if ($cal->provider === 'google') {
                    (new self)->pushGoogleEvent($cal, $order);
                }
                // Microsoft will be added here when scaffolded
            } catch (\Exception $e) {
                Log::error("Calendar sync failed for admin {$cal->admin_id} [{$cal->provider}]: " . $e->getMessage());
            }
        }
    }

    // ---------------------------------------------------------------
    //  GOOGLE — push a single event
    // ---------------------------------------------------------------

    private function pushGoogleEvent(UserCalendar $cal, RemovalOrder $order): void
    {
        // Refresh token if it has expired
        if ($cal->expires_at && Carbon::now()->isAfter($cal->expires_at)) {
            $cal = $this->refreshGoogleToken($cal);
        }

        $brandName = get_static_option('site_en_US_title') ?: 'Express Van';
        $siteUrl = url('/');

        $dateStr = ($order->date instanceof \DateTimeInterface) ? $order->date->format('Y-m-d') : $order->date;
        $dateOnly = Carbon::parse($dateStr);
        $formattedDate = $dateOnly->format('l jS F Y');

        $startTime = Carbon::parse($dateStr . ' ' . $order->booking_time);
        $durationMinutes = floatval($order->time) * 60;
        $endTime = (clone $startTime)->addMinutes($durationMinutes);
        $timeRange = "Between " . $startTime->format('H:i') . "-" . $endTime->format('H:i');

        // Service Details
        $van = \App\RemovalTransport::find($order->van_id);
        $helper = \App\RemovalHelper::where('persons', $order->helpers)->first();
        $serviceText = ($helper ? ($helper->invoice_name ?: $helper->persons . ' Man') : ($order->helpers . ' Man'))
            . ' ' . ($van ? $van->name : '');

        // Addresses
        $places = \App\RemovalOrderPlace::where('order_trx', $order->trx)->orderBy('position')->get();
        $addressTexts = [];
        $pickup = '';
        $dropoff = '';
        foreach ($places as $index => $place) {
            $fullAddr = $place->address . ($place->city ? ', ' . $place->city : '') . ' ' . $place->postcode;
            if ($index === 0) {
                $pickup = $fullAddr;
            } elseif ($index === count($places) - 1) {
                $dropoff = $fullAddr;
            } else {
                $addressTexts[] = "*Stop " . ($index + 1) . ":* " . $fullAddr;
            }
        }

        // Overtime Calculation
        $overtimeRate = ($van ? $van->overtime_price : 0) + ($helper ? $helper->overtime_price : 0);

        $description = implode("\n", [
            $brandName,
            "",
            "#" . $order->trx,
            "",
            "Date: " . $formattedDate . " - " . $timeRange,
            "",
            "Customer Name: " . $order->name,
            "Customer Phone: " . $order->phone,
            "Customer Email: " . $order->email,
            "",
            "*Service:* " . $serviceText,
            "",
            "Pickup: " . $pickup,
            "Dropoff: " . $dropoff,
        ]);

        if (!empty($addressTexts)) {
            $description .= "\n" . implode("\n", $addressTexts);
        }

        $description .= "\n\n" . implode("\n", [
            "Booked Time: " . $order->time . " hours booking",
            "Price: " . amount_with_currency_symbol($order->total),
            "Overtime: " . amount_with_currency_symbol($overtimeRate) . " per hour",
            "",
            "View link: " . route('admin.removal.view', $order->trx),
        ]);

        $calendarId = $this->getOrCreateCalendarId($cal, $brandName);

        $eventData = [
            'summary' => $brandName,
            'description' => $description,
            'start' => [
                'dateTime' => $startTime->toRfc3339String(),
                'timeZone' => config('app.timezone', 'UTC'),
            ],
            'end' => [
                'dateTime' => $endTime->toRfc3339String(),
                'timeZone' => config('app.timezone', 'UTC'),
            ],
        ];

        Http::withToken($cal->access_token)
            ->post("https://www.googleapis.com/calendar/v3/calendars/{$calendarId}/events", $eventData);
    }

    private function getOrCreateCalendarId(UserCalendar $cal, string $brandName): string
    {
        if ($cal->calendar_id) {
            return $cal->calendar_id;
        }

        // List calendars to find one matching the brand name
        $response = Http::withToken($cal->access_token)
            ->get('https://www.googleapis.com/calendar/v3/users/me/calendarList');

        if ($response->successful()) {
            $calendars = $response->json()['items'] ?? [];
            foreach ($calendars as $item) {
                if (($item['summary'] ?? '') === $brandName) {
                    $cal->update(['calendar_id' => $item['id']]);
                    return $item['id'];
                }
            }
        }

        // Not found, create a new calendar with the brand name
        $createResponse = Http::withToken($cal->access_token)
            ->post('https://www.googleapis.com/calendar/v3/calendars', [
                'summary' => $brandName
            ]);

        if ($createResponse->successful()) {
            $newCal = $createResponse->json();
            $cal->update(['calendar_id' => $newCal['id']]);
            return $newCal['id'];
        }

        return 'primary'; // Fallback to primary if everything fails
    }

    // ---------------------------------------------------------------
    //  GOOGLE — refresh an expired token
    // ---------------------------------------------------------------

    private function refreshGoogleToken(UserCalendar $cal): UserCalendar
    {
        if (!$cal->refresh_token)
            return $cal;

        $response = Http::post('https://oauth2.googleapis.com/token', [
            'client_id' => get_static_option('google_calendar_client_id'),
            'client_secret' => get_static_option('google_calendar_client_secret'),
            'refresh_token' => $cal->refresh_token,
            'grant_type' => 'refresh_token',
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $cal->update([
                'access_token' => $data['access_token'],
                'expires_at' => Carbon::now()->addSeconds($data['expires_in']),
            ]);
            $cal->refresh();
        }

        return $cal;
    }

    // ---------------------------------------------------------------
    //  HELPER
    // ---------------------------------------------------------------

    private function configureGoogle(): void
    {
        config([
            'services.google.client_id' => get_static_option('google_calendar_client_id'),
            'services.google.client_secret' => get_static_option('google_calendar_client_secret'),
            'services.google.redirect' => route('admin.calendar.google.callback'),
        ]);
    }
}
