<?php

namespace App\Http\Controllers\SiteView;

use App\Http\Controllers\Controller;
use App\Model\Panel\Component\ComponentTwoColumn;
use Illuminate\Http\Request;

class ViewTwoColumnController extends Controller
{
    //////////////////////////////////////////////////////////////////////  viewTwoColumn
    public function viewTwoColumn(Request $request)
    {
        $twoColumn = ComponentTwoColumn::where('page_language_id', $request->language)
            ->where('status', 1)
            ->where('page_template_id', $request->template)
            ->get();
        return response()->json($twoColumn);
    }
    //////////////////////////////////////////////////////////////////////  viewTwoColumn

}
