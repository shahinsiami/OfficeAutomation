<?php

namespace App\Model\Panel\Component;

use Illuminate\Database\Eloquent\Model;

class ComponentThreeColumn extends Model
{
    protected $fillable = ['id' ,
        'name' ,
        'section' ,
        'image1' ,
        'image2' ,
        'title1' ,
        'title2',
        'title3',
        'description',
        'link',
        'seo',
        'status',
        'type' ,
        'page_template_id',
        'page_language_id'];
}
