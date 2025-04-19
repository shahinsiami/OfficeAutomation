<?php

namespace App\Model\Automation\Job;

use Illuminate\Database\Eloquent\Model;

class JobShift extends Model
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'start',
        'end',
    ];
}




