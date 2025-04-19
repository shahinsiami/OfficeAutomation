<?php

namespace App\Model\Panel\Discount;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['name',
        'code' ,
        'count',
        'minprice',
        'maxprice',
        'startdate',
        'enddate',
        'percentage',
        'status'];
}
