<?php

namespace App\Model\Automation\Letters\Draft;

use Illuminate\Database\Eloquent\Model;

class DlsDlrSummary extends Model
{
    protected $fillable = [
        'dls_dlr_id',
        'hint',
        'summary',
        'subject',
        'note',
    ];
}
