<?php

namespace App\Model\Automation\Letters\Interior;

use Illuminate\Database\Eloquent\Model;

class IlsIlrAttachment extends Model
{
    protected $fillable = [
        'id',
        'ils_ilr_id',
        'file',
        'extension',
    ];
}
