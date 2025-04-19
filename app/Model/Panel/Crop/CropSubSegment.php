<?php

namespace App\Model\Panel\Crop;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class CropSubSegment extends Model
{
    use Sluggable;
    protected $fillable = ['name' , 'description' , 'priority' , 'crop_event_id' , 'crop_segment_id' , 'image' , 'slug'];

    public function segment(){
        return $this->belongsTo(CropSegment::class,'crop_segment_id');
    }
    public function crop(){
        return $this->hasMany(Crop::class);
    }

    public function event(){
        return $this->belongsTo(CropEvent::class);
    }
    public function detail(){
        return $this->hasOne(CropDetail::class);
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
