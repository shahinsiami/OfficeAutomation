<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $fillable = [
        'id',
        'name',
        'family',
        'birthday',
        'address',
        'sex',
        'degree',
        'signature',
        'photo',
        'email',
        'phonenumber',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
