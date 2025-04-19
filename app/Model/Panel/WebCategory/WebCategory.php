<?php

namespace App\Model\Panel\WebCategory;

use App\Model\Panel\Article\WebArticle;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class WebCategory extends Model
{

    use Sluggable;
    protected $fillable = ['name' , 'description' , 'priority' , 'event' ,'tag' , 'image' , 'page_template_id' , 'page_language_id' , 'slug'];

    public function subcategory(){
        return $this->hasMany(WebSubCategory::class);
    }
    public function articles()
    {
        return $this->hasMany(WebArticle::class, 'web_category_id');
    }
    public function segment()
    {
        return $this->hasManyThrough(WebSegment::class, WebSubCategory::class ,'web_category_id','web_sub_category_id','id','id');
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
