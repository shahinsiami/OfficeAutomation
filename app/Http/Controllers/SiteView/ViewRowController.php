<?php

namespace App\Http\Controllers\SiteView;

use App\Http\Controllers\Controller;
use App\Model\Panel\Component\ComponentRow;
use Illuminate\Http\Request;

class ViewRowController extends Controller
{
    //////////////////////////////////////////////////////////////////////  viewRow
    public function viewRow(Request $request)
    {
        $Row = ComponentRow::where('page_language_id', $request->language)
            ->where('status', 1)
            ->where('page_template_id', $request->template)
            ->get();
        return response()->json($Row);
    }
    //////////////////////////////////////////////////////////////////////  viewRow


}
