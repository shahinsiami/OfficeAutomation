<?php

namespace App\Model\Panel\Seller;

use App\Model\Panel\Crop\Crop;
use App\Model\Panel\Crop\CropCategory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Seller extends Model
{
    protected $fillable = ['name' , 'phonenumber' , 'imagestore1' , 'imagestore2' , 'imagestore3' , 'seller_evidence_id' , 'crop_category_id' , 'user_id' , 'slug','timagestore1'];
    use Sluggable;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function category(){
        return $this->belongsTo(CropCategory::class,'main_category_id');
    }
    public function sellerAddress(){
        return $this->hasMany(SellerAddress::class);
    }
    public function sellerEevidance(){
        return $this->belongsTo(SellerEvidence::class,'seller_store_evidence_id');
    }

    public function product(){
        return $this->belongsToMany(Crop::class,'seller_store_products')->as('price')->withPivot('price','dprice','startdate', 'enddate','main_event_id', 'color','size','guarantee');
    }
    public function productprice(){
        return $this->belongsToMany(Crop::class,'seller_store_products')->as('price')->withPivot('price','dprice','startdate', 'enddate','main_event_id', 'color','size','guarantee','storeprice');
    }
    public function productwithoutpivot(){
        return $this->belongsToMany(Crop::class,'seller_store_products');
    }
    public function rate(){
        return $this->hasOne(StStoreRate::class);
    }
    public function sellercomment(){
        return $this->hasMany(CommentStore::class);
    }




}
