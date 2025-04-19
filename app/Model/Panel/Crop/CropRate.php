<?php

namespace App\Model\Panel\Crop;

use Illuminate\Database\Eloquent\Model;

class CropRate extends Model
{
    public $primaryKey  = 'spid';
    protected $fillable = ['crop_id', 'score', 'voter' , 'rate'];

    public function product(){
        return $this->belongsTo(Crop::class);
    }
    public function userrate(){
        return $this->hasMany(CropRateUser::class);
    }
}
