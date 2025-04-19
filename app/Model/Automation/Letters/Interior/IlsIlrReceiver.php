<?php

namespace App\Model\Automation\Letters\Interior;

use Illuminate\Database\Eloquent\Model;

class IlsIlrReceiver extends Model
{
    protected $fillable = [
        'ils_ilr_id',
        'user_id',
    ];
}
