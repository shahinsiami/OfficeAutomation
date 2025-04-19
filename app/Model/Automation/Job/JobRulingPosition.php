<?php

namespace App\Model\Automation\Job;

use Illuminate\Database\Eloquent\Model;

class JobRulingPosition extends Model
{
    protected $fillable = [
        'user_id',
        'job_position_id',
    ];
}

