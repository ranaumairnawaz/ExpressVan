<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\AppointmentBooking;
use App\Course;
use App\CourseEnroll;
use App\Admin;
use App\Brand;
use App\Donation;
use App\DonationLogs;
use App\EventAttendance;
use App\EventPaymentLogs;
use App\Events;
use App\Facades\EmailTemplate;
use App\Faq;
use App\Helpers\CsvReader;
use App\Helpers\NexelitHelpers;
use App\Jobs;
use App\Language;
use App\Mail\BasicMail;
use App\Mail\ProductOrder;
use App\MediaUpload;
use App\Newsletter;
use App\Order;
use App\Products;
use App\Services;
use App\Blog;
use App\ContactInfoItem;
use App\Counterup;
use App\KeyFeatures;
use App\PricePlan;
use App\SocialIcons;
use App\TeamMember;
use App\Testimonial;
use App\Works;
use App\User;
use App\SpecialZipcode;
use App\RemovalFloor;
use App\RemovalInsurance;
use App\RemovalHelper;
use App\RemovalOrder;
use App\RemovalOrderBill;
use App\RemovalOrderPlace;
use App\RemovalParkingOption;
use App\RemovalTransport;
use App\RemovalOrderInventory;
use App\StaticOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\Process\Process;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SpecialZipcodeImport;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\RemovalLeadSource;
use Stripe\Stripe;
use Stripe\Refund;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function insuranceManage()
    {
        $insurances = RemovalInsurance::get();
        return view('backend.pages.removal.insurance')->with(['insurances' => $insurances]);
    }

    public function insuranceAdd(Request $request)
    {
        $this->validate($request, [
            'price' => 'required',
            'cover' => 'required'
        ]);


        $floor = new RemovalInsurance();
        $floor->price = $request->price;
        $floor->cover = $request->cover;
        $floor->save();
        return redirect()->back()->with(['msg' => __('Insurance Added...'), 'type' => 'success']);
    }

    public function insuranceUpdate(Request $request)
    {
        $this->validate($request, [
            'price' => 'required',
            'cover' => 'required'
        ]);


        $floor = RemovalInsurance::where('id', $request->id)->first();
        $floor->price = $request->price;
        $floor->cover = $request->cover;
        $floor->save();
        return redirect()->back()->with(['msg' => __('Insurance Updated...'), 'type' => 'success']);
    }

    public function insuranceDelete(Request $request, $id)
    {
        RemovalInsurance::where('id', $id)->delete();
        return redirect()->back()->with(['msg' => __('Insurance Deleted...'), 'type' => 'danger']);
    }

    public function zipcodeUload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new SpecialZipcodeImport, $request->file('file'));

        return back()->with('success', 'Excel file uploaded successfully.');
    }

    public function settings()
    {
        return view('backend.pages.removal.settings');
    }

    public function settingsSave(Request $request)
    {
        $settings = $request->except('_token'); // Exclude the CSRF token from the request data

        foreach ($settings as $key => $value) {

            update_static_option($key, $value); // Use the helper function to save each key-value pair

            if ($key == 'stripe_public_key') {
                $env_val['STRIPE_PUBLIC_KEY'] = $request->stripe_public_key ?: 'pk_test_51GwS1SEmGOuJLTMsIeYKFtfAT3o3Fc6IOC7wyFmmxA2FIFQ3ZigJ2z1s4ZOweKQKlhaQr1blTH9y6HR2PMjtq1Rx00vqE8LO0x';
            }
            if ($key == 'stripe_secret_key') {
                $env_val['STRIPE_SECRET_KEY'] = $request->stripe_secret_key ?: 'YOUR_STRIPE_SECRET_KEY_HERE';
            }
            if ($key == 'stripe_test_mode') {
                $env_val['STRIPE_TEST_MODE'] = $request->stripe_test_mode ? true : false;
            }
        }

        return redirect()->back()->with(['msg' => __('Settings Updated...'), 'type' => 'success']);
    }

    public function emailSettings()
    {
        return view('backend.pages.removal.email');
    }

    public function emailSettingsSave(Request $request)
    {
        $settings = $request->except('_token'); // Exclude the CSRF token from the request data

        foreach ($settings as $key => $value) {
            update_static_option($key, $value); // Use the helper function to save each key-value pair
        }

        return redirect()->back()->with(['msg' => __('Settings Updated...'), 'type' => 'success']);
    }


    public function removalOrders()
    {
        $type = "all";
        $orders = RemovalOrder::where('is_deleted', 0)->get();
        $van_types = RemovalTransport::all();
        $helpers = RemovalHelper::all();
        // Let's check if 'Services' model exists
        $all_services = \App\Services::all();
        $floors = RemovalFloor::all();
        $parkings = RemovalParkingOption::all();
        $insurances = RemovalInsurance::all();
        $lead_sources = RemovalLeadSource::all();

        return view('backend.pages.removal.index')->with([
            'orders' => $orders,
            'type' => $type,
            'van_types' => $van_types,
            'helpers' => $helpers,
            'all_services' => $all_services,
            'floors' => $floors,
            'parkings' => $parkings,
            'insurances' => $insurances,
            'lead_sources' => $lead_sources
        ]);
    }

    public function removaltypeOrders($type)
    {
        if ($type == 'recent') {
            $orders = RemovalOrder::orderBy('id', 'desc')->limit(20)->where('is_deleted', 0)->get();
        } elseif ($type == 'pending') {
            $orders = RemovalOrder::where('status', 0)->where('is_deleted', 0)->get();
        } elseif ($type == 'ongoing') {
            $orders = RemovalOrder::where('status', 1)->where('is_deleted', 0)->get();
        } elseif ($type == 'cancelled') {
            $orders = RemovalOrder::whereIn('status', [3, 4])->where('is_deleted', 0)->get();

        } elseif ($type == 'deleted') {
            $orders = RemovalOrder::where('is_deleted', 1)->get();
        } else {
            $type = "all";
            $orders = RemovalOrder::get();
        }

        $van_types = RemovalTransport::all();
        $helpers = RemovalHelper::all();
        $all_services = \App\Services::all();
        $floors = RemovalFloor::all();
        $parkings = RemovalParkingOption::all();
        $insurances = RemovalInsurance::all();
        $lead_sources = RemovalLeadSource::all();

        return view('backend.pages.removal.index', [
            'orders' => $orders,
            'type' => $type,
            'van_types' => $van_types,
            'helpers' => $helpers,
            'all_services' => $all_services,
            'floors' => $floors,
            'parkings' => $parkings,
            'insurances' => $insurances,
            'lead_sources' => $lead_sources
        ]);
    }

    public function removalCalendar()
    {
        return view('backend.pages.removal.calendar');
    }

    public function removalCalendarData(Request $request)
    {
        // Check for date filters
        $query = RemovalOrder::query();

        if ($request->has('start') && $request->has('end')) {
            $query->whereDate('date', '>=', $request->start)
                ->whereDate('date', '<=', $request->end);
        }

        $orders = $query->get();

        $events = $orders->map(function ($order) {
            // Parse the booking start time
            $datewithouttime = explode(' ', $order->date);
            $dateTimeString = $datewithouttime[0] . ' ' . $order->booking_time . ':00';
            $startDateTime = Carbon::parse($dateTimeString);

            // Calculate the end time
            $minutes = $order->time * 60;
            $endDateTime = $startDateTime->copy()->addMinutes($minutes);

            $service = Services::find($order->service_id);

            $paymentStatusOptions = ['Un Paid', 'Fully Paid', 'Deposit Paid', 'Refunded'];
            $paymentStatus = $paymentStatusOptions[$order->payment_status] ?? 'Unknown';

            // Default color options based on payment status
            // 0: Un Paid (Gray), 1: Fully Paid (Green), 2: Deposit Paid (Cyan), 3: Cancelled (Yellow)
            $colorOptions = ['#878a95', 'var(--green)', 'var(--cyan)', 'var(--yellow)'];
            $color = $colorOptions[$order->payment_status] ?? 'var(--blue)';

            // --- NEW LOGIC FOR SAME-DAY BOOKING PRIORITY ---

            // 1. Get the scheduled service date
            $serviceDate = $startDateTime->toDateString();

            // 2. Get the date the order was created (booked)
            // We assume $order->created_at is a Carbon instance from Eloquent timestamps
            $creationDate = $order->created_at->toDateString();

            // Check if the service date and the creation date are the same
            $isSameDayBooking = ($serviceDate === $creationDate);

            // Check if the order has a 'Paid' status (Fully Paid = 1 or Deposit Paid = 2)
            $isPaidStatus = ($order->payment_status == 1 || $order->payment_status == 2);

            // **Red Color Condition (Must Apply Last)**
            // Job goes RED only if it's a paid status AND it was booked on the exact same day
            if ($isPaidStatus && $isSameDayBooking) {
                $color = '#FF0000'; // High priority: Same-Day Booking
            }

            // Apply Grey color for Cancelled or Refunded jobs
            if ($order->status == 3 || $order->status == 4) {
                $color = '#878a95'; // Grey for cancelled jobs
            }

            // --- END NEW LOGIC ---

            $title = ($service->title ?? 'Unknown Service') . " - " . $paymentStatus . " - " . $order->name . ' ' . $order->phone;

            return [
                'id' => $order->id,
                'title' => $title,
                'start' => $startDateTime->format('Y-m-d H:i:s'),
                'end' => $endDateTime->format('Y-m-d H:i:s'),
                'url' => route('admin.removal.view', $order->trx),
                'backgroundColor' => $color,
                'borderColor' => $color,
                'className' => ($order->status == 3 || $order->status == 4) ? 'cancelled-job' : '',
            ];
        });

        return response()->json($events);
    }

    public function removalCalendarOrderDetails($id)
    {
        $order = RemovalOrder::find($id);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
        $service = Services::find($order->service_id);
        $locations = RemovalOrderPlace::where('order_trx', $order->trx)->get();
        $inventory = RemovalOrderInventory::where('order_trx', $order->trx)->get();

        if ($order->helpers == 0) {
            $helpers = "No Helper";
        } else {
            $helpers = getHelperDetails($order->helpers)->name;
        }

        $datewithouttime = explode(' ', $order->date);
        $dateTimeString = $datewithouttime[0] . ' ' . $order->booking_time . ':00';

        // Parse the combined date and time string into a Carbon instance
        $startDateTime = \Carbon\Carbon::parse($dateTimeString);
        $minutes = $order->time * 60;
        $endDateTime = $startDateTime->copy()->addMinutes($minutes);

        $date = $startDateTime->format('D, d M Y, H:i') . ' - ' . $endDateTime->format('H:i');

        return response()->json([
            'order' => $order,
            'inventory' => $inventory,
            'van_size' => getTransport($order->van_id)->name,
            'helpers' => $helpers,
            'locations' => $locations->map(function ($location) {
                return [
                    'address' => $location->address,
                    'city' => $location->city,
                    'zip' => $location->postcode,
                    'house' => $location->house,
                ];
            }),
            'date' => $date,
            'details_url' => route('admin.removal.view', $order->trx),
        ]);
    }

    public function updateOrder(Request $request)
    {
        $this->validate($request, [
            'overtime_hours' => 'required',
            'overtime_price' => 'required',
            'trx' => 'required',
            'title' => 'required'
        ]);

        $order = RemovalOrder::where('trx', $request->trx)->first();
        $order->remaining = $order->remaining + $request->overtime_price;
        $order->remaining_paid = 0;
        $order->save();

        return redirect()->back()->with(['msg' => __('Order Updated...'), 'type' => 'success']);
    }

    public function viewOrder($trx)
    {
        $order = RemovalOrder::where('trx', $trx)->first();
        return view('backend.pages.removal.view')->with(['order' => $order]);
    }

    public function sendPaymentReminder(Request $request, $id)
    {
        $order = RemovalOrder::findOrFail($id);
        if ($order->payment_status == 0) {
            try {
                Mail::to($order->email)->send(new BasicMail(EmailTemplate::removalOrderPaymentReminderMail($order)));
                return redirect()->back()->with(['msg' => __('Payment reminder sent successfully!'), 'type' => 'success']);
            } catch (\Exception $e) {
                return redirect()->back()->with(['msg' => __('Failed to send payment reminder: ' . $e->getMessage()), 'type' => 'danger']);
            }
        }
        return redirect()->back()->with(['msg' => __('Order is already paid.'), 'type' => 'warning']);
    }

    public function changeOrderStatus(Request $request, $trx)
    {
        $order = RemovalOrder::where('trx', $trx)->first();
        if ($request->status) {
            $order->status = $request->status;

            // Auto refund if status is "Cancelled & Refunded" (4)
            if ($order->status == 4 && $order->transaction_id) {
                $this->refundStripeOrder($order);
                $order->payment_status = 3; // Set payment status to Refunded
            }
        }
        if ($request->payment_status) {
            $order->payment_status = $request->payment_status;
        }
        $order->save();

        try {
            Mail::to($order->email)->send(new BasicMail(EmailTemplate::removalOrderStatusMail($order)));
        } catch (\Exception $e) {
            return redirect()->route('admin.removal.view', $trx)->with(NexelitHelpers::item_delete($e->getMessage()));
        }

        return redirect()->back()->with(['msg' => __('Order Updated...'), 'type' => 'success']);
    }

    private function refundStripeOrder($order)
    {
        $transaction_ids = explode(',', $order->transaction_id);
        Stripe::setApiKey(get_static_option('stripe_secret_key'));

        foreach ($transaction_ids as $id) {
            if (empty($id))
                continue;
            try {
                Refund::create([
                    'payment_intent' => $id,
                ]);
            } catch (\Exception $e) {
                Log::error("Stripe Refund Failed for Order {$order->trx}, PI: {$id}. Error: " . $e->getMessage());
            }
        }
    }

    public function removalOrderRemainingNotify($trx)
    {
        $order = RemovalOrder::where('trx', $trx)->first();
        try {
            Mail::to($order->email)->send(new BasicMail(EmailTemplate::removalRemainingNotify($order)));
            return redirect()->back()->with(['msg' => __('User notified!'), 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['msg' => __('User notifification failed!'), 'type' => 'danger']);
            //return redirect()->route('admin.removal.view',$trx)->with(NexelitHelpers::item_delete($e->getMessage()));
        }
    }

    public function removalOrderOvertimeNotify($trx)
    {
        $order = RemovalOrder::where('trx', $trx)->first();
        try {
            Mail::to($order->email)->send(new BasicMail(EmailTemplate::removalOvertimeNotify($order)));
            return redirect()->back()->with(['msg' => __('User notified!'), 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['msg' => __('User notifification failed!'), 'type' => 'danger']);
            //return redirect()->route('admin.removal.view',$trx)->with(NexelitHelpers::item_delete($e->getMessage()));
        }
    }


    public function printOrder($trx)
    {
        $order = RemovalOrder::where('trx', $trx)->first();
        return view('backend.pages.removal.print')->with(['order' => $order]);
    }

    public function removalOrderDelete(Request $request, $id)
    {
        $order = RemovalOrder::where('id', $id)->first();
        $order->is_deleted = 1;
        $order->save();
        return redirect()->back()->with(['msg' => __('Order Removed...'), 'type' => 'danger']);
    }

    public function removalOrderRecover(Request $request, $id)
    {
        $order = RemovalOrder::where('trx', $id)->first();
        $order->is_deleted = 0;
        $order->save();
        return redirect()->back()->with(['msg' => __('Order Recovered...'), 'type' => 'success']);
    }

    public function removalOrderPermanentDelete(Request $request, $id)
    {
        $order = RemovalOrder::where('id', $id)->first();
        if ($order) {
            // Delete related records
            RemovalOrderBill::where('order_trx', $order->trx)->delete();
            RemovalOrderPlace::where('order_trx', $order->trx)->delete();
            RemovalOrderInventory::where('order_trx', $order->trx)->delete();
            $order->delete();
        }
        return redirect()->back()->with(['msg' => __('Order Permanently Deleted...'), 'type' => 'danger']);
    }


    // Removal Floors Options
    public function floorsManage()
    {
        $floors = RemovalFloor::get();
        return view('backend.pages.removal.floors')->with(['floors' => $floors]);
    }

    public function floorAdd(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'simple_price' => 'required',
            'elevator_price' => 'required'
        ]);

        $floor = new RemovalFloor();
        $floor->name = $request->name;
        $floor->simple_price = $request->simple_price;
        $floor->elevator_price = $request->elevator_price;
        $floor->save();
        return redirect()->back()->with(['msg' => __('Floor Added...'), 'type' => 'success']);
    }

    public function floorUpdate(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'simple_price' => 'required',
            'elevator_price' => 'required'
        ]);

        $floor = RemovalFloor::where('id', $request->id)->first();
        $floor->name = $request->name;
        $floor->simple_price = $request->simple_price;
        $floor->elevator_price = $request->elevator_price;
        $floor->save();
        return redirect()->back()->with(['msg' => __('Floor Updated...'), 'type' => 'success']);
    }

    public function floorDelete(Request $request, $id)
    {
        RemovalFloor::where('id', $id)->delete();
        return redirect()->back()->with(['msg' => __('Floor Deleted...'), 'type' => 'danger']);
    }


    // Removal Helpers Options
    public function helpersManage()
    {
        $helpers = RemovalHelper::get();
        return view('backend.pages.removal.helpers')->with(['helpers' => $helpers]);
    }

    public function helperAdd(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'invoice_name' => 'required',
            'price' => 'required',
            'overtime_price' => 'required'
        ]);

        $floor = new RemovalHelper();
        $floor->name = $request->name;
        $floor->invoice_name = $request->invoice_name;
        $floor->price = $request->price;
        $floor->overtime_price = $request->overtime_price;
        $floor->save();
        return redirect()->back()->with(['msg' => __('Helper Added...'), 'type' => 'success']);
    }

    public function helperUpdate(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'invoice_name' => 'required',
            'price' => 'required',
            'overtime_price' => 'required'
        ]);

        $floor = RemovalHelper::where('id', $request->id)->first();
        $floor->name = $request->name;
        $floor->invoice_name = $request->invoice_name;
        $floor->price = $request->price;
        $floor->overtime_price = $request->overtime_price;
        $floor->save();
        return redirect()->back()->with(['msg' => __('Helper Updated...'), 'type' => 'success']);
    }

    public function helperDelete(Request $request, $id)
    {
        RemovalHelper::where('id', $id)->delete();
        return redirect()->back()->with(['msg' => __('Helper Deleted...'), 'type' => 'danger']);
    }


    // Removal Parking Options
    public function parkingsManage()
    {
        $parkings = RemovalParkingOption::get();
        return view('backend.pages.removal.parkings')->with(['parkings' => $parkings]);
    }

    public function parkingAdd(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required'
        ]);

        $floor = new RemovalParkingOption();
        $floor->name = $request->name;
        $floor->price = $request->price;
        $floor->save();
        return redirect()->back()->with(['msg' => __('Parking Option Added...'), 'type' => 'success']);
    }

    public function parkingUpdate(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'price' => 'required'
        ]);

        $floor = RemovalParkingOption::where('id', $request->id)->first();
        $floor->name = $request->name;
        $floor->price = $request->price;
        $floor->save();
        return redirect()->back()->with(['msg' => __('Parking Option Updated...'), 'type' => 'success']);
    }

    public function parkingDelete(Request $request, $id)
    {
        RemovalParkingOption::where('id', $id)->delete();
        return redirect()->back()->with(['msg' => __('Parking Option Deleted...'), 'type' => 'danger']);
    }


    // Removal Transports
    public function transportsManage()
    {
        $transports = RemovalTransport::get();
        return view('backend.pages.removal.transports')->with(['transports' => $transports]);
    }

    public function transportAdd(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'inside_length' => 'nullable|numeric',
            'inside_height' => 'nullable|numeric',
            'inside_width' => 'nullable|numeric',
            'outside_length' => 'nullable|numeric',
            'outside_height' => 'nullable|numeric',
            'outside_width' => 'nullable|numeric',
            'volume' => 'nullable|numeric',
            'payload' => 'required|numeric',
            'seats' => 'required|integer',
            'price' => 'required|numeric',
            'overtime_price' => 'required|numeric',
            'helpers' => 'nullable|array',
            'image' => 'nullable|string',
            'specification_images' => 'nullable',
            'specification_description' => 'nullable'
        ]);
        $transport = new RemovalTransport();
        $transport->name = $request->name;
        $transport->inside_length = $request->inside_length;
        $transport->inside_height = $request->inside_height;
        $transport->inside_width = $request->inside_width;
        $transport->outside_length = $request->outside_length;
        $transport->outside_height = $request->outside_height;
        $transport->outside_width = $request->outside_width;
        $transport->volume = $request->volume;
        $transport->payload = $request->payload;
        $transport->seats = $request->seats;
        $transport->price = $request->price;
        $transport->overtime_price = $request->overtime_price;

        if ($request->helpers) {
            $transport->helpers = json_encode($request->helpers);
        }
        if ($request->image) {
            $transport->image = $request->image;
        }
        if ($request->specification_images) {
            $transport->specification_images = $request->specification_images;
        }
        $transport->specification_description = $request->specification_description;
        $transport->save();
        return redirect()->back()->with(['msg' => __('Transport Added...'), 'type' => 'success']);
    }

    public function transportUpdate(Request $request)
    {
        // Validate the request
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'inside_length' => 'nullable|numeric',
            'inside_height' => 'nullable|numeric',
            'inside_width' => 'nullable|numeric',
            'outside_length' => 'nullable|numeric',
            'outside_height' => 'nullable|numeric',
            'outside_width' => 'nullable|numeric',
            'volume' => 'nullable|numeric',
            'payload' => 'required|numeric',
            'seats' => 'required|integer',
            'price' => 'required|numeric',
            'overtime_price' => 'required|numeric',
            'helpers' => 'nullable|array',
            'image' => 'nullable|string',
            'specification_images' => 'nullable',
            'specification_description' => 'nullable'
        ]);

        // Find the transport by ID
        $transport = RemovalTransport::findOrFail($request->id);

        // Update the transport fields
        $transport->name = $request->name;
        $transport->inside_length = $request->inside_length;
        $transport->inside_height = $request->inside_height;
        $transport->inside_width = $request->inside_width;
        $transport->outside_length = $request->outside_length;
        $transport->outside_height = $request->outside_height;
        $transport->outside_width = $request->outside_width;
        $transport->volume = $request->volume;
        $transport->payload = $request->payload;
        $transport->seats = $request->seats;
        $transport->price = $request->price;
        $transport->overtime_price = $request->overtime_price;

        // Handle helpers (if provided)
        if ($request->helpers) {
            $transport->helpers = json_encode($request->helpers);
        }

        // Handle image (if provided)
        if ($request->image) {
            $transport->image = $request->image;
        }

        // Handle specification images (if provided)
        if ($request->specification_images) {
            $transport->specification_images = $request->specification_images;
        }

        if ($request->specification_description) {
            $transport->specification_description = $request->specification_description;
        }

        // Save the updated transport
        $transport->save();

        // Redirect back with a success message
        return redirect()->back()->with([
            'msg' => __('Transport Updated Successfully!'),
            'type' => 'success'
        ]);
    }

    public function transportDelete(Request $request, $id)
    {
        RemovalTransport::where('id', $id)->delete();
        return redirect()->back()->with(['msg' => __('Transport Deleted...'), 'type' => 'danger']);
    }


    public function zipcodesManage()
    {
        $transports = SpecialZipcode::get();
        return view('backend.pages.removal.zipcodes')->with(['transports' => $transports]);
    }

    public function zipcodeBulk_action(Request $request)
    {
        SpecialZipcode::whereIn('id', $request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function zipcodeAdd(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'type' => 'required'
        ]);


        $floor = new SpecialZipcode();
        $floor->code = $request->code;
        $floor->type = $request->type;
        $floor->save();
        return redirect()->back()->with(['msg' => __('ZipCode Added...'), 'type' => 'success']);
    }

    public function zipcodeUpdate(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'type' => 'required'
        ]);


        $floor = SpecialZipcode::where('id', $request->id)->first();
        $floor->code = $request->code;
        $floor->type = $request->type;
        $floor->save();
        return redirect()->back()->with(['msg' => __('ZipCode Updated...'), 'type' => 'success']);
    }

    public function zipcodeDelete(Request $request, $id)
    {
        SpecialZipcode::where('id', $id)->delete();
        return redirect()->back()->with(['msg' => __('ZipCode Deleted...'), 'type' => 'danger']);
    }


    public function adminIndex()
    {

        $default_lang = get_default_language();

        $all_blogs = Blog::where('lang', $default_lang)->count();
        $total_admin = Admin::count();
        $total_testimonial = Testimonial::where('lang', $default_lang)->count();
        $total_team_member = TeamMember::where('lang', $default_lang)->count();
        $total_counterup = Counterup::where('lang', $default_lang)->count();
        $total_price_plan = PricePlan::where('lang', $default_lang)->count();
        $total_services = Services::where('lang', $default_lang)->count();
        $total_key_features = KeyFeatures::where('lang', $default_lang)->count();
        $total_works = Works::where('lang', $default_lang)->count();
        $total_jobs = Jobs::where('lang', $default_lang)->count();
        $total_events = Events::where('lang', $default_lang)->count();
        $total_donations = Donation::where('lang', $default_lang)->count();
        $total_products = Products::where('lang', $default_lang)->count();
        $total_Faq = Faq::where('lang', $default_lang)->count();
        $total_brand = Brand::all()->count();
        $total_product_order = \App\ProductOrder::all()->count();
        $total_donated_log = DonationLogs::where('status', 'complete')->count();
        $total_event_attendance = EventAttendance::where('status', 'complete')->count();

        $total_courses = Course::count();
        $total_courses_enroll = CourseEnroll::where('payment_status', 'complete')->count();

        $total_appointments = Appointment::count();
        $total_appointment_booking = AppointmentBooking::where('payment_status', 'complete')->count();


        //recent 5 order of product order
        $product_recent_order = \App\ProductOrder::orderBy('id', 'desc')->take(5)->get();
        $package_recent_order = Order::orderBy('id', 'desc')->take(5)->get();
        $event_attendance_recent_order = EventAttendance::orderBy('id', 'desc')->take(5)->get();
        $donation_recent = DonationLogs::orderBy('id', 'desc')->take(5)->get();

        $this->update_script_info();

        return view('backend.admin-home')->with([
            'blog_count' => $all_blogs,
            'total_admin' => $total_admin,
            'total_price_plan' => $total_price_plan,
            'total_works' => $total_works,
            'total_services' => $total_services,
            'total_jobs' => $total_jobs,
            'total_events' => $total_events,
            'total_donations' => $total_donations,
            'total_products' => $total_products,
            'total_donated_log' => $total_donated_log,
            'total_product_order' => $total_product_order,
            'total_event_attendance' => $total_event_attendance,
            'product_recent_order' => $product_recent_order,
            'package_recent_order' => $package_recent_order,
            'event_attendance_recent_order' => $event_attendance_recent_order,
            'donation_recent' => $donation_recent,
            'total_courses' => $total_courses,
            'total_courses_enroll' => $total_courses_enroll,
            'total_appointments' => $total_appointments,
            'total_appointment_booking' => $total_appointment_booking,
        ]);
    }

    private function update_script_info()
    {
        update_static_option('site_install_path', url('/'));
        update_static_option('site_admin_path', route('admin.home'));
        update_static_option('site_frontend_path', route('homepage'));
        \Illuminate\Support\Facades\Cache::forget('site_script_version');
        setEnvValue([
            'XGENIOUS_NEXELIT_VERSION' => get_static_option('site_script_version')
        ]);
        update_static_option('site_script_unique_key', getenv('XGENIOUS_API_KEY'));
    }

    public function admin_settings()
    {
        return view('auth.admin.settings');
    }

    public function admin_profile_update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'username' => 'required|string|max:191',
            'image' => 'nullable|string|max:191'
        ]);
        Admin::find(Auth::user()->id)->update(['name' => $request->name, 'email' => $request->email, 'username' => str_replace(' ', '_', $request->username), 'image' => $request->image]);

        return redirect()->back()->with(['msg' => __('Profile Update Success'), 'type' => 'success']);
    }

    public function admin_password_chagne(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = Admin::findOrFail(Auth::id());

        if (Hash::check($request->old_password, $user->password)) {

            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            return redirect()->route('admin.login')->with(['msg' => __('Password Changed Successfully'), 'type' => 'success']);
        }

        return redirect()->back()->with(['msg' => __('Somethings Going Wrong! Please Try Again or Check Your Old Password'), 'type' => 'danger']);
    }

    public function adminLogout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with(['msg' => __('You Logged Out !!'), 'type' => 'danger']);
    }

    public function admin_profile()
    {
        return view('auth.admin.edit-profile');
    }

    public function admin_password()
    {
        return view('auth.admin.change-password');
    }

    public function contact()
    {
        $all_contact_info_items = ContactInfoItem::all();
        return view('backend.pages.contact')->with([
            'all_contact_info_item' => $all_contact_info_items
        ]);
    }

    public function update_contact(Request $request)
    {
        $this->validate($request, [
            'page_title' => 'required|string|max:191',
            'get_title' => 'required|string|max:191',
            'get_description' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        update_static_option('contact_page_title', $request->page_title);
        update_static_option('contact_page_get_title', $request->get_title);
        update_static_option('contact_page_get_description', $request->get_description);
        update_static_option('contact_page_latitude', $request->latitude);
        update_static_option('contact_page_longitude', $request->longitude);

        return redirect()->back()->with(['msg' => __('Contact Page Info Update Success'), 'type' => 'success']);
    }


    public function blog_page()
    {
        $all_languages = Language::all();
        return view('backend.pages.blog')->with(['all_languages' => $all_languages]);
    }

    public function blog_page_update(Request $request)
    {
        $all_language = Language::all();
        foreach ($all_language as $lang) {
            $this->validate($request, [
                'blog_page_' . $lang->slug . '_title' => 'nullable',
                'blog_page_' . $lang->slug . '_item' => 'nullable',
                'blog_page_' . $lang->slug . '_category_widget_title' => 'nullable',
                'blog_page_' . $lang->slug . '_recent_post_widget_title' => 'nullable',
                'blog_page_' . $lang->slug . '_recent_post_widget_item' => 'nullable',
            ]);
            $fields = [
                'blog_page_' . $lang->slug . '_title',
                'blog_page_' . $lang->slug . '_item',
                'blog_page_' . $lang->slug . '_category_widget_title',
                'blog_page_' . $lang->slug . '_recent_post_widget_title',
                'blog_page_' . $lang->slug . '_recent_post_widget_item'
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
        }


        return redirect()->back()->with(['msg' => __('Blog Settings Update Success'), 'type' => 'success']);
    }


    public function home_variant()
    {
        return view('backend.pages.home.home-variant');
    }

    public function update_home_variant(Request $request)
    {
        $this->validate($request, [
            'home_page_variant' => 'required|string'
        ]);
        update_static_option('home_page_variant', $request->home_page_variant);
        return redirect()->back()->with(['msg' => __('Home Variant Settings Updated..'), 'type' => 'success']);
    }

    public function admin_set_static_option(Request $request)
    {
        $this->validate($request, [
            'static_option' => 'required|string',
            'static_option_value' => 'required|string',
        ]);
        set_static_option($request->static_option, $request->static_option_value);
        return 'ok';
    }

    public function admin_get_static_option(Request $request)
    {
        $this->validate($request, [
            'static_option' => 'required|string'
        ]);
        $data = get_static_option($request->static_option);
        return response()->json($data);
    }

    public function admin_update_static_option(Request $request)
    {
        $this->validate($request, [
            'static_option' => 'required|string',
            'static_option_value' => 'required|string',
        ]);
        update_static_option($request->static_option, $request->static_option_value);
        return 'ok';
    }

    public function navbar_settings()
    {
        return view('backend.pages.navbar-settings');
    }
    public function breadcrumb_settings()
    {
        return view('backend.pages.breadcrumb-settings');
    }

    public function update_breadcrumb_settings(Request $request)
    {
        $this->validate($request, [
            'site_breadcrumb_bg' => 'nullable'
        ]);

        $fields = [
            'site_breadcrumb_bg',
            'breadcrumb_background_overlay_color',
            'breadcrumb_title_color',
            'breadcrumb_text_color',
            'breadcrumb_text_active_color',
            'breadcrumb_padding_top',
            'breadcrumb_padding_bottom',
        ];

        foreach ($fields as $field) {
            update_static_option($field, $request->$field);
        }

        return redirect()->back()->with(NexelitHelpers::item_update());
    }

    public function update_navbar_settings(Request $request)
    {
        $this->validate($request, [
            'navbar_variant' => 'required'
        ]);
        update_static_option('navbar_variant', $request->navbar_variant);
        update_static_option('navbar_search_icon_status', $request->navbar_search_icon_status);
        return redirect()->back()->with(NexelitHelpers::item_update());
    }

    public function update_navbar_color_settings(Request $request)
    {
        $this->validate($request, [
            'navbar_background_color' => 'nullable|string|max:191',
            'navbar_text_color' => 'nullable|string|max:191',
            'navbar_text_hover_color' => 'nullable|string|max:191',
            'navbar_dropdown_background_color' => 'nullable|string|max:191',
            'navbar_dropdown_hover_text_color' => 'nullable|string|max:191',
            'navbar_dropdown_hover_background_color' => 'nullable|string|max:191',
            'topbar_button_background_hover_color' => 'nullable|string|max:191',
            'topbar_button_text_hover_color' => 'nullable|string|max:191',
            'topbar_button_text_color' => 'nullable|string|max:191',
            'topbar_button_background_color' => 'nullable|string|max:191',
            'topbar_text_hover_color' => 'nullable|string|max:191',
            'topbar_text_color' => 'nullable|string|max:191',
            'topbar_background_color' => 'nullable|string|max:191',
            'navbar_dropdown_text_color' => 'nullable|string|max:191',
            'navbar_dropdown_border_bottom_color' => 'nullable|string|max:191',
            'mega_menu_background_color' => 'nullable|string|max:191',
        ]);

        $fields = [
            'navbar_background_color',
            'navbar_text_color',
            'navbar_text_hover_color',
            'navbar_dropdown_background_color',
            'navbar_dropdown_hover_text_color',
            'navbar_dropdown_hover_background_color',
            'topbar_button_background_hover_color',
            'topbar_button_text_hover_color',
            'topbar_button_text_color',
            'topbar_button_background_color',
            'topbar_text_hover_color',
            'topbar_text_color',
            'topbar_background_color',
            'navbar_dropdown_text_color',
            'navbar_dropdown_border_bottom_color',
            'navbar_cart_background_color',
            'navbar_cart_text_color',
            'mega_menu_background_color',
            'mega_menu_text_color',
            'mega_menu_title_color',
            'mega_menu_text_hover_color',
            'mega_menu_button_background_color',
            'mega_menu_button_text_color',
            'mega_menu_button_text_hover_color',
            'mega_menu_button_background_hover_color',
            'navbar_cart_background_color',
            'topbar_info_title_color',
            'topbar_info_icon_color',
            'navbar_search_icon_status',
        ];
        foreach ($fields as $field) {
            update_static_option($field, $request->$field);
        }
        return redirect()->back()->with(NexelitHelpers::item_update());
    }

    public function footer_settings()
    {
        return view('backend.pages.footer-color-settings');
    }

    public function update_footer_settings(Request $request)
    {
        $this->validate($request, [
            'footer_widget_title_color' => 'nullable|string|max:191',
            'footer_widget_text_color' => 'nullable|string|max:191',
            'footer_widget_text_hover_color' => 'nullable|string|max:191',
            'footer_widget_icon_color' => 'nullable|string|max:191',
            'footer_copyright_area_background_color' => 'nullable|string|max:191',
            'footer_copyright_area_text_color' => 'nullable|string|max:191',
            'footer_background_color' => 'nullable|string|max:191'
        ]);

        $fields = [
            'footer_widget_title_color',
            'footer_widget_text_color',
            'footer_widget_text_hover_color',
            'footer_widget_icon_color',
            'footer_copyright_area_background_color',
            'footer_copyright_area_text_color',
            'footer_background_color',
        ];
        foreach ($fields as $field) {
            update_static_option($field, $request->$field);
        }
        return redirect()->back()->with(NexelitHelpers::item_update());
    }

    public function quickBookSave(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'pickup_address' => 'required',
            'destination_address' => 'required',
            'van_id' => 'required',
            'service_id' => 'required',
        ]);

        $order_trx = getTrx(12);

        $order = new RemovalOrder();
        $order->trx = $order_trx;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->date = $request->date;
        $order->booking_time = $request->time;
        $distance = getDistance($request->pickup_address, $request->destination_address);
        $total_time = $request->duration ?? 1;

        $transport = \App\RemovalTransport::findOrFail($request->van_id);

        $helpers_price = 0;
        $persons = 0;
        if ($request->helpers != 0) {
            $helper = \App\RemovalHelper::findOrFail($request->helpers);
            $helpers_price = $helper->price;
            $persons = $helper->persons ?? 0;
        }

        $floor_prices = 0;
        if ($request->pickup_floor) {
            $pickup_floor = \App\RemovalFloor::find($request->pickup_floor);
            if ($pickup_floor) {
                $floor_prices += ($request->pickup_elevator == 0) ? ($pickup_floor->simple_price * ($persons > 0 ? $persons : 1)) : ($pickup_floor->elevator_price * ($persons > 0 ? $persons : 1));
            }
        }
        if ($request->destination_floor) {
            $dest_floor = \App\RemovalFloor::find($request->destination_floor);
            if ($dest_floor) {
                $floor_prices += ($request->destination_elevator == 0) ? ($dest_floor->simple_price * ($persons > 0 ? $persons : 1)) : ($dest_floor->elevator_price * ($persons > 0 ? $persons : 1));
            }
        }

        $parking_prices = 0;
        if ($request->pickup_parking) {
            $parking = \App\RemovalParkingOption::find($request->pickup_parking);
            if ($parking)
                $parking_prices += $parking->price;
        }
        if ($request->destination_parking) {
            $parking = \App\RemovalParkingOption::find($request->destination_parking);
            if ($parking)
                $parking_prices += $parking->price;
        }

        $sp_charge = 0;
        $applied_sp_ids = [];
        $applied_sp_postcodes = [];

        if ($request->pickup_postcode) {
            $spcode = checkSpecialZipCode($request->pickup_postcode);
            if ($spcode) {
                $clean_postcode = strtoupper(preg_replace('/\s+/', '', $request->pickup_postcode));
                $applied_sp_ids[] = $spcode->id;
                $applied_sp_postcodes[] = $clean_postcode;
                if ($spcode->type == 1)
                    $sp_charge += get_static_option('congestion_charge');
                elseif ($spcode->type == 2)
                    $sp_charge += get_static_option('ultra_low_emission_charge');
                elseif ($spcode->type == 3)
                    $sp_charge += (get_static_option('congestion_charge') + get_static_option('ultra_low_emission_charge'));
            }
        }
        if ($request->destination_postcode) {
            $spcode = checkSpecialZipCode($request->destination_postcode);
            if ($spcode) {
                $clean_postcode = strtoupper(preg_replace('/\s+/', '', $request->destination_postcode));
                if (!in_array($spcode->id, $applied_sp_ids) && !in_array($clean_postcode, $applied_sp_postcodes)) {
                    $applied_sp_ids[] = $spcode->id;
                    $applied_sp_postcodes[] = $clean_postcode;
                    if ($spcode->type == 1)
                        $sp_charge += get_static_option('congestion_charge');
                    elseif ($spcode->type == 2)
                        $sp_charge += get_static_option('ultra_low_emission_charge');
                    elseif ($spcode->type == 3)
                        $sp_charge += (get_static_option('congestion_charge') + get_static_option('ultra_low_emission_charge'));
                }
            }
        }

        $insurance_price = 0;
        if ($request->insurance) {
            $insurance = \App\RemovalInsurance::find($request->insurance);
            if ($insurance)
                $insurance_price = $insurance->price;
        }

        $transport_price = $transport->price * $total_time;
        $helpers_total_price = $helpers_price * $total_time;
        $mileage_fee = $distance * get_static_option('per_km_price');
        $price = $transport_price + $helpers_total_price + $mileage_fee + $floor_prices + $parking_prices + $sp_charge + $insurance_price;

        $discount_amount = 0;
        $coupon_codes = [];
        if ($request->coupon) {
            $input_codes = explode(',', $request->coupon);
            $input_codes = array_map('trim', $input_codes);
            $input_codes = array_filter($input_codes);

            foreach ($input_codes as $code) {
                $coupon = \App\RemovalCoupon::where('code', $code)->where('status', 'publish')->first();
                if ($coupon) {
                    $is_valid = true;
                    if ($coupon->expire_date && \Carbon\Carbon::parse($coupon->expire_date)->isPast())
                        $is_valid = false;
                    if ($coupon->min_amount && $price < $coupon->min_amount)
                        $is_valid = false;
                    if ($coupon->total_limit && \App\RemovalCouponUsage::where('coupon_id', $coupon->id)->count() >= $coupon->total_limit)
                        $is_valid = false;

                    if ($is_valid) {
                        // Calculate discountable price based on exclusions for this specific coupon
                        $discountable_price = 0;
                        $excluded = $coupon->excluded_services ?: [];
                        if (!in_array('van', $excluded))
                            $discountable_price += $transport_price;
                        if (!in_array('helpers', $excluded))
                            $discountable_price += $helpers_total_price;
                        if (!in_array('mileage', $excluded))
                            $discountable_price += $mileage_fee;
                        if (!in_array('floors', $excluded))
                            $discountable_price += $floor_prices;
                        if (!in_array('parking', $excluded))
                            $discountable_price += $parking_prices;
                        if (!in_array('special_zones', $excluded))
                            $discountable_price += $sp_charge;
                        if (!in_array('insurance', $excluded))
                            $discountable_price += $insurance_price;

                        $this_discount = 0;
                        if ($coupon->discount_type == 'percentage') {
                            $this_discount = ($discountable_price * $coupon->discount_value) / 100;
                        } elseif ($coupon->discount_type == 'fixed') {
                            $this_discount = min($coupon->discount_value, $discountable_price);
                        } elseif ($coupon->discount_type == 'free_shipping') {
                            $this_discount = $mileage_fee;
                        }

                        $discount_amount += $this_discount;
                        $coupon_codes[] = $coupon->code;
                    }
                }
            }
            $price = max(0, $price - $discount_amount);
        }
        $coupon_code = !empty($coupon_codes) ? implode(', ', $coupon_codes) : null;

        $tax = ($price * get_static_option('booking_tax')) / 100;
        $total_price = $price + $tax;

        $order->van_id = $request->van_id;
        $order->helpers = $request->helpers ?? 0;
        $order->service_id = $request->service_id;
        $order->distance = $distance;
        $order->time = $total_time;
        $order->price = $price;
        $order->tax = $tax;
        $order->total = $total_price;
        $order->status = 0;
        $order->payment_status = 0;
        $order->passengers = 0;
        $order->insurance_id = $request->insurance ?? 0;
        $order->lead_source = $request->lead_source;
        $order->note = $request->contents_to_move;
        $order->admin_notes = $request->admin_notes;
        $order->coupon_code = $coupon_code;
        $order->coupon_discount = $discount_amount;
        $order->save();

        // Create Pickup Place
        $pickup = new RemovalOrderPlace();
        $pickup->order_trx = $order_trx;
        $pickup->position = 1;
        $pickup->address = $request->pickup_address;
        $pickup->house = $request->pickup_house ?? '';
        $pickup->floor = $request->pickup_floor ?? 0;
        $pickup->elevator = $request->pickup_elevator ?? 0;
        $pickup->parking = $request->pickup_parking ?? 0;
        $pickup->city = $request->pickup_city ?? '';
        $pickup->postcode = $request->pickup_postcode ?? '';
        $pickup->save();

        // Create Destination Place
        $dest = new RemovalOrderPlace();
        $dest->order_trx = $order_trx;
        $dest->position = 2;
        $dest->address = $request->destination_address;
        $dest->house = $request->destination_house ?? '';
        $dest->floor = $request->destination_floor ?? 0;
        $dest->elevator = $request->destination_elevator ?? 0;
        $dest->parking = $request->destination_parking ?? 0;
        $dest->city = $request->destination_city ?? '';
        $dest->postcode = $request->destination_postcode ?? '';
        $dest->save();

        if ($persons == 0) {
            $ob1_title = $transport->name . " and no helper";
        } else {
            $ob1_title = $transport->name . " " . $helper->invoice_name;
        }

        $ob1 = new RemovalOrderBill();
        $ob1->order_trx = $order_trx;
        $ob1->name = $ob1_title;
        $ob1->quantity = $total_time * 60;
        $ob1->unit = 'mins';
        $ob1->price = $transport_price + $helpers_total_price;
        $ob1->save();

        $ob2 = new RemovalOrderBill();
        $ob2->order_trx = $order_trx;
        $ob2->name = "Gas/ Mileage Charge";
        $ob2->quantity = $distance;
        $ob2->unit = 'Miles';
        $ob2->price = $mileage_fee;
        $ob2->save();

        if ($parking_prices != 0) {
            $ob4 = new RemovalOrderBill();
            $ob4->order_trx = $order_trx;
            $ob4->name = "Total Parking Charges";
            $ob4->quantity = 0;
            $ob4->unit = 0;
            $ob4->price = $parking_prices;
            $ob4->save();
        }

        if ($floor_prices != 0) {
            $ob5 = new RemovalOrderBill();
            $ob5->order_trx = $order_trx;
            $ob5->name = "Floor Charges";
            $ob5->quantity = 0;
            $ob5->unit = 0;
            $ob5->price = $floor_prices;
            $ob5->save();
        }

        if ($sp_charge != 0) {
            $ob5 = new RemovalOrderBill();
            $ob5->order_trx = $order_trx;
            $ob5->name = "Ulez & CC Charges";
            $ob5->quantity = 0;
            $ob5->unit = 0;
            $ob5->price = $sp_charge;
            $ob5->save();
        }

        if ($insurance_price != 0) {
            $ob5 = new RemovalOrderBill();
            $ob5->order_trx = $order_trx;
            $ob5->name = "Insurance Cover upto " . amount_with_currency_symbol($insurance->cover);
            $ob5->quantity = 0;
            $ob5->unit = 0;
            $ob5->price = $insurance_price;
            $ob5->save();
        }

        // Fire calendar sync to all connected admins (silently â€” errors only logged)
        try {
            \App\Http\Controllers\CalendarSyncController::syncNewBookingToAllAdmins($order);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Admin calendar sync failed: ' . $e->getMessage());
        }

        if ($request->send_email) {
            $order = RemovalOrder::where('trx', $order_trx)->first();
            Mail::to($order->email)->send(new BasicMail(EmailTemplate::removalOrderCreateMail($order)));
        }

        return redirect()->back()->with(['msg' => __('Booking created as lead!'), 'type' => 'success']);
    }

    // Removal Lead Source Options
    public function leadSourcesManage()
    {
        $lead_sources = RemovalLeadSource::get();
        return view('backend.pages.removal.lead-sources')->with(['lead_sources' => $lead_sources]);
    }

    public function leadSourceAdd(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $lead_source = new RemovalLeadSource();
        $lead_source->name = $request->name;
        $lead_source->save();
        return redirect()->back()->with(['msg' => __('Lead Source Added...'), 'type' => 'success']);
    }

    public function leadSourceUpdate(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required'
        ]);

        $lead_source = RemovalLeadSource::where('id', $request->id)->first();
        $lead_source->name = $request->name;
        $lead_source->save();
        return redirect()->back()->with(['msg' => __('Lead Source Updated...'), 'type' => 'success']);
    }

    public function leadSourceDelete(Request $request, $id)
    {
        RemovalLeadSource::where('id', $id)->delete();
        return redirect()->back()->with(['msg' => __('Lead Source Deleted...'), 'type' => 'danger']);
    }

    public function leadSourceReport()
    {
        $report_data = RemovalOrder::where('is_deleted', 0)
            ->select('lead_source', \DB::raw('SUM(total) as total_revenue'), \DB::raw('COUNT(*) as total_bookings'))
            ->groupBy('lead_source')
            ->get();

        return view('backend.pages.removal.lead-source-report')->with(['report_data' => $report_data]);
    }
}



