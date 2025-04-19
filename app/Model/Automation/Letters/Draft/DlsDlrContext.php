<?php

namespace App\Model\Automation\Letters\Draft;

use Illuminate\Database\Eloquent\Model;

class DlsDlrContext extends Model
{
    protected $fillable = [
        'id',
        'dls_dlr_id',
        'content',
    ];
}
