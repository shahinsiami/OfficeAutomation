<?php

namespace App\Model\Automation\Letters\Draft;

use Illuminate\Database\Eloquent\Model;

class DlsDlrDocument extends Model
{
    protected $fillable = [
        'document_id',
        'dls_dlr_id',
    ];
}
