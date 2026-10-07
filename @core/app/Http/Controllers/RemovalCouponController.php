<?php

namespace App\Http\Controllers;

use App\RemovalCoupon;
use App\RemovalOrder;
use Illuminate\Http\Request;

class RemovalCouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_coupon()
    {
        $all_coupon = RemovalCoupon::all();
        return view('backend.removal.coupon.all-coupon')->with(['all_coupon' => $all_coupon]);
    }

    public function store_coupon(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|string|max:191|unique:removal_coupons,code',
            'discount_type' => 'required|string|max:191',
            'discount_value' => 'nullable|numeric',
            'expire_date' => 'nullable|date',
            'total_limit' => 'nullable|integer',
            'limit_per_customer' => 'required|integer',
            'min_amount' => 'nullable|numeric',
            'status' => 'required|string|max:191',
        ]);

        RemovalCoupon::create($request->all());

        return redirect()->back()->with(['msg' => __('New Coupon Added Successfully'), 'type' => 'success']);
    }

    public function update_coupon(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|string|max:191|unique:removal_coupons,code,' . $request->id,
            'discount_type' => 'required|string|max:191',
            'discount_value' => 'nullable|numeric',
            'expire_date' => 'nullable|date',
            'total_limit' => 'nullable|integer',
            'limit_per_customer' => 'required|integer',
            'min_amount' => 'nullable|numeric',
            'status' => 'required|string|max:191',
        ]);

        RemovalCoupon::find($request->id)->update($request->all());

        return redirect()->back()->with(['msg' => __('Coupon Updated Successfully'), 'type' => 'success']);
    }

    public function delete_coupon(Request $request, $id)
    {
        RemovalCoupon::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Coupon Deleted Successfully'), 'type' => 'danger']);
    }

    public function bulk_action(Request $request)
    {
        $all = RemovalCoupon::find($request->ids);
        foreach ($all as $item) {
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }

    public function validate_coupon_ajax(Request $request)
    {
        $request->validate([
            'coupon' => 'required|string',
            'email' => 'required|email'
        ]);

        // 1. Locate the coupon
        $coupon = RemovalCoupon::where('code', $request->coupon)->first();

        if (!$coupon) {
            return response()->json([
                'status' => 'invalid',
                'message' => __('Coupon code does not exist.')
            ]);
        }

        // 2. Check if the coupon status is active
        if ($coupon->status !== 'publish' && $coupon->status !== 'active') { // adjust based on your enum ('publish'/'active')
            return response()->json([
                'status' => 'invalid',
                'message' => __('This coupon is currently inactive.')
            ]);
        }

        // 3. Verify expiration date
        if ($coupon->expire_date && \Carbon\Carbon::parse($coupon->expire_date)->isPast()) {
            return response()->json([
                'status' => 'invalid',
                'message' => __('This coupon has expired.')
            ]);
        }

        // 4. Verify total global usage limit across the platform
        if (!is_null($coupon->total_limit)) {
            // Count how many times this specific coupon code has been used successfully in your orders table
            $global_usages = RemovalOrder::where('coupon_code', $coupon->code)
                ->where('status', '!=', 3) // Exclude cancelled orders if applicable
                ->count();

            if ($global_usages >= $coupon->total_limit) {
                return response()->json([
                    'status' => 'invalid',
                    'message' => __('This coupon has reached its maximum global usage limit.')
                ]);
            }
        }

        // 5. Verify limit per specific customer email address
        if (!is_null($coupon->limit_per_customer)) {
            $customer_usages = RemovalOrder::where('coupon_code', $coupon->code)
                ->where('email', $request->email)
                ->where('status', '!=', 3) // Exclude cancelled orders
                ->count();

            if ($customer_usages >= $coupon->limit_per_customer) {
                return response()->json([
                    'status' => 'invalid',
                    'message' => __('You have reached your usage limit for this coupon.')
                ]);
            }
        }

        // 6. Build success payload response formatting the visual value layout string
        $value_display = $coupon->discount_type === 'percentage'
            ? $coupon->discount_value . '%'
            : site_currency_symbol() . number_format($coupon->discount_value, 2);

        return response()->json([
            'status' => 'valid',
            'discount' => $coupon->discount_value,
            'type' => $coupon->discount_type, // 'percentage' or 'fixed'
            'value_display' => $value_display
        ]);
    }
}
