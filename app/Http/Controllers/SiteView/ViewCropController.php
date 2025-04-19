<?php

namespace App\Http\Controllers\SiteView;

use App\Model\Panel\Crop\Crop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Crop\CropCategory;
use App\Model\Panel\Crop\CropSegment;
use App\Model\Panel\Crop\CropSubCategory;
use App\Model\Panel\Crop\CropSubSegment;

class ViewCropController extends Controller
{
    //////////////////////////////////////////////////////////////////////  viewAllCrop
    public function viewAllCrop()
    {
        $viewAllCrop = Crop::get();
        return response()->json($viewAllCrop);
    }
    //////////////////////////////////////////////////////////////////////  viewAllCrop
    //////////////////////////////////////////////////////////////////////  viewSingleCrop
    public function viewSingleCrop(Request $request)
    {
        $viewAllCrop = Crop::where('slug', $request->slug)->get();
        return response()->json($viewAllCrop);
    }
    //////////////////////////////////////////////////////////////////////  viewSingleCrop
    //////////////////////////////////////////////////////////////////////  cropByCategory
    public function cropByCategory(Request $request)
    {
        $cropByCategory = CropCategory::where('slug', $request->slug)->first()->subcategory()->first()->segment()->with(['crop' => function ($query) {
            $query->limit(100);
        }])->limit(100)->get();
        return $cropByCategory;
    }
    //////////////////////////////////////////////////////////////////////  cropByCategory
    //////////////////////////////////////////////////////////////////////  cropBySubCategory
    public function cropBySubCategory(Request $request)
    {
        $cropBySubCategory = CropSubCategory::where('slug', $request->slug)->first()->segment()->with(['crop' => function ($query) {
            $query->limit(100);
        }])->limit(100)->get();
        return $cropBySubCategory;
    }
    //////////////////////////////////////////////////////////////////////  cropBySubCategory
    //////////////////////////////////////////////////////////////////////  cropBySegment
    public function cropBySegment(Request $request)
    {
        $cropBySegment = CropSegment::where('slug', $request->slug)->first()->subsegment()->with(['crop' => function ($query) {
            $query->limit(100);
        }])->limit(100)->get();
        return $cropBySegment;
    }
    //////////////////////////////////////////////////////////////////////  cropBySegment
    //////////////////////////////////////////////////////////////////////  cropBySubSegment
    public function cropBySubSegment(Request $request)
    {
        $cropBySubSegment = CropSubSegment::where('slug', $request->slug)->first()->crop()->limit(100)->get();
        return $cropBySubSegment;
    }
    //////////////////////////////////////////////////////////////////////  cropBySubSegment
    //////////////////////////////////////////////////////////////////////  cropDetail
    public function cropDetail(Request $request)
    {
        $cropDetail = Crop::where('slug', $request->slug)->with(['saleaMount', 'attribute', 'media', 'rate', 'fullDescription', 'sellerProduct'])->first();
        return $cropDetail;
    }
    //////////////////////////////////////////////////////////////////////  cropDetail
    //////////////////////////////////////////////////////////////////////  cropCarousel
    public function cropCarousel(Request $request)
    {
        $cropCarousel = Crop::where('slug', $request->slug)->first()->subsegment()->first()->crop()->take(100)->get();
        return $cropCarousel;
    }
    //////////////////////////////////////////////////////////////////////  cropCarousel
    //////////////////////////////////////////////////////////////////////  cropCategory
    public function cropCategory(Request $request)
    {
        $cropCategory = Crop::where('slug', $request->slug)->with(
            ['subsegment' => function ($query) {
                $query->with(['segment' => function($query){
                    $query->with(['subcategory' => function ($query) {
                        $query->with(['category' => function ($query) {
                        $query->first();
                        }])->first();
                    }])->first();
                }])->first();
            }]
        )->first();
        return $cropCategory;
    }
    //////////////////////////////////////////////////////////////////////  cropCategory
    //////////////////////////////////////////////////////////////////////  resultCrop
    public function resultCrop(Request $request)
    {
        $resultCrop = Crop::where('name', 'like', '%' . $request->search . '%')->take(5)->get();
        return $resultCrop;
    }
    //////////////////////////////////////////////////////////////////////  resultCrop
}
