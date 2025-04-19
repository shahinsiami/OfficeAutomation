<?php

namespace App\Model\Panel\Crop;

use Illuminate\Database\Eloquent\Model;

class CropMedia extends Model
{
    protected $fillable = ['crop_id', 'file','extension'];

    public function crop(){
        return $this->belongsTo(Crop::class,'crop_id','id');
    }
}
