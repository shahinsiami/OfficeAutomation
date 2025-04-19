<?php

namespace App\Http\Controllers\SiteView;


use App\Http\Controllers\Controller;
use App\Model\Panel\Component\ComponentCarousel;
use Illuminate\Http\Request;


class ViewCarouselController extends Controller
{
    //////////////////////////////////////////////////////////////////////  viewCarousel
    public function viewCarousel(Request $request)
    {
        $viewCarousel = ComponentCarousel::where('page_language_id', $request->language)
            ->where('status', 1)
            ->where('page_template_id', $request->template)
            ->get();
        return response()->json($viewCarousel);
    }
    //////////////////////////////////////////////////////////////////////  viewCarousel
}
