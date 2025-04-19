<?php

namespace App\Http\Controllers\SiteView;

use App\Events\SendMailEmploymentEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Information\InformationEmployment;
use App\Traits;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class InformationEmploymentController extends Controller
{
  /////////////////////////////////////////////////////////////////////////////////////registerEmployment
  public function registerEmployment(Request $request)
  {

              InformationEmployment::create($request->all());
              $information = implode(",", $request->all());
              event(new SendMailEmploymentEvent('info@vpc.co.ir',$information));
              return 'success';
      
  }
  /////////////////////////////////////////////////////////////////////////////////////registerEmployment
}
