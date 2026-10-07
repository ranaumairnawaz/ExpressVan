<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemovalCoupon extends Model
{
    use HasFactory;

    protected $table = 'removal_coupons';
    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'expire_date',
        'total_limit',
        'limit_per_customer',
        'min_amount',
        'status',
        'excluded_services',
        'stackable'
    ];

    protected $casts = [
        'excluded_services' => 'array',
        'stackable' => 'boolean'
    ];
    public function usages()
    {
        return $this->hasMany(RemovalCouponUsage::class, 'coupon_id', 'id');
    }
}
