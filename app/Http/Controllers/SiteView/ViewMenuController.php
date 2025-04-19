<?php

namespace App\Http\Controllers\SiteView;

use App\Model\Panel\WebCategory\WebCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewMenuController extends Controller
{
    //////////////////////////////////////////////////////////////////////  baseMenu
    public function baseMenu(Request $request)
    {
        $baseMenu = WebCategory::where('page_template_id','!=',100)->
        where('page_template_id','!=',101)->
        where('page_language_id',$request->language)->with(['subcategory' => function ($query) {
            $query->with(['segment' => function($query){
                $query->orderby('priority');
            }])->orderby('priority');
        }])
            ->orderby('priority')->get();
        return response()->json($baseMenu);
    }
    //////////////////////////////////////////////////////////////////////  baseMenu
}
