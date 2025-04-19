<?php

namespace App\Model\Panel\Article;

use Illuminate\Database\Eloquent\Model;

class WebArticleLike extends Model
{
    protected $fillable = ['id',
        'web_article_id',
        'user_id',
        'ip',
        'agree',
        'disagree',
    ];
}





