<?php

namespace App\Http\Controllers\Panel\Main;

use App\Model\Panel\Main\PageLanguage;
use App\Model\Panel\Main\PageTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class MainController extends Controller
{
    /////////////////////////////////////////////////////////////////////////////////////language
    public function language()
    {
        if (Gate::allows('administrator')) {
            $language = PageLanguage::get();
            return response()->json($language);
        }

    }
    /////////////////////////////////////////////////////////////////////////////////////language
    /////////////////////////////////////////////////////////////////////////////////////template
    public function template()
    {
        if (Gate::allows('administrator')) {
            $template = PageTemplate::get();
            return response()->json($template);
        }

    }
    /////////////////////////////////////////////////////////////////////////////////////template
}
