<?php

namespace App\Http\Controllers\Automation\CelrEls;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Automation\Letters\Exterior\Receive\Elr;
use App\Model\Automation\Letters\Exterior\Send\Els;
use App\Model\Automation\Job\JobPosition;
use App\Model\Automation\Secretary\Document;
use App\Model\Automation\Secretary\SecretaryPort;
use App\UserInfo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Traits;
use Illuminate\Support\Facades\File;

class Form extends Controller
{
    use Traits\validatorError;
    //////////////////////////////////////////////////////////////////////  cElrTable
    public function cElrTable(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {

            $elrTable = auth()->user()->elr()->with(['receiver'=>function($query){
                $query->with('userinfo')->get();
            }])->with('summary')->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($elrTable);

        }
    }
    //////////////////////////////////////////////////////////////////////  cElrTable
    //////////////////////////////////////////////////////////////////////  selectcElrView
    public function selectcElrView($id)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $selectElr = Elr::where('id', $id)->with(['summary','attachment','document','receiver'=>
                function($query){
                    $query->with('userinfo')->get();
                }
            ])->first();
            return response()->json($selectElr);

        }
    }
    //////////////////////////////////////////////////////////////////////  selectcElrView
    //////////////////////////////////////////////////////////////////////  cElsTable
    public function cElsTable(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {

            $elsTable = auth()->user()->els()->with(['sender'=>function($query){
                $query->with('userinfo')->get();
            }])->with('summary')->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($elsTable);

        }
    }
    //////////////////////////////////////////////////////////////////////  cElsTable
    //////////////////////////////////////////////////////////////////////  selectcElsView
    public function selectcElsView($id)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $selectElr = Els::where('id', $id)->with(['summary','attachment','document','sender'=>
                function($query){
                    $query->with('userinfo')->get();
                }
            ])->first();
            return response()->json($selectElr);

        }
    }
    //////////////////////////////////////////////////////////////////////  selectcElsView
}

