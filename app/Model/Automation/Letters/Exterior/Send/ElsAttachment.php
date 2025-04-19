<?php

namespace App\Model\Automation\Letters\Exterior\Send;

use Illuminate\Database\Eloquent\Model;

class ElsAttachment extends Model
{
    protected $fillable = [
        'id',
        'elr_id',
        'file',
        'extension',
    ];
}
