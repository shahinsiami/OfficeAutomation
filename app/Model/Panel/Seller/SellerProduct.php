<?php

namespace App\Model\Panel\Seller;

use App\Model\Panel\Crop\Crop;
use Illuminate\Database\Eloquent\Model;

class SellerProduct extends Model
{
    public $primaryKey  = 'pid';
    protected $fillable = [
        'crop_id',
        'seller_price',
        'discount',
        'site_discount',
        'seller_discount',
        'gain_seller',
        'gain_site',
        'gain_site_with_discount',
        'gain_seller_with_discount',
        'price',
        'price_with_discount',
        'startdate',
        'enddate',
        'count',
        'crop_event_id',
        'seller_addresse_id',
        'color',
        'size',
        'guarantee',
        'seller_id',
    ];
    public function product()
    {
        return $this->belongsTo(Crop::class, 'crop_id');
    }
    public $incrementing = true;
}
