<?php

namespace App\Model\Automation\Job;

use App\User;
use Illuminate\Database\Eloquent\Model;

class JobRuling extends Model
{
    protected $fillable = [
        'id',
        'start_date',
        'end_date',
        'user_id',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
