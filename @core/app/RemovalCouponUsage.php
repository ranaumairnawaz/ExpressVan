<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemovalCouponUsage extends Model
{
    use HasFactory;

    protected $table = 'removal_coupon_usages';
    protected $fillable = [
        'coupon_id',
        'order_trx',
        'user_email'
    ];
}
