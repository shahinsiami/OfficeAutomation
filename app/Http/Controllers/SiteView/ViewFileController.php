<?php

namespace App\Http\Controllers\SiteView;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Component\ComponentManyColumnFile;

class ViewFileController extends Controller
{
    //////////////////////////////////////////////////////////////////////  viewManyColumnFile
    public function viewManyColumnFile(Request $request)
    {
        $FourColumn = ComponentManyColumnFile::where('page_language_id', $request->language)
            ->where('status', 1)
            ->where('page_template_id', $request->template)
            ->get();
        return response()->json($FourColumn);
    }
    //////////////////////////////////////////////////////////////////////  viewManyColumnFile
}
