<?php

namespace App\Model\Panel\Crop;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
class CropCategory extends Model
{
    use Sluggable;
    protected $fillable = ['name' , 'description' , 'priority' , 'event' , 'image', 'slug','page_template_id',
        'page_language_id'];

    public function subcategory(){
        return $this->hasMany(CropSubCategory::class);
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
