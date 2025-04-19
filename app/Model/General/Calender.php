<?php

namespace App\Model\General;

use Illuminate\Database\Eloquent\Model;

class Calender extends Model
{
    protected $fillable = [
        'description',
        'title',
        'status',
        'day' ,
        'month' ,
        'year' ,
        'registerer' ,
        'user_id' ,
    ];
}



