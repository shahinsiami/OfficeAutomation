<?php

namespace App\Model\Automation\Letters\Exterior\Receive;

use Illuminate\Database\Eloquent\Model;

class ElrReferralReciver extends Model
{
    protected $fillable = [
        'user_id',
        'elr_referral_id',
    ];
}
