<?php

namespace App\Http\Controllers\SiteView;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Component\ComponentContact;

class ViewContactController extends Controller
{
    //////////////////////////////////////////////////////////////////////  viewContact
    public function viewContact(Request $request)
    {
        $viewContact = ComponentContact::where('page_language_id', $request->language)
            ->where('status', 1)
            ->where('page_template_id', $request->template)
            ->get();
        return response()->json($viewContact);
    }
    //////////////////////////////////////////////////////////////////////  viewContact
}
