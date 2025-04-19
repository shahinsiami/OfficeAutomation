<?php

namespace App\Model\Automation\Letters\Draft;

use App\User;
use Illuminate\Database\Eloquent\Model;

class DlsDlrReferral extends Model
{
    protected $fillable = [
        'user_id',
        'dls_dlr_id',
        'note',
        'description',
    ];
    public function receiver(){
        return $this->belongsToMany(User::class,'dls_dlr_referral_receivers','dls_dlr_referral_id','user_id');
    }
    public function dlrDls(){
        return $this->belongsTo(DlsDlr::class,'dls_dlr_id','id');
    }
}
