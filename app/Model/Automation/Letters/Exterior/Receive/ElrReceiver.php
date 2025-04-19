<?php

namespace App\Model\Automation\Letters\Exterior\Receive;

use Illuminate\Database\Eloquent\Model;

class ElrReceiver extends Model
{
    protected $fillable = [
        'elr_id',
        'user_id',
    ];
}
