<?php

namespace App\Http\Controllers\SiteView;

use App\Http\Controllers\Controller;
use App\Model\Panel\Component\ComponentThreeColumn;
use Illuminate\Http\Request;



class ViewThreeColumnController extends Controller
{   //////////////////////////////////////////////////////////////////////  viewThreeColumn
    public function viewThreeColumn(Request $request)
    {
        $ThreeColumn = ComponentThreeColumn::where('page_language_id', $request->language)
            ->where('status', 1)
            ->where('page_template_id', $request->template)
            ->get();
        return response()->json($ThreeColumn);
    }
    //////////////////////////////////////////////////////////////////////  viewThreeColumn


}
