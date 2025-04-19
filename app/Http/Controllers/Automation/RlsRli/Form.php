<?php

namespace App\Http\Controllers\Automation\RlsRli;

use App\Model\Automation\Job\JobPosition;
use App\Model\Automation\Letters\Draft\DlsDlrReferral;
use App\Model\Automation\Letters\Exterior\Receive\ElrReferral;
use App\Model\Automation\Letters\Interior\IlsIlrReferral;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Traits;
use Illuminate\Support\Facades\Validator;

class Form extends Controller
{
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  allUserForrls
    public function allUserForrls(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {

            $allUserForIlrIls = JobPosition::with(['user' => function ($query) {
                $query->select(['id'])->with('userinfo:user_id,name,family')->get();
            }])->get();
            $users = [];
            foreach ($allUserForIlrIls as $item) {
                if (sizeof($item->user)) {

                    foreach ($item->user as $array) {
                        if (preg_match("/{$request->searchName}/i", $item->user[0]->userinfo->name) or preg_match("/{$request->searchName}/i", $item->user[0]->userinfo->family))
                            array_push($users, $array);
                    }
                }
            }

            return response()->json($users);
        }
    }
    //////////////////////////////////////////////////////////////////////  allUserForrls
    //////////////////////////////////////////////////////////////////////  rlsIlRegister
    public function rlsIlRegister(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'description' => 'required',
                'receivers' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //
            $rls = IlsIlrReferral::create([
                'user_id' => auth()->user()->id,
                'ils_ilr_id' => $request->id,
                'note' => $request->note,
                'description' => $request->description,
            ]);

            $allReceiver = [];
            if ($request->receivers !== null) {
                foreach (json_decode($request->receivers) as $receiver) {
                    array_push($allReceiver, $receiver->userinfo->user_id);
                }
                $rls->receiver()->sync($allReceiver);
            }
            foreach ($allReceiver as $notification) {
                User::where('id',$notification)->first()->getNotification()->create([
                    'description'=> ' ارجاع نامه داخلی جدید از طرف '. auth()->user()->userinfo()->first()->family,
                    'dispatch'=> json_encode(['RefferalStore','SelectRlsIl']),
                    'data' => $rls->id,
                    'route' => 'rlsIlView',
                    'seen' => 0,
                    'user_id' => $notification,
                ]);
            }
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  rlsIlRegister
    //////////////////////////////////////////////////////////////////////  rlsElRegister
    public function rlsElRegister(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'description' => 'required',
                'receivers' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //
            $res = ElrReferral::create([
                'user_id' => auth()->user()->id,
                'elr_id' => $request->id,
                'note' => $request->note,
                'description' => $request->description,
            ]);

            $allReceiver = [];
            if ($request->receivers !== null) {
                foreach (json_decode($request->receivers) as $receiver) {
                    array_push($allReceiver, $receiver->userinfo->user_id);
                }
                $res->receiver()->sync($allReceiver);
            }
            foreach ($allReceiver as $notification) {
                User::where('id',$notification)->first()->getNotification()->create([
                    'description'=> ' ارجاع نامه خارجی جدید از طرف '. auth()->user()->userinfo()->first()->family,
                    'dispatch'=> json_encode(['RefferalStore','SelectRlsEl']),
                    'data' => $res->id,
                    'route' => 'rlsElView',
                    'seen' => 0,
                    'user_id' => $notification,
                ]);
            }
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  rlsElRegister
    //////////////////////////////////////////////////////////////////////  rlsIlTable
    public function rlsIlTable(Request $request)
    {

        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $rlsIlTable = IlsIlrReferral::where('user_id', auth()->user()->id)->with(['receiver'=>function($query){
                $query->with('userinfo')->get();
            }])->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($rlsIlTable);
        }
    }
    //////////////////////////////////////////////////////////////////////  rlsIlTable
    //////////////////////////////////////////////////////////////////////  rlrIlTable
    public function rlrIlTable(Request $request)
    {

        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $rlsIlTable = auth()->user()->rlsIl()->with(['receiver'=>function($query){
                $query->with('userinfo')->get();
            }])->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($rlsIlTable);
        }


    }
    //////////////////////////////////////////////////////////////////////  rlrIlTable
    //////////////////////////////////////////////////////////////////////  SelectRlsIl
    public function SelectRlsIl($id)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $SelectRlsIl = IlsIlrReferral::where('id', $id)->with(['ilsIlr' =>  function($query){
                $query->with(['context','summary','attachment','document','receiver'=>
                    function($query){
                        $query->with('userinfo')->get();
                    }
                ]);
            }])
          ->first();
            return response()->json($SelectRlsIl);
        }
    }
    //////////////////////////////////////////////////////////////////////  SelectRlsIl
    //////////////////////////////////////////////////////////////////////  rlrElTable
    public function rlrElTable(Request $request)
    {

        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $rlsIlTable = auth()->user()->rlsEl()->with(['receiver'=>function($query){
                $query->with('userinfo')->get();
            }])->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($rlsIlTable);
        }
    }
    //////////////////////////////////////////////////////////////////////  rlrElTable
    //////////////////////////////////////////////////////////////////////  rlsElTable
    public function rlsElTable(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $rlsIlTable = ElrReferral::where('user_id', auth()->user()->id)->with(['receiver'=>function($query){
                $query->with('userinfo')->get();
            }])->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($rlsIlTable);
        }

    }
    //////////////////////////////////////////////////////////////////////  rlsElTable
    //////////////////////////////////////////////////////////////////////  SelectRlsEl
    public function SelectRlsEl($id)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $SelectRlsIl = ElrReferral::where('id', $id)->with(['elr' =>  function($query){
                $query->with(['context','summary','attachment','document','receiver'=>
                    function($query){
                        $query->with('userinfo')->get();
                    }
                ]);
            }])
                ->first();
            return response()->json($SelectRlsIl);
        }
    }
    //////////////////////////////////////////////////////////////////////  SelectRlsEl
    //////////////////////////////////////////////////////////////////////  rlsDlRegister
    public function rlsDlRegister(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'description' => 'required',
                'receivers' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //
            $dlsRefferal = DlsDlrReferral::create([
                'user_id' => auth()->user()->id,
                'dls_dlr_id' => $request->id,
                'note' => $request->note,
                'description' => $request->description,
            ]);

            $allReceiver = [];
            if ($request->receivers !== null) {
                foreach (json_decode($request->receivers) as $receiver) {
                    array_push($allReceiver, $receiver->userinfo->user_id);
                }
                $dlsRefferal->receiver()->sync($allReceiver);
            }
            foreach ($allReceiver as $notification) {
                User::where('id',$notification)->first()->getNotification()->create([
                    'description'=> ' ارجاع نامه خارجی جدید از طرف '. auth()->user()->userinfo()->first()->family,
                    'dispatch'=> json_encode(['RefferalStore','SelectRlsDl']),
                    'data' => $dlsRefferal->id,
                    'route' => 'rlsDlView',
                    'seen' => 0,
                    'user_id' => $notification,
                ]);
            }
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  rlsDlRegister
    //////////////////////////////////////////////////////////////////////  rlrDlTable
    public function rlrDlTable(Request $request)
    {

        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $rlsIlTable = auth()->user()->rlsDl()->with(['receiver'=>function($query){
                $query->with('userinfo')->get();
            }])->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($rlsIlTable);
        }
    }
    //////////////////////////////////////////////////////////////////////  rlrDlTable
    //////////////////////////////////////////////////////////////////////  rlsDlTable
    public function rlsDlTable(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $rlsIlTable = DlsDlrReferral::where('user_id', auth()->user()->id)->with(['receiver'=>function($query){
                $query->with('userinfo')->get();
            }])->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($rlsIlTable);
        }

    }
    //////////////////////////////////////////////////////////////////////  rlsDlTable
    //////////////////////////////////////////////////////////////////////  SelectRlsDl
    public function SelectRlsDl($id)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $SelectDlrDls = DlsDlrReferral::where('id', $id)->with(['dlrDls' =>  function($query){
                $query->with(['context','summary','attachment','document','receiver'=>
                    function($query){
                        $query->with('userinfo')->get();
                    }
                ]);
            }])
                ->first();
            return response()->json($SelectDlrDls);
        }
    }
    //////////////////////////////////////////////////////////////////////  SelectRlsDl
}


