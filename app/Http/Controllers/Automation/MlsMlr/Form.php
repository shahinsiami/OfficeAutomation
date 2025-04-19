<?php

namespace App\Http\Controllers\Automation\MlsMlr;

use App\Model\Automation\Job\JobPosition;
use App\Model\Automation\Message\MlsMlr;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Traits;

class Form extends Controller
{
     use Traits\validatorError;
    //////////////////////////////////////////////////////////////////////  allUserForMlsMlr
    public function allUserForMlsMlr(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {

            $allUserForMlsMlr = JobPosition::with(['user'=>function($query){
                $query->select(['id'])->with('userinfo:user_id,name,family')->get();
            }])->get();
            $users = [];
            foreach ($allUserForMlsMlr as $item){
                if(sizeof($item->user)){

                    foreach ($item->user as $array){
                        if(preg_match("/{$request->searchName}/i", $item->user[0]->userinfo->name) or preg_match("/{$request->searchName}/i", $item->user[0]->userinfo->family))
                            array_push($users,$array);
                    }
                }
            }

            return response()->json($users);
        }
    }
    //////////////////////////////////////////////////////////////////////  allUserForMlsMlr
    //////////////////////////////////////////////////////////////////////  mlsMlrRegister
    public function mlsMlrRegister(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $validator = Validator::make($request->all(), [
                'sender' => 'required',
                'receivers' => 'required',
                'title' => 'required',
                'context' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            $mlsMlr = MlsMlr::create([
                'sender' => $request->sender,
                'user_id' => auth()->user()->id,
                'context' => $request->context,
                'title' => $request->title,
            ]);
            $allreceiver = [];
            if ($request->receivers !== null) {
                foreach (json_decode($request->receivers) as $receiver) {
                    array_push($allreceiver, $receiver->userinfo->user_id);
                }
                $mlsMlr->receiver()->sync($allreceiver);
            }
            foreach ($allreceiver as $notification) {
                User::where('id',$notification)->first()->getNotification()->create([
                    'description'=> ' پیغام از طرف '. $request->sender,
                    'dispatch'=> json_encode(['MlsMlrStore','selectMlr']),
                    'data' => $mlsMlr->id,
                    'route' => 'mlrView',
                    'seen' => 0,
                    'user_id' => $notification,
                ]);
            }
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  mlsMlrRegister
    //////////////////////////////////////////////////////////////////////  mlrTable
    public function mlrTable(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $mlrTable = auth()->user()->mlsMlr()->with(['receiver'=>function($query){
                $query->with('userinfo')->get();
            }])->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($mlrTable);
//
        }
    }
    //////////////////////////////////////////////////////////////////////  mlrTable
    //////////////////////////////////////////////////////////////////////  mlsTable
    public function mlsTable(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $mlsTable = MlsMlr::where('user_id', auth()->user()->id)->with(['receiver'=>function($query){
                $query->with('userinfo')->get();
            }])->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($mlsTable);
        }
    }
    //////////////////////////////////////////////////////////////////////  mlsTable
    //////////////////////////////////////////////////////////////////////  selectMlr
    public function selectMlr($id)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $selectEls = MlsMlr::where('id', $id)->with(['receiver'=>
                function($query){
                    $query->with('userinfo')->get();
                }
            ])->first();
            return response()->json($selectEls);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectMlr
}


