<?php

namespace App\Http\Controllers\SiteView;

use App\Http\Controllers\Controller;
use App\Model\Panel\Component\ComponentOneColumn;
use Illuminate\Http\Request;

class ViewOneColumnController extends Controller
{
    //////////////////////////////////////////////////////////////////////  viewOneColumn
    public function viewOneColumn(Request $request)
    {
        $OneColumn = ComponentOneColumn::where('page_language_id', $request->language)
            ->where('status', 1)
            ->where('page_template_id', $request->template)
            ->get();
        return response()->json($OneColumn);
    }
    //////////////////////////////////////////////////////////////////////  viewOneColumn

}
