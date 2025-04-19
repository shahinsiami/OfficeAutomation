<?php

namespace App\Model\Panel\Crop;

use App\Model\Panel\Seller\SellerProduct;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    use Sluggable;

    protected $fillable = [
        'id' ,
        'name' ,
        'brand' ,
        'description' ,
        'meta' ,
        'madein' ,
        'packet' ,
        'image1' ,
        'image2' ,
        'image3',
        'image4',
        'image5',
        'image6',
        'image7',
        'image8',
        'image9',
        'image10',
        'timage1',
        'timage2',
        'slug',
        'crop_sub_segment_id',
        'maxprice',
        'minprice',
        ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function subsegment(){
        return $this->belongsTo(CropSubSegment::class,'crop_sub_segment_id');
    }
    public function rate(){
        return $this->hasOne(CropRate::class);
    }
    public function saleaMount(){
        return $this->hasOne(CropAmount::class);
    }
    public function fullDescription(){
        return $this->hasMany(CropDescription::class);
    }
    public function attribute(){
        return $this->hasMany(CropAttribute::class);
    }
    public function media(){
        return $this->hasMany(CropMedia::class);
    }
    public function sellerProduct(){
        return $this->hasMany(SellerProduct::class);
    }
}
