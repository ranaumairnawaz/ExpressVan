<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\RemovalFloor;
use App\RemovalInsurance;
use App\RemovalHelper;
use App\RemovalOrder;
use App\RemovalOrderBill;
use App\RemovalOrderPlace;
use App\RemovalParkingOption;
use App\RemovalOrderInventory;
use App\RemovalTransport;
use App\Helpers\PaymentGatewayCredential;
use App\Facades\EmailTemplate;
use App\Mail\BasicMail;
use Illuminate\Support\Facades\Mail;
use App\Helpers\NexelitHelpers;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session as LaravelSession;

class BookController extends Controller
{
    public function index(Request $request)
    {
        return view('frontend.pages.book.index')->with(['request' => $request]);
    }

    public function addressDetails(Request $request)
    {
        $locations = $request->input('location');
        $order_trx = getTrx(12);
        $service = $request->service;

        $cities = array();
        $states = array();
        $postcodes = array();
        $houseNumbers = array();

        // Replace with your API key
        $apiKey = get_static_option('google_api_key');
        $number = 0;

        foreach ($locations as $key => $location) {

            // Replace with your address
            $address = $location;

            // Prepare request URL
            $requestUrl = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&key=' . $apiKey . '&region=gb&components=country:GB';

            // Send request to Google Maps API
            $response = file_get_contents($requestUrl);

            // Parse JSON response
            $data = json_decode($response);

            // Check if request was successful
            if ($data->status === 'OK') {
                // Extract components from the first result
                $result = $data->results[0];

                // Initialize variables
                $city = '';
                $state = '';
                $postcode = '';
                $houseNumber = '';

                // Loop through address components to find required values
                foreach ($result->address_components as $component) {
                    if (in_array('locality', $component->types)) {
                        $city = $component->long_name; // Town/City
                    } elseif (in_array('sublocality', $component->types) && empty($city)) {
                        $city = $component->long_name; // Fallback for Town/City
                    } elseif (in_array('administrative_area_level_1', $component->types)) {
                        $state = $component->short_name; // State
                    } elseif (in_array('postal_code', $component->types)) {
                        $postcode = $component->long_name; // Postcode
                    } elseif (in_array('postal_code_prefix', $component->types) && empty($postcode)) {
                        $postcode = $component->long_name; // Fallback Postcode
                    } elseif (in_array('street_number', $component->types)) {
                        $houseNumber = $component->long_name; // House number
                    }
                }

                $cities[$key] = $city;
                $states[$key] = $state;
                $postcodes[$key] = $postcode;
                $houseNumbers[$key] = $houseNumber;

            } else {
                $cities[$key] = "";
                $states[$key] = "";
                $postcodes[$key] = "";
                $houseNumbers[$key] = "";
            }
            $number = $number + 1;
        }
        $floors = RemovalFloor::get();
        $transports = RemovalTransport::get();
        $helpers = RemovalHelper::get();
        $parkings = RemovalParkingOption::get();
        $insurances = RemovalInsurance::get();
        return view('frontend.pages.book.address')->with(['locations' => $locations, 'order_trx' => $order_trx, 'cities' => $cities, 'postcodes' => $postcodes, 'houseNumbers' => $houseNumbers, 'floors' => $floors, 'transports' => $transports, 'helpers' => $helpers, 'parkings' => $parkings, 'service' => $service, 'insurances' => $insurances]);
    }

