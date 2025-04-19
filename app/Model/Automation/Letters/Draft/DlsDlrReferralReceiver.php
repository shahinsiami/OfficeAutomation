<?php

namespace App\Model\Automation\Letters\Draft;

use App\User;
use Illuminate\Database\Eloquent\Model;

class DlsDlrReferralReceiver extends Model
{
    protected $fillable = [
        'ils_ilr_referral_id',
        'user_id',
    ];
    public function receiver(){
        return $this->belongsToMany(User::class,'dls_dlr_referral_receivers','dls_dlr_referral_id','user_id');
    }
    public function ilsIlr(){
        return $this->belongsTo(DlsDlr::class,'dls_dlr_id','id');
    }
}
