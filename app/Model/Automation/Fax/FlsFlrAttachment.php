<?php

namespace App\Model\Automation\Fax;

use Illuminate\Database\Eloquent\Model;

class FlsFlrAttachment extends Model
{
    protected $fillable = [
        'id',
        'fls_flr_id',
        'file',
        'extension',
    ];
}