    public function moreDetails(Request $request)
    {
        $this->validate($request, [
            'order_trx' => 'required',
            'service' => 'required',
            'duration' => 'required',
            'helpers' => 'required',
            'transport' => 'required',
            'location' => 'required',
            'house' => 'required',
            'floor' => 'required',
            'insurance' => 'required',
            'elevator' => 'required',
            'parking' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        $order_trx = $request->order_trx;
        $locations = $request->location;
        $floor_prices = 0;
        $parking_prices = 0;
        $total_time = $request->duration;

        if ($request->helpers != 0) {
            $helpers = RemovalHelper::where('id', $request->helpers)->first();
            $persons = $helpers->persons;
        } else {
            $persons = 0;
        }
        $number = 0;
        $sp_charge = 0;
        $applied_sp_ids = [];
        $applied_sp_postcodes = [];

        foreach ($locations as $key => $location) {
            $position = $key + 1;
            RemovalOrderPlace::updateOrCreate(
                ['order_trx' => $order_trx, 'position' => $position],
                [
                    'address' => $location,
                    'city' => $request->city[$key],
                    'postcode' => $request->postcode[$key],
                    'house' => $request->house[$key],
                    'floor' => $request->floor[$key],
                    'elevator' => $request->elevator[$key],
                    'parking' => $request->parking[$key]
                ]
            );

            $removal_floor = RemovalFloor::where('id', $request->floor[$key])->first();
            if ($request->elevator[$key] == 0) {
                $this_floor_price = $removal_floor->simple_price * ($persons > 0 ? $persons : 1);
                $floor_prices = $floor_prices + $this_floor_price;
            } else {
                $this_floor_price = $removal_floor->elevator_price * ($persons > 0 ? $persons : 1);
                $floor_prices = $floor_prices + $this_floor_price;
            }
            $parking_prices += RemovalParkingOption::where('id', $request->parking[$key])->first()->price;
            $number = $number + 1;

            $spcode = checkSpecialZipCode($request->postcode[$key]);
            if ($spcode) {
                $clean_postcode = strtoupper(preg_replace('/\s+/', '', $request->postcode[$key]));
                if (!in_array($spcode->id, $applied_sp_ids) && !in_array($clean_postcode, $applied_sp_postcodes)) {
                    $applied_sp_ids[] = $spcode->id;
                    $applied_sp_postcodes[] = $clean_postcode;
                    if ($spcode->type == 1) {
                        $sp_charge = $sp_charge + get_static_option('congestion_charge');
                    } else if ($spcode->type == 2) {
                        $sp_charge = $sp_charge + get_static_option('ultra_low_emission_charge');
                    } else if ($spcode->type == 3) {
                        $sp_charge = $sp_charge + (get_static_option('congestion_charge') + get_static_option('ultra_low_emission_charge'));
                    }
                }
            }
        }

        $transport = RemovalTransport::findOrFail($request->transport);
        if ($request->helpers != 0) {
            $helpers_price = RemovalHelper::findOrFail($request->helpers)->price;
        } else {
            $helpers_price = 0;
        }

        if ($number == 2) {
            $distance = getDistance($locations[0], $locations[1]);
        }
        if ($number == 3) {
            $distance1 = getDistance($locations[0], $locations[1]);
            $distance2 = getDistance($locations[1], $locations[2]);
            $distance = $distance1 + $distance2;
        }
        if ($number == 4) {
            $distance1 = getDistance($locations[0], $locations[1]);
            $distance2 = getDistance($locations[1], $locations[2]);
            $distance3 = getDistance($locations[2], $locations[3]);
            $distance = $distance1 + $distance2 + $distance3;
        }

        if ($request->insurance != 0) {
            $insurance = RemovalInsurance::where('id', $request->insurance)->first();
            $insurance_price = $insurance->price;
        } else {
            $insurance_price = 0;
        }
        $transport_price = $transport->price * $total_time;
        $helpers_total_price = $helpers_price * $total_time;
        $mileage_fee = $distance * get_static_option('per_km_price');
        $price = $transport_price + $helpers_total_price + $mileage_fee + $floor_prices + $parking_prices + $sp_charge + $insurance_price;
        $tax = ($price * get_static_option('booking_tax')) / 100;
        $total_price = $price + $tax;

        return view('frontend.pages.book.confirmation')->with(['alldata' => $request, 'transport_price' => $transport_price, 'helpers_price' => $helpers_total_price, 'gas_fee' => $mileage_fee, 'floor_prices' => $floor_prices, 'parking_prices' => $parking_prices, 'price' => $price, 'tax' => $tax, 'total_price' => $total_price, 'distance' => $distance, 'inventoryInput' => $request->inventoryInput, 'inventoryQty' => $request->inventoryQty, 'sp_charge' => $sp_charge]);
    }

    public function saveOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_trx' => 'required',
            'service' => 'required',
            'duration' => 'required',
            'helpers' => 'required',
            'transport' => 'required',
            'location' => 'required',
            'house' => 'required',
            'floor' => 'required',
            'insurance' => 'required',
            'elevator' => 'required',
            'parking' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'date' => 'required',
            'time' => 'required',
            'payment_type' => 'required',
            'inventoryInput' => 'nullable',
            'inventoryQty' => 'nullable',
            'inventoryPrice' => 'nullable',
            'coupon' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(); // Preserve the old input.
        }

        $order_trx = $request->order_trx;
        $locations = $request->location;
        $floor_prices = 0;
        $parking_prices = 0;
        $total_time = $request->duration;
        $inventoryInput = $request->inventoryInput;
        $inventoryQty = $request->inventoryQty;
        $inventoryPrice = $request->inventoryPrice;

        if ($request->helpers != 0) {
            $helpers = RemovalHelper::where('id', $request->helpers)->first();
            $persons = $helpers->persons;
        } else {
            $persons = 0;
        }
        $number = 0;
        $sp_charge = 0;
        $applied_sp_ids = [];
        $applied_sp_postcodes = [];

        foreach ($locations as $key => $location) {
            $position = $key + 1;
            RemovalOrderPlace::updateOrCreate(
                ['order_trx' => $order_trx, 'position' => $position],
                [
                    'address' => $location,
                    'city' => $request->city[$key],
                    'postcode' => $request->postcode[$key],
                    'house' => $request->house[$key],
                    'floor' => $request->floor[$key],
                    'elevator' => $request->elevator[$key],
                    'parking' => $request->parking[$key],
                ]
            );

            $removal_floor = RemovalFloor::where('id', $request->floor[$key])->first();
            if ($request->elevator[$key] == 0) {
                $this_floor_price = $removal_floor->simple_price * ($persons > 0 ? $persons : 1);
                $floor_prices = $floor_prices + $this_floor_price;
            } else {
                $this_floor_price = $removal_floor->elevator_price * ($persons > 0 ? $persons : 1);
                $floor_prices = $floor_prices + $this_floor_price;
            }
            $parking_prices += RemovalParkingOption::where('id', $request->parking[$key])->first()->price;
            $number = $number + 1;

            $spcode = checkSpecialZipCode($request->postcode[$key]);
            if ($spcode) {
                $clean_postcode = strtoupper(preg_replace('/\s+/', '', $request->postcode[$key]));
                if (!in_array($spcode->id, $applied_sp_ids) && !in_array($clean_postcode, $applied_sp_postcodes)) {
                    $applied_sp_ids[] = $spcode->id;
                    $applied_sp_postcodes[] = $clean_postcode;
                    if ($spcode->type == 1) {
                        $sp_charge = $sp_charge + get_static_option('congestion_charge');
                    } else if ($spcode->type == 2) {
                        $sp_charge = $sp_charge + get_static_option('ultra_low_emission_charge');
                    } else if ($spcode->type == 3) {
                        $sp_charge = $sp_charge + (get_static_option('congestion_charge') + get_static_option('ultra_low_emission_charge'));
                    }
                }
            }
        }

        $transport = RemovalTransport::findOrFail($request->transport);
        $helpers_price = $request->helpers != 0 ? RemovalHelper::findOrFail($request->helpers)->price : 0;

        if ($number == 2) {
            $distance = getDistance($locations[0], $locations[1]);
        }
        if ($number == 3) {
            $distance1 = getDistance($locations[0], $locations[1]);
            $distance2 = getDistance($locations[1], $locations[2]);
            $distance = $distance1 + $distance2;
        }
        if ($number == 4) {
            $distance1 = getDistance($locations[0], $locations[1]);
            $distance2 = getDistance($locations[1], $locations[2]);
            $distance3 = getDistance($locations[2], $locations[3]);
            $distance = $distance1 + $distance2 + $distance3;
        }

        if ($request->insurance != 0) {
            $insurance = RemovalInsurance::where('id', $request->insurance)->first();
            $insurance_price = $insurance->price;
        } else {
            $insurance_price = 0;
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

        if (RemovalOrder::where('trx', $order_trx)->count() > 0) {
            RemovalOrder::where('trx', $order_trx)->delete();
        }
        $order = new RemovalOrder();
        $order->trx = $order_trx;
        $order->service_id = $request->service;
        $order->email = $request->email;
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->price = $price;
        $order->tax = $tax;
        $order->total = $total_price;
        $order->distance = $distance;
        $order->time = $total_time;
        $order->date = date_create($request->date);
        $order->booking_time = $request->time;
        $order->status = 0;
        $order->payment_status = 0;
        if ($persons == 0) {
            $order->helpers = 0;
        } else {
            $order->helpers = $helpers->id;
        }
        $order->passengers = $request->ride ?? 0;
        $order->note = $request->message ?? "";
        $order->van_id = $request->transport;
        $order->insurance_id = $request->insurance;
        $order->coupon_code = $coupon_code;
        $order->coupon_discount = $discount_amount;
        $order->save();

        if ($request->insurance != 0 && $inventoryInput) {
            foreach ($inventoryInput as $key => $inv) {
                $item = new RemovalOrderInventory();
                $item->order_trx = $order_trx;
                $item->item = $inv;
                $item->qty = $inventoryQty[$key];
                $item->price = $inventoryPrice[$key];
                $item->save();
            }
        }

        if ($persons == 0) {
            $ob1_title = $transport->name . " and no helper";
        } else {
            $ob1_title = $transport->name . "" . $helpers->invoice_name;
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

        // Fire calendar sync to all connected admins (silently — errors only logged)
        try {
            \App\Http\Controllers\CalendarSyncController::syncNewBookingToAllAdmins($order);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Admin calendar sync failed: ' . $e->getMessage());
        }

        return redirect()->route('frontend.book.order.checkout', [$order_trx, $request->payment_type]);

        //$this->sendOrderEmails($order_trx);

        //return redirect()->route('frontend.book.order', $order_trx);
    }


    private function sendOrderEmails($order_trx)
    {
        $order = RemovalOrder::where('trx', $order_trx)->first();
        Mail::to($order->email)->send(new BasicMail(EmailTemplate::removalOrderCreateMail($order)));
        $admin_mail = get_static_option('site_global_email');
        Mail::to($admin_mail)->send(new BasicMail(EmailTemplate::removalOrderAdminMail($order)));
    }

    public function Order($trx)
    {
        if (LaravelSession::get($trx)) {
            $order = RemovalOrder::where('trx', $trx)->first();
            if ($order && ($order->status == 4 || $order->is_deleted == 1)) {
                LaravelSession::forget($trx);
                return redirect()->route('homepage')->with(['msg' => __('Access denied for this order.'), 'type' => 'danger']);
            }
            $order_bills = RemovalOrderBill::where('order_trx', $trx)->get();
            $order_places = RemovalOrderPlace::where('order_trx', $trx)->get();
            $order_insurance = RemovalInsurance::where('id', $order->insurance_id)->first();
            return view('frontend.pages.book.invoice')->with(['order' => $order, 'order_bills' => $order_bills, 'order_places' => $order_places, 'order_insurance' => $order_insurance]);
        } else {
            return redirect()->route('frontend.book.order.otp', $trx);
        }
    }
    public function OrderOtp($trx)
    {
        $otp = rand(1000, 9999);
        $order = RemovalOrder::where('trx', $trx)->first();
        if ($order && ($order->status == 4 || $order->is_deleted == 1)) {
            return redirect()->route('homepage')->with(['msg' => __('Access denied for this order.'), 'type' => 'danger']);
        }
        $order->otp = $otp;
        $order->save();
        Mail::to($order->email)->send(new BasicMail(EmailTemplate::removalOrderOTPMail($order)));
        return view('frontend.pages.book.otp')->with(['order' => $order]);
    }

    public function OrderOtpSubmit($trx, Request $request)
    {
        $this->validate($request, [
            'otp' => 'required',
        ]);
        $user_otp = $request->otp;
        $order = RemovalOrder::where('trx', $trx)->first();
        if ($order && ($order->status == 4 || $order->is_deleted == 1)) {
            return redirect()->route('homepage')->with(['msg' => __('Access denied for this order.'), 'type' => 'danger']);
        }
        if ($user_otp == $order->otp) {
            LaravelSession::put($trx, '1');
            return redirect()->route('frontend.book.order', $trx);
        } else {
            return redirect()->back()->with(['msg' => __('Otp missmatched!'), 'type' => 'danger']);
        }
    }

    public function OrderOtpDirect($trx, $otp)
    {
        $order = RemovalOrder::where('trx', $trx)->first();

        // Check if order exists and OTP matches
        if ($order && $otp == $order->otp) {
            if ($order->status == 4 || $order->is_deleted == 1) {
                return redirect()->route('homepage')->with(['msg' => __('Access denied for this order.'), 'type' => 'danger']);
            }
            // Set the session so the Order() function allows access
            LaravelSession::put($trx, '1');

            return redirect()->route('frontend.book.order', $trx);
        } else {
            // If OTP is wrong, send them to the manual OTP input page with an error
            return redirect()->route('frontend.book.order.otp', $trx)
                ->with(['msg' => __('Invalid or expired OTP link!'), 'type' => 'danger']);
        }
    }

    public function OrderBack($trx)
    {
        LaravelSession::forget($trx);
        return redirect()->route('homepage');
    }

    public function OrderPrint($trx)
    {
        $order = RemovalOrder::where('trx', $trx)->first();
        if ($order && ($order->status == 4 || $order->is_deleted == 1)) {
            return redirect()->route('homepage')->with(['msg' => __('Access denied for this order.'), 'type' => 'danger']);
        }
        $order_bills = RemovalOrderBill::where('order_trx', $trx)->get();
        $order_places = RemovalOrderPlace::where('order_trx', $trx)->get();

        return view('frontend.pages.book.print_invoice')->with(['order' => $order, 'order_bills' => $order_bills, 'order_places' => $order_places]);
    }

    public function Checkout($trx, $status)
    {
        $order = RemovalOrder::where('trx', $trx)->first();
        if ($order && ($order->status == 4 || $order->is_deleted == 1)) {
            return redirect()->route('homepage')->with(['msg' => __('Access denied for this order.'), 'type' => 'danger']);
        }
        $order_bills = RemovalOrderBill::where('order_trx', $trx)->get();
        $order_places = RemovalOrderPlace::where('order_trx', $trx)->get();

        return view('frontend.pages.book.checkout')->with(['trx' => $trx, 'status' => $status]);

        //$params = $this->common_charge_customer_data($order,route('frontend.book.stripe.ipn',$amount),$amount);
        //$stripe = PaymentGatewayCredential::get_stripe_credential();
        //$response = $stripe->charge_customer($params);
        //return $response;
    }

    public function StripeCheckout($trx, $status)
    {

        $order = RemovalOrder::where('trx', $trx)->first();
        if ($order && ($order->status == 4 || $order->is_deleted == 1)) {
            return redirect()->route('homepage')->with(['msg' => __('Access denied for this order.'), 'type' => 'danger']);
        }

        if ($status == "full") {
            $amount = $order->total * 100;
        }
        if ($status == "advance") {
            $amount = (($order->total * 30) / 100) * 100;
        }
        if ($status == "remaining") {
            $amount = (($order->total * 70) / 100) * 100;
        }
        if ($status == "overtime") {
            $amount = $order->remaining * 100;
        }

        Stripe::setApiKey(get_static_option('stripe_secret_key'));

        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'gbp',
                            'product_data' => [
                                'name' => $status . 'payment for order#' . $trx,
                            ],
                            'unit_amount' => round($amount), // Amount in cents (10.00 USD)
                        ],
                        'quantity' => 1,
                    ]
                ],
                'mode' => 'payment',
                'success_url' => route('frontend.book.order.success', [$trx, $status]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('frontend.book.order.cancel', $trx),
            ]);

            return redirect($session->url);

            //return response()->json(['id' => $session->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function OrderSuccess($trx, $amount)
    {
        $order = RemovalOrder::where('trx', $trx)->first();
        if ($order && ($order->status == 4 || $order->is_deleted == 1)) {
            return redirect()->route('homepage')->with(['msg' => __('Access denied for this order.'), 'type' => 'danger']);
        }

        $session_id = request()->get('session_id');
        if ($session_id) {
            Stripe::setApiKey(get_static_option('stripe_secret_key'));
            try {
                $checkout_session = Session::retrieve($session_id);
                if ($checkout_session->payment_intent) {
                    $current_transaction_ids = $order->transaction_id ? explode(',', $order->transaction_id) : [];
                    if (!in_array($checkout_session->payment_intent, $current_transaction_ids)) {
                        $current_transaction_ids[] = $checkout_session->payment_intent;
                        $order->transaction_id = implode(',', $current_transaction_ids);
                    }
                }
            } catch (\Exception $e) {
                // Handle session retrieval error if necessary
            }
        }

        if ($amount == "full") {
            $order->payment_status = 1;
            $order->status = 1;
            $order->save();
            $notify = "Order Payment Successfull! _success";

        } elseif ($amount == "advance") {
            $order->payment_status = 2;
            $order->status = 1;
            $order->save();
            $notify = "Order Advance Payment Successfull! _success";
        } elseif ($amount == "remaining") {
            $order->payment_status = 1;
            $order->status = 1;
            $order->save();
            $notify = "Order Remaining Payment Successfull! _success";
        } elseif ($amount == "overtime") {
            $order->paid_overtime = $order->paid_overtime + $order->remaining;
            $order->remaining_paid = 1;
            $order->remaining = 0;
            $order->save();
            $notify = "Order Overtime Payment Successfull! _success";
        }

        // Coupon Usage Tracking
        if ($order->coupon_code && ($amount == "full" || $amount == "advance")) {
            $codes = explode(',', $order->coupon_code);
            foreach ($codes as $code) {
                $code = trim($code);
                $coupon = \App\RemovalCoupon::where('code', $code)->first();
                if ($coupon) {
                    $exists = \App\RemovalCouponUsage::where('coupon_id', $coupon->id)->where('order_trx', $order->trx)->exists();
                    if (!$exists) {
                        \App\RemovalCouponUsage::create([
                            'coupon_id' => $coupon->id,
                            'order_trx' => $order->trx,
                            'user_email' => $order->email
                        ]);
                    }
                }
            }
        }
        try {
            if ($amount == "advance" || $amount == "full") {
                $this->sendOrderEmails($trx);
            }
            Mail::to($order->email)->send(new BasicMail(EmailTemplate::removalOrderPaymentApproveMail($order, $amount)));
            $admin_mail = get_static_option('site_global_email');
            Mail::to($admin_mail)->send(new BasicMail(EmailTemplate::removalOrderPaymentAdminMail($order, $amount)));
        } catch (\Exception $e) {
            return redirect()->route('frontend.book.order', $trx)->with(NexelitHelpers::item_delete($e->getMessage()));
        }

        return redirect()->route('frontend.book.order', $trx)->with(['notify' => $notify]);

    }

    public function OrderCancel($trx)
    {
        $order = RemovalOrder::where('trx', $trx)->first();
        if ($order && ($order->status == 4 || $order->is_deleted == 1)) {
            return redirect()->route('homepage')->with(['msg' => __('Access denied for this order.'), 'type' => 'danger']);
        }
        $order->payment_status = 0;
        $order->save();
        return redirect()->route('frontend.book.order', $trx)->with(['notify' => "Order Payment Cancelled! _danger"]);
    }

    public function stripe_ipn($status)
    {
        $stripe = PaymentGatewayCredential::get_stripe_credential();
        $payment_data = $stripe->ipn_response();
        return $this->common_ipn_data($payment_data, $status);
    }

    private function common_charge_customer_data($order_details, $ipn_route, $amount, $payment_type = 'Removal Order'): array
    {
        if ($amount == 'full') {
            $data = [
                'amount' => $order_details->total,
                'title' => 'Payment For Removal Service Booking Order Id: #' . $order_details->trx,
                'description' => 'Payment For Product Order Id: #' . $order_details->trx . ' Payer Name: ' . $order_details->name . ' Payer Email:' . $order_details->email,
                'order_id' => $order_details->trx,
                'track' => $order_details->trx,
                'cancel_url' => route('frontend.book.order.cancel', $order_details->trx),
                'success_url' => route('frontend.book.order.success', [$order_details->trx, $amount]),
                'name' => $order_details->name,
                'email' => $order_details->email,
                'payment_type' => $payment_type,
                'ipn_url' => $ipn_route
            ];
        }

        if ($amount == 'advance') {
            $data = [
                'amount' => ($order_details->total * 30) / 100,
                'title' => 'Payment For Removal Service Booking Order Id: #' . $order_details->trx,
                'description' => 'Payment For Product Order Id: #' . $order_details->trx . ' Payer Name: ' . $order_details->name . ' Payer Email:' . $order_details->email,
                'order_id' => $order_details->trx,
                'track' => $order_details->trx,
                'cancel_url' => route('frontend.book.order.cancel', $order_details->trx),
                'success_url' => route('frontend.book.order.success', [$order_details->trx, $amount]),
                'name' => $order_details->name,
                'email' => $order_details->email,
                'payment_type' => $payment_type,
                'ipn_url' => $ipn_route
            ];
        }

        if ($amount == 'remaining') {
            $data = [
                'amount' => ($order_details->total * 70) / 100,
                'title' => 'Payment For Removal Service Booking Order Id: #' . $order_details->trx,
                'description' => 'Payment For Product Order Id: #' . $order_details->trx . ' Payer Name: ' . $order_details->name . ' Payer Email:' . $order_details->email,
                'order_id' => $order_details->trx,
                'track' => $order_details->trx,
                'cancel_url' => route('frontend.book.order.cancel', $order_details->trx),
                'success_url' => route('frontend.book.order.success', [$order_details->trx, $amount]),
                'name' => $order_details->name,
                'email' => $order_details->email,
                'payment_type' => $payment_type,
                'ipn_url' => $ipn_route
            ];
        }

        return $data;
    }

    private function common_ipn_data($payment_data, $status)
    {
        $order_id = $payment_data['order_id'];
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete') {
            return redirect()->route('frontend.book.order.success', [$order_id, $status]);
        }
        return redirect()->route('frontend.book.order.cancel', $order_id);
    }
    public function validate_coupon(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|string',
            'amount' => 'required|numeric',
            'email' => 'nullable|email'
        ]);

        $coupon = \App\RemovalCoupon::where('code', $request->code)->where('status', 'publish')->first();

        if (is_null($coupon)) {
            return response()->json(['status' => 'error', 'msg' => __('Invalid Coupon Code')]);
        }

        // Check Expiry
        if ($coupon->expire_date && \Carbon\Carbon::parse($coupon->expire_date)->isPast()) {
            return response()->json(['status' => 'error', 'msg' => __('Coupon Expired')]);
        }

        // Check Min Amount
        if ($coupon->min_amount && $request->amount < $coupon->min_amount) {
            return response()->json(['status' => 'error', 'msg' => __('Minimum order amount for this coupon is ') . amount_with_currency_symbol($coupon->min_amount)]);
        }

        // Check Total usage limit
        if ($coupon->total_limit) {
            $used = \App\RemovalCouponUsage::where('coupon_id', $coupon->id)->count();
            if ($used >= $coupon->total_limit) {
                return response()->json(['status' => 'error', 'msg' => __('Coupon usage limit reached')]);
            }
        }

        // Check Per customer usage limit
        if ($request->email && $coupon->limit_per_customer) {
            $customer_used = \App\RemovalCouponUsage::where('coupon_id', $coupon->id)->where('user_email', $request->email)->count();
            if ($customer_used >= $coupon->limit_per_customer) {
                return response()->json(['status' => 'error', 'msg' => __('You have already used this coupon maximum times')]);
            }
        }

        $discount_amount = 0;
        $sub_prices = $request->sub_prices ?? [];

        $discountable_price = 0;
        $excluded = $coupon->excluded_services ?: [];

        // If sub_prices are provided, calculate based on non-excluded items
        if (!empty($sub_prices)) {
            if (!in_array('van', $excluded))
                $discountable_price += $sub_prices['van'] ?? 0;
            if (!in_array('helpers', $excluded))
                $discountable_price += $sub_prices['helpers'] ?? 0;
            if (!in_array('mileage', $excluded))
                $discountable_price += $sub_prices['mileage'] ?? 0;
            if (!in_array('floors', $excluded))
                $discountable_price += $sub_prices['floors'] ?? 0;
            if (!in_array('parking', $excluded))
                $discountable_price += $sub_prices['parking'] ?? 0;
            if (!in_array('special_zones', $excluded))
                $discountable_price += $sub_prices['special_zones'] ?? 0;
            if (!in_array('insurance', $excluded))
                $discountable_price += $sub_prices['insurance'] ?? 0;
        } else {
            // Fallback if sub_prices are missing (should not happen with updated JS)
            $discountable_price = $request->amount;
        }

        if ($coupon->discount_type == 'percentage') {
            $discount_amount = ($discountable_price * $coupon->discount_value) / 100;
        } elseif ($coupon->discount_type == 'fixed') {
            $discount_amount = min($coupon->discount_value, $discountable_price);
        } elseif ($coupon->discount_type == 'free_shipping') {
            $discount_amount = $sub_prices['mileage'] ?? 0;
        }

        return response()->json([
            'status' => 'success',
            'discount' => $discount_amount,
            'type' => $coupon->discount_type,
            'stackable' => $coupon->stackable,
            'msg' => __('Coupon Applied Successfully')
        ]);
    }
}

