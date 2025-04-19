<?php

namespace App\Model\Automation\Letters\Interior;

use Illuminate\Database\Eloquent\Model;

class IlsIlrSummary extends Model
{
    protected $fillable = [
        'ils_ilr_id',
        'hint',
        'summary',
        'subject',
        'note',
    ];
}
