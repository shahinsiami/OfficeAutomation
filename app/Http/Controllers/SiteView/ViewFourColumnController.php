<?php

namespace App\Http\Controllers\SiteView;

use App\Http\Controllers\Controller;
use App\Model\Panel\Component\ComponentFourColumn;
use Illuminate\Http\Request;



class ViewFourColumnController extends Controller
{
    //////////////////////////////////////////////////////////////////////  viewFourColumn
    public function viewFourColumn(Request $request)
    {
        $FourColumn = ComponentFourColumn::where('page_language_id', $request->language)
            ->where('status', 1)
            ->where('page_template_id', $request->template)
            ->get();
        return response()->json($FourColumn);
    }
    //////////////////////////////////////////////////////////////////////  viewFourColumn
}
