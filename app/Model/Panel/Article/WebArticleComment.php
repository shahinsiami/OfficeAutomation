<?php

namespace App\Model\Panel\Article;

use Illuminate\Database\Eloquent\Model;

class WebArticleComment extends Model
{
    protected $fillable = ['id','web_article_id',
        'user_id',
        'status',
        'agree',
        'disagree',
        'title',
        'body',
        'ip',
    ];


}
