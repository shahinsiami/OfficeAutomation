<?php

namespace App\Http\Controllers\SiteView;

use App\Http\Controllers\Controller;
use App\Model\Panel\Component\ComponentManyColumn;
use Illuminate\Http\Request;


class ViewManyColumnController extends Controller
{
    //////////////////////////////////////////////////////////////////////  viewManyColumn
    public function viewManyColumn(Request $request)
    {
        $ManyColumn = ComponentManyColumn::where('page_language_id', $request->language)
            ->where('status', 1)
            ->where('page_template_id', $request->template)
            ->get();
        return response()->json($ManyColumn);
    }
    //////////////////////////////////////////////////////////////////////  viewManyColumn



}
