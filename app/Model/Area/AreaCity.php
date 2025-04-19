<?php

namespace App\Model\Area;

use Illuminate\Database\Eloquent\Model;

class AreaCity extends Model
{
    public function state(){
        return $this->belongsTo(AreaState::class);
    }
    public function zone(){
        return $this->hasMany(AreaZone::class);
    }


}
