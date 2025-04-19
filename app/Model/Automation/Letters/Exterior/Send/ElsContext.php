<?php

namespace App\Model\Automation\Letters\Exterior\Send;

use Illuminate\Database\Eloquent\Model;

class ElsContext extends Model
{
    protected $fillable = [
        'id',
        'elr_id',
        'content',
    ];
}
