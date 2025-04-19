<?php

namespace App\Http\Controllers\SiteView;

use App\Model\Panel\WebCategory\WebCategory;
use App\Model\Panel\WebCategory\WebSegment;
use App\Model\Panel\WebCategory\WebSubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewHeaderController extends Controller
{
    //////////////////////////////////////////////////////////////////////  viewCategoryHeader
    public function viewCategoryHeader(Request $request)
    {
        $categoryHeader = WebCategory::where('slug', $request->slug)->first();
        return response()->json($categoryHeader);
    }
    //////////////////////////////////////////////////////////////////////  viewCategoryHeader
    //////////////////////////////////////////////////////////////////////  viewSubCategoryHeader
    public function viewSubCategoryHeader(Request $request)
    {
        $subCategoryHeader = WebSubCategory::where('slug', $request->slug)->first();;
        return response()->json($subCategoryHeader);
    }
    //////////////////////////////////////////////////////////////////////  viewSubCategoryHeader
    //////////////////////////////////////////////////////////////////////  viewSegmentHeader
    public function viewSegmentHeader(Request $request)
    {
        $viewSegmentHeader = WebSegment::where('slug', $request->slug)->first();
        return response()->json($viewSegmentHeader);
    }
    //////////////////////////////////////////////////////////////////////  viewSegmentHeader
}
