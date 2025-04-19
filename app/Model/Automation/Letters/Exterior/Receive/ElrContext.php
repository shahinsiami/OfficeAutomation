<?php

namespace App\Model\Automation\Letters\Exterior\Receive;

use Illuminate\Database\Eloquent\Model;

class ElrContext extends Model
{
    protected $fillable = [
        'id',
        'elr_id',
        'content',
    ];
}
