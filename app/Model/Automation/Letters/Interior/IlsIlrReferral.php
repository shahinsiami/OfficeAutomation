<?php

namespace App\Model\Automation\Letters\Interior;

use App\User;
use Illuminate\Database\Eloquent\Model;

class IlsIlrReferral extends Model
{
    protected $fillable = [
        'user_id',
        'ils_ilr_id',
        'note',
        'description',
    ];
    public function receiver(){
        return $this->belongsToMany(User::class,'ils_ilr_referral_receivers','ils_ilr_referral_id','user_id');
    }
    public function ilsIlr(){
        return $this->belongsTo(IlsIlr::class,'ils_ilr_id','id');
    }
}
