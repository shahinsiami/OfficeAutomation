<?php

namespace App\Model\Panel\WebCategory;

use App\Model\Panel\Article\WebArticle;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class WebSegment extends Model
{
    use Sluggable;
    protected $fillable = ['name' , 'description' , 'priority' , 'event' , 'web_sub_category_id' , 'image' , 'slug','tag','page_language_id','page_template_id'];

    public function subcategory(){
        return $this->belongsTo(WebSubCategory::class,'web_sub_category_id');
    }
    public function category()
    {
        return $this->hasManyThrough(WebCategory::class, WebSubCategory::class,'id','id' ,'web_sub_category_id','web_category_id');
    }
    public function articles()
    {
        return $this->hasMany(WebArticle::class, 'web_segment_id');
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
