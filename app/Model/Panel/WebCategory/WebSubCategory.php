<?php

namespace App\Model\Panel\WebCategory;

use App\Model\Panel\Article\WebArticle;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class WebSubCategory extends Model
{
    use Sluggable;
    protected $fillable = ['name' , 'description' , 'priority' , 'event' , 'web_category_id' , 'image' , 'slug','tag','page_language_id','page_template_id'];

    public function category(){
        return $this->belongsTo(WebCategory::class,'web_category_id');
    }
    public function articles()
    {
        return $this->hasMany(WebArticle::class, 'web_sub_category_id');
    }
    public function segment(){
        return $this->hasMany(WebSegment::class);
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
