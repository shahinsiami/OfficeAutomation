<?php

namespace App\Model\Automation\Letters\Exterior\Receive;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ElrReferral extends Model
{
    protected $fillable = [
        'user_id',
        'elr_id',
        'note',
        'description',
    ];
    public function receiver(){
        return $this->belongsToMany(User::class,'elr_referral_receivers','elr_referral_id','user_id');
    }
    public function elr(){
        return $this->belongsTo(Elr::class,'elr_id','id');
    }
}
