<?php

namespace App\Http\Controllers\SiteView;

use App\Http\Controllers\Controller;
use App\Model\Panel\Component\ComponentInfo;
use Illuminate\Http\Request;

class ViewInfoController extends Controller
{

    //////////////////////////////////////////////////////////////////////  viewInfo
    public function viewInfo(Request $request)
    {
        $Info = ComponentInfo::where('page_language_id', $request->language)
            ->where('page_template_id', $request->template)
            ->get();
        return response()->json($Info);
    }
    //////////////////////////////////////////////////////////////////////  viewInfo
}
