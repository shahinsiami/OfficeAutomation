<?php

namespace App\Model\Panel\Article;

use App\Model\Panel\WebCategory\WebCategory;
use App\Model\Panel\WebCategory\WebSubCategory;
use App\Model\Panel\WebCategory\WebSegment;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class WebArticle extends Model
{
    use Sluggable;

    protected $fillable = ['web_category_id', 'web_sub_category_id', 'web_segment_id','page_language_id', 'title', 'shortdescription', 'description', 'image1', 'image2', 'image3', 'image4', 'image5', 'image6', 'seo', 'slug','tag','writer','priority'];

    public function category(){
        return $this->belongsTo(WebCategory::class,'web_category_id');
    }
    public function subcategory(){
        return $this->belongsTo(WebSubCategory::class,'web_sub_category_id');
    }
    public function segment(){
        return $this->belongsTo(WebSegment::class,'web_segment_id');
    }
    //
    public function articleSub(){
        return $this->hasMany(WebArticleSub::class,'web_article_id');
    }
   //
    public function likeDislike(){
        return $this->hasMany(WebArticleLike::class,'web_article_id');
    }
    public function comment(){
        return $this->hasMany(WebArticleComment::class,'web_article_id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
