<?php

namespace App\Http\Controllers\SiteView;

use App\Http\Controllers\Controller;
use App\Model\Panel\Component\ComponentAbout;
use Illuminate\Http\Request;


class ViewAboutController extends Controller
{
    //////////////////////////////////////////////////////////////////////  viewAbout
    public function viewAbout(Request $request)
    {
        $baseAbout = ComponentAbout::where('page_language_id', $request->language)
            ->where('status', 1)
            ->where('page_template_id', $request->template)
            ->get();
        return response()->json($baseAbout);
    }
    //////////////////////////////////////////////////////////////////////  viewAbout
}
