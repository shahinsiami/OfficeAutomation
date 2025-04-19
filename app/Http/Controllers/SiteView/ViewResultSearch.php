<?php

namespace App\Http\Controllers\siteView;

use App\Model\Panel\Article\WebArticle;
use App\Model\Panel\Crop\Crop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Crop\CropCategory;
use App\Model\Panel\Crop\CropSegment;
use App\Model\Panel\Crop\CropSubCategory;
use App\Model\Panel\Crop\CropSubSegment;

class ViewResultSearch extends Controller
{
    //////////////////////////////////////////////////////////////////////  viewResultCrop
    public function viewResultCrop(Request $request)
    {
        $category = CropCategory::where('page_language_id',$request->lang)->get('id');
        $subCategory = CropSubCategory::whereIn('crop_category_id',$category)->get('id');
        $segment = CropSegment::whereIn('crop_sub_category_id',$subCategory)->get('id');
        $subSegment = CropSubSegment::whereIn('crop_segment_id',$segment)->get('id');
        $resultCrop = Crop::where('name','like', '%' .$request->search .'%')->whereIn('crop_sub_segment_id',$subSegment)->take(5)->get();
        return $resultCrop;
    }
    //////////////////////////////////////////////////////////////////////  viewResultCrop
    //////////////////////////////////////////////////////////////////////  viewResultArticle
    public function viewResultArticle(Request $request)
    {
        $viewResultArticle = WebArticle::where('description','like', '%' .$request->search .'%')->paginate(7);
        return $viewResultArticle;
    }
    //////////////////////////////////////////////////////////////////////  viewResultArticle
}
