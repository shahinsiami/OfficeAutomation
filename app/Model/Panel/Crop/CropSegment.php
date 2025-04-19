<?php

namespace App\Model\Panel\Crop;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class CropSegment extends Model
{
    use Sluggable;
    protected $fillable = ['name' , 'description' , 'priority' , 'event' , 'crop_sub_category_id' , 'image' , 'slug'];

    public function subcategory(){
        return $this->belongsTo(CropSubCategory::class,'crop_sub_category_id');
    }

    public function subsegment(){
        return $this->hasMany(CropSubSegment::class);
    }
    public function crop(){
        return $this->hasManyThrough(Crop::class,CropSubSegment::class,'crop_segment_id','crop_sub_segment_id','id','id');
    }




    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
