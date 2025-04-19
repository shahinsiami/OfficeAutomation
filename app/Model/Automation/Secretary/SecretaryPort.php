<?php

namespace App\Model\Automation\Secretary;

use Illuminate\Database\Eloquent\Model;

class SecretaryPort extends Model
{
    protected $fillable = [
        'id',
        'indicator',
        'name',
        'secretary_id',
    ];
    public function secretary(){
        return $this->belongsTo(Secretary::class, 'secretary_id');
    }
}

