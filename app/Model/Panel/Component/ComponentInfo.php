<?php

namespace App\Model\Panel\Component;

use Illuminate\Database\Eloquent\Model;

class ComponentInfo extends Model
{
    protected $fillable = [
        'id' ,
        'type' ,
        'address' ,
        'page_language_id',
        'page_template_id',
        'image1'];
}
