<?php

namespace App\Model\Panel\Information;

use Illuminate\Database\Eloquent\Model;

class InformationEmployment extends Model
{
    protected $fillable = ['name',
        'family' ,
        'phonenumber',
        'address',
        'about',
        'age',
        'job_position',
        'education',
        'job_experience',
        'articles'];
}




