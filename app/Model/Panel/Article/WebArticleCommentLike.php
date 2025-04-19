<?php

namespace App\Model\Panel\Article;

use Illuminate\Database\Eloquent\Model;

class WebArticleCommentLike extends Model
{
    protected $fillable = ['id','web_article_comment_id',
        'user_id',
        'ip',
        'liketype',

    ];
}
