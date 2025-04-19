<?php

namespace App\Model\Automation\Letters\Exterior\Receive;

use Illuminate\Database\Eloquent\Model;

class ElrSummary extends Model
{
    protected $fillable = [
        'elr_id',
        'hint',
        'summary',
        'subject',
        'note',
    ];
}
