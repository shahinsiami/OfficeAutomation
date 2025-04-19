<?php

namespace App\Model\Panel\Seller;

use App\Model\Area\AreaCity;
use App\Model\Area\AreaState;
use App\Model\Area\AreaZone;
use App\Model\Panel\Crop\CropCategory;
use App\User;
use Illuminate\Database\Eloquent\Model;

class SellerEvidence extends Model
{
    protected $fillable = ['storename' , 'owner' , 'postcode' , 'phonenumber' , 'address' , 'cardnumber' , 'companyaccount' , 'area_state_id' , 'area_city_id' , 'area_zone_id' , 'crop_category_id' , 'license' ,
        'stewardship' , 'nationalcard' , 'officialnewspaper' , 'registration' , 'activitypermission' , 'formalrequest' , 'latestofficialnewspaper' , 'user_id' ,
        'economiccode' , 'companynumber' , 'companynationalcode' , 'status' , 'type'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function category(){
        return $this->belongsTo(CropCategory::class);
    }
    public function state(){
        return $this->belongsTo(AreaState::class);
    }
    public function city(){
        return $this->belongsTo(AreaCity::class);
    }
    public function zone(){
        return $this->belongsTo(AreaZone::class);
    }
}
