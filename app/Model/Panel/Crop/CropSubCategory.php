<?php

namespace App\Model\Panel\Crop;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class CropSubCategory extends Model
{
    use Sluggable;
    protected $fillable = ['name' , 'description' , 'priority' , 'event' , 'crop_category_id' , 'image' , 'slug'];

    public function category(){
        return $this->belongsTo(CropCategory::class,'crop_category_id');
    }

    public function segment(){
        return $this->hasMany(CropSegment::class);
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
