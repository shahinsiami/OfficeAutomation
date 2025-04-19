<?php

namespace App\Http\Controllers\SiteView;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Information\InformationOpinion;

class InformationOpinionController extends Controller
{
     /////////////////////////////////////////////////////////////////////////////////////registerOpinion
  public function registerOpinion(Request $request)
  {

              InformationOpinion::create($request->all());
              return 'success';
      
  }
  /////////////////////////////////////////////////////////////////////////////////////registerOpinion
}
