<?php

namespace App\Http\Controllers\Panel\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Crop\Crop;
use App\Model\Panel\Crop\CropEvent;
use App\Model\Panel\Crop\CropSubSegment;
use App\Model\Panel\Seller\SellerProduct;
use App\Model\Panel\Seller\SellerSubSegment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

use App\Traits;

class SellerProductController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;
    //////////////////////////////////////////////////////////////////////  allCropSubSegmentForSellerProdcut
    public function allCropSubSegmentForSellerProdcut()
    {
        if (Gate::allows('administrator')) {
            $allCropSubSegmentForSellerProdcut = CropSubSegment::all();
            return response()->json($allCropSubSegmentForSellerProdcut);
        }
    }
    //////////////////////////////////////////////////////////////////////  allCropSubSegmentForSellerProdcut
    //////////////////////////////////////////////////////////////////////  allCropSubSegmentForSellerProdcut
    public function productForSellerProduct()
    {
        if (Gate::allows('administrator')) {
            $productForSellerProduct = Crop::all();
            return response()->json($productForSellerProduct);
        }
    }
    //////////////////////////////////////////////////////////////////////  productForSellerProduct
    //////////////////////////////////////////////////////////////////////  productForSellerProdcutBySelection
    public function productForSellerProdcutBySelection($id)
    {
        if (Gate::allows('administrator')) {
            $productForSellerProdcutBySelection = CropSubSegment::get()->where('id', $id)->first()->crop()->get();
            return response()->json($productForSellerProdcutBySelection);
        }
    }
    //////////////////////////////////////////////////////////////////////  productForSellerProdcutBySelection
   //////////////////////////////////////////////////////////////////////  allEventForSellerProduct
   public function allEventForSellerProduct()
   {
       if (Gate::allows('administrator')) {
           $allEventForSellerProduct = CropEvent::all();
           return response()->json($allEventForSellerProduct);
       }
   }
   //////////////////////////////////////////////////////////////////////  allEventForSellerProduct
    //////////////////////////////////////////////////////////////////////  sellerAddressForSellerProdcut
    public function sellerAddressForSellerProdcut()
    {
        if (Gate::allows('administrator')) {
            $sellerAddressForSellerProdcut = auth()->user()->first()->seller()->first()->sellerAddress()->get();
            return response()->json($sellerAddressForSellerProdcut);
        }
    }
    //////////////////////////////////////////////////////////////////////  sellerAddressForSellerProdcut
    //////////////////////////////////////////////////////////////////////  registerArticle
    public function registerSellerProduct(Request $request)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'crop_id' => 'required',
                'count' => 'required',
                'discount' => 'required',
                'seller_price' => 'required',
                'crop_sub_segment_id' => 'required',
            ]);
            $seller_id=auth()->user()->first()->seller()->first()->id;
            $percentage = 1;
            if(SellerSubSegment::where('seller_id' , $seller_id)->where('crop_sub_segment_id',$request->crop_sub_segment_id)->exists()){
                $percentage = SellerSubSegment::where('seller_id' , $seller_id)->where('crop_sub_segment_id',$request->crop_sub_segment_id)->first()->percentage;
            }
            $price=$request->seller_price;
            $gain_seller=$request->seller_price - (($request->seller_price * $percentage)/100);
            $gain_site=(($request->seller_price * $percentage)/100);
            $price_with_discount=$request->seller_price - (($request->seller_price * $request->discount)/100);
            $site_discount= ((($request->seller_price * $request->discount)/100)*$percentage)/100;
            $seller_discount= ($request->seller_price * $request->discount)/100;
            $gain_site_with_discount=$gain_site - $site_discount;
            $gain_seller_with_discount=$gain_seller - $seller_discount;
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                    SellerProduct ::create( array_merge($request->all(),
                    array('seller_id' => $seller_id),
                    array('site_discount' => $site_discount),
                    array('seller_discount' => $seller_discount),
                    array('price' => $price),
                    array('price_with_discount' => $price_with_discount),
                    array('gain_site' => $gain_site),
                    array('gain_site_with_discount' => $gain_site_with_discount),
                    array('gain_seller' => $gain_seller),
                    array('gain_seller_with_discount' => $gain_seller_with_discount)));


                    return $this->vSuccess();
        }

    }
    //////////////////////////////////////////////////////////////////////  registerSellerProduct
    //////////////////////////////////////////////////////////////////////  sellerProductTable
     public function sellerProductTable(Request $request)
     {
         if (Gate::allows('administrator')) {
            //  return auth()->user()->first()->seller()->first()->id;
             $sellerEvidenceTable = SellerProduct::with('product')->where('seller_id',auth()->user()->first()->seller()->first()->id)->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
             return response()->json($sellerEvidenceTable);
 
         }
     }
    //////////////////////////////////////////////////////////////////////  sellerProductTable
    //////////////////////////////////////////////////////////////////////  selectSellerProduct
    public function selectSellerProduct($id)
    {
        {
            if (Gate::allows('administrator')) {
                $selectSellerProduct = SellerProduct::with('product')->find($id);
                return response()->json($selectSellerProduct);
            }
        }
    }
    //////////////////////////////////////////////////////////////////////  selectSellerProduct
    //////////////////////////////////////////////////////////////////////  editSellerProduct
    public function editSellerProduct(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'crop_id' => 'required',
            'count' => 'required',
            'discount' => 'required',
            'seller_price' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->vError($validator->errors());
        }
        //validator//
        if (Gate::allows('administrator')) {
            $seller_id=auth()->user()->first()->seller()->first()->id;
            $percentage = 1;
            if(SellerSubSegment::where('seller_id' , $seller_id)->where('crop_sub_segment_id',$request->crop_sub_segment_id)->exists()){
                $percentage = SellerSubSegment::where('seller_id' , $seller_id)->where('crop_sub_segment_id',$request->crop_sub_segment_id)->first()->percentage;
            }
            $price=$request->seller_price;
            $gain_seller=$request->seller_price - (($request->seller_price * $percentage)/100);
            $gain_site=(($request->seller_price * $percentage)/100);
            $price_with_discount=$request->seller_price - (($request->seller_price * $request->discount)/100);
            $site_discount= ((($request->seller_price * $request->discount)/100)*$percentage)/100;
            $seller_discount= ($request->seller_price * $request->discount)/100;
            $gain_site_with_discount=$gain_site - $site_discount;
            $gain_seller_with_discount=$gain_seller - $seller_discount;
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
            $sellerProductEdit = SellerProduct::find($id);
                    $sellerProductEdit->update( array_merge($request->all(),
                    array('seller_id' => $seller_id),
                    array('site_discount' => $site_discount),
                    array('seller_discount' => $seller_discount),
                    array('price' => $price),
                    array('price_with_discount' => $price_with_discount),
                    array('gain_site' => $gain_site),
                    array('gain_site_with_discount' => $gain_site_with_discount),
                    array('gain_seller' => $gain_seller),
                    array('gain_seller_with_discount' => $gain_seller_with_discount)));
                    return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editSellerProduct
}
