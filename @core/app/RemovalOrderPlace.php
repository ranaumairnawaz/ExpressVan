<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemovalOrderPlace extends Model
{
    use HasFactory;
    protected $fillable = ['order_trx','position','address','city','postcode','house','floor','elevator','parking'];
}
