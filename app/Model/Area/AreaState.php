<?php

namespace App\Model\Area;

use Illuminate\Database\Eloquent\Model;

class AreaState extends Model
{
    public function city(){
        return $this->hasMany(AreaCity::class);
    }
}
