<?php

namespace App\Traits\EmailTemplate;

use App\Helpers\LanguageHelper;
use App\PaymentLogs;
use App\PricePlan;
use App\RemovalFloor;
use App\RemovalHelper;
use App\RemovalOrder;
use App\RemovalOrderBill;
use App\RemovalOrderPlace;
use App\RemovalParkingOption;
use App\RemovalTransport;

trait RemovalOrderEmailTemplate
{
    
    public function removalOrderCreateMail($order_details)
    {
        $message = get_static_option('removal_order_placed_en_US_message');
        $message = $this->parseRemovalInfo($message, $order_details);

        return [
            'subject' => get_static_option('removal_order_placed_en_US_subject'),
            'message' => $message
        ];
    }
    
    public function removalOrderOTPMail($order_details)
    {
        $message = get_static_option('removal_order_otp_en_US_message');
        $message = $this->parseRemovalInfo($message, $order_details);

        return [
            'subject' => get_static_option('removal_order_otp_en_US_subject'),
            'message' => $message
        ];
    }
    
    /**
     * send packageOrderPaymentApproveMail
     * */
    public function removalOrderPaymentApproveMail($order_details,$status)
    {
        $message = get_static_option('removal_order_payment_accept_'.$status.'_en_US_message');
        $message = $this->parseRemovalInfo($message, $order_details);

        return [
            'subject' => get_static_option('removal_order_payment_accept_'.$status.'_en_US_subject'),
            'message' => $message
        ];
    }
    
    
    public function removalOrderStatusMail($order_details)
    {
        $message = get_static_option('removal_order_status_en_US_message');
        $message = $this->parseRemovalInfo($message, $order_details);

        return [
            'subject' => get_static_option('removal_order_status_en_US_subject'),
            'message' => $message
        ];
    }
    
    public function removalOrderPaymentReminderMail($order_details)
    {
        $message = get_static_option('removal_order_payment_reminder_en_US_message');
        $message = $this->parseRemovalInfo($message, $order_details);

        return [
            'subject' => get_static_option('removal_order_payment_reminder_en_US_subject'),
            'message' => $message
        ];
    }
    
    public function removalRemainingNotify($order_details)
    {
        $message = get_static_option('removal_order_remaining_notify_en_US_message');
        $message = $this->parseRemovalInfo($message, $order_details);
        
        return [
            'subject' => get_static_option('removal_order_remaining_notify_en_US_subject'),
            'message' => $message
        ];
    }
    
    public function removalOvertimeNotify($order_details)
    {
        $message = get_static_option('removal_order_overtime_notify_en_US_message');
        $message = $this->parseRemovalInfo($message, $order_details);
        
        return [
            'subject' => get_static_option('removal_order_overtime_notify_en_US_subject'),
            'message' => $message
        ];
    }

    /**
     * send packageOrderAdminMail
     * */
    public function removalOrderAdminMail($order_details)
    {
        $message = get_static_option('removal_order_admin_mail_en_US_nessage');
        $message = $this->parseRemovalInfo($message, $order_details);

        return [
            'subject' => get_static_option('removal_order_admin_mail_en_US_subject'),
            'message' => $message
        ];
    }
    
    public function removalOrderPaymentAdminMail($order_details,$status)
    {
        $message = get_static_option('removal_order_'.$status.'_payment_admin_mail_en_US_message');
        $message = $this->parseRemovalInfo($message, $order_details);

        return [
            'subject' => get_static_option('removal_order_'.$status.'_payment_admin_mail_en_US_subject'),
            'message' => $message
        ];
    }

