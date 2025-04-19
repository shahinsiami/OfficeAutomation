<?php

namespace App\Model\Area;

use Illuminate\Database\Eloquent\Model;

class AreaZone extends Model
{
    public function city(){
        return $this->belongsTo(AreaCity::class);
    }
}
