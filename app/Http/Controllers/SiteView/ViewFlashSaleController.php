<?php

namespace App\Http\Controllers\SiteView;

use App\Http\Controllers\Controller;
use App\Model\Panel\Component\ComponentFlashSale;
use Illuminate\Http\Request;

class ViewFlashSaleController extends Controller
{

    //////////////////////////////////////////////////////////////////////  viewFlashSales
    public function viewFlashSales(Request $request)
    {
        $viewFlashSales = ComponentFlashSale::where('page_language_id', $request->language)
            ->where('status', 1)
            ->where('page_template_id', $request->template)
            ->get();
        return response()->json($viewFlashSales);
    }
    //////////////////////////////////////////////////////////////////////  viewFlashSales
}
