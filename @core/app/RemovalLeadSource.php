<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemovalLeadSource extends Model
{
    protected $table = 'removal_lead_sources';
    protected $fillable = ['name'];
}
