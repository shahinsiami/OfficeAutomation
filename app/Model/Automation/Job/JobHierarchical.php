<?php

namespace App\Model\Automation\Job;

use Illuminate\Database\Eloquent\Model;

class JobHierarchical extends Model
{
    protected $fillable = [
        'id',
        'rank',
        'name',
    ];
}
