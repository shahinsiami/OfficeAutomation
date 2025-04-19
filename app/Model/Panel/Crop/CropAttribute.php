<?php

namespace App\Model\Panel\Crop;

use Illuminate\Database\Eloquent\Model;

class CropAttribute extends Model
{
    protected $fillable = ['crop_id', 'details'];

    public function crop(){
        return $this->belongsTo(Crop::class,'crop_id','id');
    }
}
