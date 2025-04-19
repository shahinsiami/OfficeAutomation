<?php

namespace App\Model\Automation\Job;

use App\User;
use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    protected $fillable = [
        'id',
        'name',
        'job_classification_id',
        'job_hierarchical_id',
    ];
    public function jobClassification(){
        return $this->belongsTo(JobClassification::class,'job_classification_id');
    }
    public function jobRulling(){
        return $this->hasMany(JobRulingPosition::class,'job_position_id');
    }
    public function user(){
        return $this->hasManyThrough(User::class,JobRulingPosition::class,'job_position_id','id' ,'id','user_id');
    }
}
