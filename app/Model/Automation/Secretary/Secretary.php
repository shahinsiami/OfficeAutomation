<?php

namespace App\Model\Automation\Secretary;

use Illuminate\Database\Eloquent\Model;

class Secretary extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];
    public function secretaryPort(){
        return $this->hasMany(SecretaryPort::class, 'secretary_id');
    }
}
