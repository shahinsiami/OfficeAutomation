<?php

namespace App\Model\General;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'id',
        'description',
        'dispatch',
        'data' ,
        'route' ,
        'seen' ,
        'user_id' ,
    ];
}
