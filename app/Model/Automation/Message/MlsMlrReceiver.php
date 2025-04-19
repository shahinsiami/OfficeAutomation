<?php

namespace App\Model\Automation\Message;

use Illuminate\Database\Eloquent\Model;

class MlsMlrReceiver extends Model
{
    protected $fillable = [
        'mls_mlr_id',
        'user_id',
    ];
}

