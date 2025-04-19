<?php

namespace App\Model\Automation\Job;

use Illuminate\Database\Eloquent\Model;

class JobRulingShift extends Model
{
    protected $fillable = [
        'user_id',
        'job_shift_id',
    ];
}