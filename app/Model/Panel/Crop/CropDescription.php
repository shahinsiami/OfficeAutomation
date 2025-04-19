<?php

namespace App\Model\Panel\Crop;

use Illuminate\Database\Eloquent\Model;

class CropDescription extends Model
{
    protected $fillable = ['crop_id', 'full_description'];

    public function crop(){
        return $this->belongsTo(Crop::class,'crop_id','id');
    }

}