    private function parseRemovalInfo($message, $order_details)
    {
        $message = str_replace(
            [
                '@order_billing_info',
                '@payment_status',
                '@order_id',
                '@order_payment_gateway',
                '@order_date',
                '@billing_name',
                '@billing_email',
                '@site_title',
                '@order_status',
                '@order_redirect_link',
                '@order_otp_redirect_link',
                '@full_payment',
                '@advance_payment',
                '@remaining_payment',
                '@remaining_link',
                '@overtime_payment',
                '@overtime_link',
                '@time',
                '@otp'
            ],
            [
                $this->removalOrderBillingInfo($order_details),
                $this->orderPaymentStatus($order_details->payment_status),
                $order_details->trx,
                'Stripe',
                $order_details->date,
                $order_details->name,
                $order_details->email,
                get_static_option('site_' . LanguageHelper::user_lang_slug() . '_title'),
                $this->orderStatus($order_details->status),
                '<a class="btn btn-dagency" href="'.route('frontend.book.order',$order_details->trx).'">'.__('Order Details').'</a>',
                '<a class="btn btn-dagency" href="'.route('frontend.book.order.otp.direct',[$order_details->trx, $order_details->otp]).'">'.__('Order Details').'</a>',
                $order_details->total,
                ($order_details->total*30)/100,
                ($order_details->total*70)/100,
                '<a class="btn btn-dagency" href="'.route('frontend.book.order.checkout',[$order_details->trx,'remaining']).'">'.__('Pay Remaining').'</a>',
                $order_details->remaining,
                '<a class="btn btn-dagency" href="'.route('frontend.book.order.checkout',[$order_details->trx,'overtime']).'">'.__('Pay Overtime').'</a>',
                $this->getTime($order_details->booking_time),
                $order_details->otp
            ], $message);
        return $message;
    }
    
    private function getTime($time){
        if($time == 1){
            return 'Morning';
        }
        elseif($time == 2){
            return 'Afternoon';
        }
        elseif($time == 3){
            return 'Evening';
        }
        else{
            return 'Unknown';
        }
        
    }


    private function removalOrderBillingInfo($order_details)
    {
        //$payment_details = RemovalOrder::where('id', $order_details->id)->first();
        $payment_places = RemovalOrderPlace::where('order_trx', $order_details->trx)->get();

        $output = '<div class="billing-wrap">';
        $output .= '<ul class="billing-details">';
        $output .= '<li class="text-center" ><strong>'.__('Locations').'</strong></li>';
        foreach($payment_places as $place){
            $output .= '<li><strong>'.$place->position.':</strong> '.$place->address.'</li>';
        }
        $output .= '<li class="text-center" ><strong>'.__('Billing Info').'</strong></li>';
        $output .= '<li><strong>'.__('Order ID').':</strong> #'.$order_details->trx.'</li>';
        $output .= '<li><strong>'.__('Name').':</strong> '.$order_details->name.'</li>';
        $output .= '<li><strong>'.__('Email').':</strong> '.$order_details->email.'</li>';
        $output .= '<li><strong>'.__('Payment Method').':</strong> Stripe</li>';
        $output .= '<li><strong>'.__('Payment Status').':</strong> '.$this->orderPaymentStatus($order_details->payment_status).'</li>';
        $output .= '<li><strong>'.__('Order Status').':</strong> '.$this->orderStatus($order_details->status).'</li>';
        $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }
    
    private function orderPaymentStatus($status){
        if($status == 0){
         $output = '<a class="badge badge-primary text-white rounded-pill px-3" >Unpaid</a>';
        }
        if($status == 2){
         $output = '<a class="badge badge-info text-white rounded-pill px-3" >Partialy Paid</a>';
        }
        if($status == 1){
         $output = '<a class="badge badge-success text-white rounded-pill px-3" >Fully Paid</a>';
        }
        if($status == 3){
         $output = '<a class="badge badge-danger text-white rounded-pill px-3" >Cancelled</a>';
        }
        if($status == 3){
         $output = '<a class="badge badge-danger text-white rounded-pill px-3" >Cancelled & Returned</a>';
        }
        return $output;
    }
    
    private function orderStatus($status){
        if($status == 0){
         $output = '<a class="badge badge-primary text-white rounded-pill px-3" >Pending</a>';
        }
        if($status == 1){
         $output = '<a class="badge badge-success text-white rounded-pill px-3" >Ongoing</a>';
        }
        if($status == 2){
         $output = '<a class="badge badge-info text-white rounded-pill px-3" >Completed</a>';
        }
        if($status == 3){
         $output = '<a class="badge badge-danger text-white rounded-pill px-3" >Cancelled</a>';
        }
        if($status == 4){
         $output = '<a class="badge badge-danger text-white rounded-pill px-3" >Cancelled & Returned</a>';
        }
        return $output;
    }



}