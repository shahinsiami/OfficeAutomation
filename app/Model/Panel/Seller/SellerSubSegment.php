<?php

namespace App\Model\Panel\Seller;

use Illuminate\Database\Eloquent\Model;

class SellerSubSegment extends Model
{
    protected $fillable = ['percentage' , 'crop_sub_segment_id' , 'subsegmentname' , 'seller_id' , 'storename'];
}
