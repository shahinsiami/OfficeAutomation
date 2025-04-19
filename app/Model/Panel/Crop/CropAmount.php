<?php

namespace App\Model\Panel\Crop;

use Illuminate\Database\Eloquent\Model;

class CropAmount extends Model
{
    public $primaryKey  = 'said';
    protected $fillable = ['crop_id', 'salenumber','amount'];

    public function product(){
        return $this->belongsTo(Crop::class);
    }
    public function useramount(){
        return $this->hasMany(CropAmountUser::class);
    }
}
