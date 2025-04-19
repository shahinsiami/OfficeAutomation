<?php

namespace App\Model\Automation\Message;

use App\User;
use Illuminate\Database\Eloquent\Model;

class MlsMlr extends Model
{
    protected $fillable = [
        'id',
        'sender',
        'title',
        'context',
        'user_id',

    ];
    public function receiver(){
        return $this->belongsToMany(User::class,'mls_mlr_receivers','mls_mlr_id','user_id');
    }
}
