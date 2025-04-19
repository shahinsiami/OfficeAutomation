<?php

namespace App\Model\Panel\Crop;

use Illuminate\Database\Eloquent\Model;

class CropRateUser extends Model
{
    protected $fillable = ['crop_rates_spid','user_id','rate'];
}
