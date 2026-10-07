<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialZipcode extends Model
{
    use HasFactory;
    protected $table = 'special_zipcodes';
    protected $fillable = ['code' ,'type'];
    
}
