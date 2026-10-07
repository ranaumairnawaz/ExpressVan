<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCalendar extends Model
{
    use HasFactory;

    protected $table = 'user_calendars';

    protected $fillable = [
        'admin_id',
        'provider',
        'access_token',
        'refresh_token',
        'expires_at',
        'calendar_id'
    ];

    protected $casts = [
        'expires_at' => 'datetime'
    ];
}
