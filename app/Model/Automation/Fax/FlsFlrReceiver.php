<?php

namespace App\Model\Automation\Fax;

use Illuminate\Database\Eloquent\Model;

class FlsFlrReceiver extends Model
{
    protected $fillable = [
        'fls_flr_id',
        'user_id',
    ];
}

