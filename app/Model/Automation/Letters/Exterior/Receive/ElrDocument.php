<?php

namespace App\Model\Automation\Letters\Exterior\Receive;

use Illuminate\Database\Eloquent\Model;

class ElrDocument extends Model
{
    protected $fillable = [
        'elr_id',
        'document_id',
    ];
}


