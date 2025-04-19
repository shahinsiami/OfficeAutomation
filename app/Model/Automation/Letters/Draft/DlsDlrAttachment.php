<?php

namespace App\Model\Automation\Letters\Draft;

use Illuminate\Database\Eloquent\Model;

class DlsDlrAttachment extends Model
{
    protected $fillable = [
        'id',
        'dls_dlr_id',
        'file',
        'extension',
    ];
}
