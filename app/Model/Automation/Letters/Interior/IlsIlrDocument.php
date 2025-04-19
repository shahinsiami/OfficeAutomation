<?php

namespace App\Model\Automation\Letters\Interior;

use Illuminate\Database\Eloquent\Model;

class IlsIlrDocument extends Model
{
    protected $fillable = [
        'document_id',
        'ils_ilr_id',
    ];
}
