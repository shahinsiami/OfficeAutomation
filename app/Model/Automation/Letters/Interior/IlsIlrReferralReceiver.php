<?php

namespace App\Model\Automation\Letters\Interior;

use Illuminate\Database\Eloquent\Model;

class IlsIlrReferralReceiver extends Model
{
    protected $fillable = [
        'dls_dlr_referral_id',
        'user_id',
    ];
}
