<?php

namespace App\Model\Automation\Letters\Interior;

use Illuminate\Database\Eloquent\Model;

class IlsIlrContext extends Model
{
    protected $fillable = [
        'id',
        'ils_ilr_id',
        'content',
    ];
}
