<?php

namespace App\Model\Automation\Letters\Exterior\Send;

use Illuminate\Database\Eloquent\Model;

class ElsSender extends Model
{
    protected $fillable = [
        'els_id',
        'user_id',
    ];

}
