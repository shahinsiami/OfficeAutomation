<?php

namespace App\Model\Automation\Job;

use Illuminate\Database\Eloquent\Model;

class JobClassification extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];
    public function jobposition(){
        return $this->hasMany(JobPosition::class,'job_classification_id');
    }
}
