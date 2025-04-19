<?php

namespace App\Model\Panel\Seller;

use Illuminate\Database\Eloquent\Model;

class SellerAddress extends Model
{
    protected $fillable = ['superscription' , 'seller_id' , 'area_state_id' , 'area_city_id' , 'area_zone_id' ,'postcode','state','city','zone'];

    public function store(){
        return $this->belongsTo(SellerStore::class);
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
