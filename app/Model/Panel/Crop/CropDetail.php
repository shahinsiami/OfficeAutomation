<?php

namespace App\Model\Panel\Crop;

use Illuminate\Database\Eloquent\Model;

class CropDetail extends Model
{
    protected $fillable = ['name' , 'description' , 'attribute' , 'details' , 'crop_sub_segment_id' ];

    public function subsegment(){
        return $this->hasOne(CropSubSegment::class);
    }
}
