<?php

namespace App\Model\Automation\Fax;

use Illuminate\Database\Eloquent\Model;

class FlsFlrSender extends Model
{
    protected $fillable = [
        'fls_flr_id',
        'user_id',
    ];
}
