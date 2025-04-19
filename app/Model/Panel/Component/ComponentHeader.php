<?php

namespace App\Model\Panel\Component;

use Illuminate\Database\Eloquent\Model;

class ComponentHeader extends Model
{
    protected $fillable = ['id' ,
        'name' ,
        'section' ,
        'image1' ,
        'image2' ,
        'title1' ,
        'title2',
        'title3',
        'title4',
        'title5',
        'title6',
        'description',
        'link',
        'seo',
        'status',
        'type' ,
        'page_template_id',
        'page_language_id'];
}
