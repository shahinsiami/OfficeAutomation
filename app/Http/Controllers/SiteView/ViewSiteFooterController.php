<?php

namespace App\Http\Controllers\SiteView;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Component\ComponentFooter;

class ViewSiteFooterController extends Controller
{
     //////////////////////////////////////////////////////////////////////  viewSiteFooter
     public function viewSiteFooter(Request $request)
     {
         $viewSiteFooter = ComponentFooter::where('page_language_id', $request->language)
             ->where('status', 1)
             ->where('page_template_id', $request->template)
             ->get();
         return response()->json($viewSiteFooter);
     }
     //////////////////////////////////////////////////////////////////////  viewSiteFooter
}
