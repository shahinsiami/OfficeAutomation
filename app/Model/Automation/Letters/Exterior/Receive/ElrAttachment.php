<?php

namespace App\Model\Automation\Letters\Exterior\Receive;

use Illuminate\Database\Eloquent\Model;

class ElrAttachment extends Model
{
    protected $fillable = [
        'id',
        'elr_id',
        'file',
        'extension',
    ];
}
