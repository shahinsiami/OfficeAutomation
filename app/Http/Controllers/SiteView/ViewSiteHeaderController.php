<?php

namespace App\Http\Controllers\SiteView;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Component\ComponentHeader;

class ViewSiteHeaderController extends Controller
{
    //////////////////////////////////////////////////////////////////////  viewSiteHeader
    public function viewSiteHeader(Request $request)
    {
        $viewSiteHeader = ComponentHeader::where('page_language_id', $request->language)
            ->where('status', 1)
            ->where('page_template_id', $request->template)
            ->get();
        return response()->json($viewSiteHeader);
    }
    //////////////////////////////////////////////////////////////////////  viewSiteHeader
}
