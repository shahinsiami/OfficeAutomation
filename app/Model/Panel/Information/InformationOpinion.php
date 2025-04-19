<?php

namespace App\Model\Panel\Information;

use Illuminate\Database\Eloquent\Model;

class InformationOpinion extends Model
{
    protected $fillable = ['name',
    'family' ,
    'title',
    'openion'];
}
