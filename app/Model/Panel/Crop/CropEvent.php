<?php

namespace App\Model\Panel\Crop;

use Illuminate\Database\Eloquent\Model;

class CropEvent extends Model
{
    protected $fillable = ['name' , 'description' , 'percentage' , 'image'];

    public function subsegment(){
        return $this->hasMany(CropSubSegment::class);
    }
}
