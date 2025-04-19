<?php

namespace App\Model\Automation\Letters\Draft;

use Illuminate\Database\Eloquent\Model;

class DlsDlrReceiver extends Model
{
    protected $fillable = [
        'dls_dlr_id',
        'user_id',
    ];
}
