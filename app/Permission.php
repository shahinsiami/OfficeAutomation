<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'user_id',
        'permission_id',
    ];
    protected $hidden = [
        'pivot'
    ];
}
