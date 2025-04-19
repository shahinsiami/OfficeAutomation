<?php

namespace App\Model\Automation\Fax;

use App\User;
use Illuminate\Database\Eloquent\Model;

class FlsFlr extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'to',
        'status',
        'type',
        'title',
        'sender',
        'from',
    ];
    public function attachment(){
        return $this->hasMany(FlsFlrAttachment::class,'fls_flr_id');
    }
    public function sender(){
        return $this->belongsToMany(User::class,'fls_flr_senders','fls_flr_id','user_id');
    }
    public function receiver(){
        return $this->belongsToMany(User::class,'fls_flr_receivers','fls_flr_id','user_id');
    }
}
