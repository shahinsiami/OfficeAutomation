<?php

namespace App;

use App\Model\Automation\Fax\FlsFlr;
use App\Model\Automation\Job\JobPosition;
use App\Model\Automation\Letters\Draft\DlsDlr;
use App\Model\Automation\Letters\Draft\DlsDlrReferral;
use App\Model\Automation\Letters\Exterior\Receive\ElrReferral;
use App\Model\Automation\Letters\Interior\IlsIlr;;
use App\Model\Automation\Job\JobShift;
use App\Model\Automation\Letters\Interior\IlsIlrReferral;
use App\Model\Automation\Message\MlsMlr;
use App\Model\General\Notification;
use App\Model\General\Calender;
use App\Model\Automation\Letters\Exterior\Receive\Elr;
use App\Model\Automation\Letters\Exterior\Send\Els;
use App\Model\Panel\Seller\Seller;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phonenumber' ,
        'status' ,
    ];
    public function findForPassport($username)
    {
        return $this->where('name', $username)->first();
    }
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function userinfo(){
        return $this->hasOne(UserInfo::class,'user_id');
    }
    public function userPermission(){
        return $this->belongsToMany(Permission::class,'user_permissions','user_id','permission_id');
    }
    public function authorized($permission){
        return $this->userPermission()->where('id',$permission)->exists();
    }
    public function userJobPosition(){
        return $this->belongsToMany(JobPosition::class,'job_ruling_positions','user_id','job_position_id');
    }
    public function userJobShift(){
        return $this->belongsToMany(JobShift::class,'job_ruling_shifts','user_id','job_shift_id');
    }
    public function getNotification(){
        return $this->hasMany(Notification::class,'user_id');
    }
    public function calender(){
        return $this->hasMany(Calender::class,'user_id');
    }
    public function ilrIls(){
        return $this->belongsToMany(IlsIlr::class,'ils_ilr_receivers','user_id','ils_ilr_id');
    }
    public function elr(){
        return $this->belongsToMany(Elr::class,'elr_receivers','user_id','elr_id');
    }
    public function els(){
        return $this->belongsToMany(Els::class,'els_senders','user_id','els_id');
    }
    public function rlsIl(){
        return $this->belongsToMany(IlsIlrReferral::class,'ils_ilr_referral_receivers','user_id','ils_ilr_referral_id');
    }
    public function rlsEl(){
        return $this->belongsToMany(ElrReferral::class,'elr_referral_receivers','user_id','elr_referral_id');
    }
    public function dlsDlr(){
        return $this->belongsToMany(DlsDlr::class,'dls_dlr_receivers','user_id','dls_dlr_id');
    }
    public function rlsDl(){
        return $this->belongsToMany(DlsDlrReferral::class,'dls_dlr_referral_receivers','user_id','dls_dlr_referral_id');
    }
    public function mlsMlr(){
        return $this->belongsToMany(MlsMlr::class,'mls_mlr_receivers','user_id','mls_mlr_id');
    }
    public function flsflr(){
        return $this->hasMany(FlsFlr::class,'user_id');
    }
    public function seller(){
        return $this->hasMany(Seller::class,'user_id');
    }
    
}

