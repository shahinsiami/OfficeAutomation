<?php

namespace App\Model\Panel\Article;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class WebArticleSub extends Model
{
    use Sluggable;

    protected $fillable = ['web_article_id','page_language_id', 'title', 'shortdescription', 'description', 'image1', 'image2', 'image3', 'image4', 'image5', 'image6', 'seo', 'slug','tag','priority'];

    public function article(){
        return $this->belongsTo(WebArticle::class,'web_article_id');
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
