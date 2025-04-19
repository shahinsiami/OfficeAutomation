<?php

namespace App\Model\Panel\Crop;

use Illuminate\Database\Eloquent\Model;

class CropAmountUser extends Model
{
    protected $fillable = ['crop_amounts_said', 'user_id','count','amount'];
}
