<?php

namespace App\Model\Automation\Letters\Exterior\Send;

use Illuminate\Database\Eloquent\Model;

class ElsDocument extends Model
{
    protected $fillable = [
        'els_id',
        'document_id',
    ];
}
