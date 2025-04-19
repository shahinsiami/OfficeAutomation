<?php

namespace App\Model\Automation\Letters\Exterior\Send;

use Illuminate\Database\Eloquent\Model;

class ElsSummary extends Model
{
    protected $fillable = [
        'elr_id',
        'hint',
        'summary',
        'subject',
        'note',
    ];
}
