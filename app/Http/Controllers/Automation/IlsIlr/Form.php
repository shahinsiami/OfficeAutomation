<?php

namespace App\Http\Controllers\Automation\IlsIlr;

use App\Model\Automation\Secretary\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Model\Automation\Letters\Interior\IlsIlr;
use App\Traits;
use Illuminate\Support\Facades\File;
use App\UserInfo;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Model\Automation\Job\JobPosition;

class Form extends Controller
{
    use Traits\validatorError;
    //////////////////////////////////////////////////////////////////////  allUserForIlrIls
    public function allUserForIlrIls(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {

            $allUserForIlrIls = JobPosition::with(['user'=>function($query){
                $query->select(['id'])->with('userinfo:user_id,name,family')->get();
            }])->get();
            $users = [];
            foreach ($allUserForIlrIls as $item){
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
    //////////////////////////////////////////////////////////////////////  allUserForIlrIls
    //////////////////////////////////////////////////////////////////////  allDocumentForIls
    public function allDocumentForIls(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {

            $allDocumentForIls = Document::where('name', 'like', '%' . $request->searchName . '%')->limit(100)->get();
            return response()->json($allDocumentForIls);
        }
    }
    //////////////////////////////////////////////////////////////////////  allDocumentForIls
    //////////////////////////////////////////////////////////////////////  ilsIlrRegister
    public function ilsIlrRegister(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $validator = Validator::make($request->all(), [
                'sender' => 'required',
                'receivers' => 'required',
                'security' => 'required',
                'letter_priority' => 'required',
                'hint' => 'required',
                'subject' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            $ilsIlr = IlsIlr::create([
                'sender' => $request->sender,
                'user_id' => auth()->user()->id,
                'security' => $request->security,
                'letter_priority' => $request->letter_priority,
            ]);
            if($request->context){
                $ilsIlr->context()->create([
                    'content' => $request->context,
                ]);
            }

            $ilsIlr->summary()->create([
                'hint' => $request->hint,
                'summary' => $request->summary,
                'subject' => $request->subject,
                'note' => $request->note,
            ]);

            if ($request->attachment !== null) {
                $path = 'Data/Letter/Interior/' . Carbon::today()->toDateString() . '/' . $request->sender;
                if (!file_exists($path)) {
                    File::makeDirectory($path, $mode = 0777, true, true);
                };
                foreach (json_decode($request->attachment) as $item) {
                    rename(public_path('tempFile/' . $item->folder . '/' . $item->file), public_path($path . '/' . $item->file));
                    $file = $path . '/' . $item->file;
                    $extension = preg_replace('/^.*\.([^.]+)$/D', '$1', $file);
                    $ilsIlr->attachment()->create(
                        [
                            'file' => $file,
                            'extension' => $extension
                        ]
                    );
                }
            }
            $alldocument = [];
            if ($request->document !== null) {
                foreach (json_decode($request->document) as $documentItem) {
                    array_push($alldocument, $documentItem->id);
                }
                $ilsIlr->document()->sync($alldocument);
            }
            //
            $allreceiver = [];
            if ($request->receivers !== null) {
                foreach (json_decode($request->receivers) as $receiver) {
                    array_push($allreceiver, $receiver->userinfo->user_id);
                }
                $ilsIlr->receiver()->sync($allreceiver);
            }
            //
            foreach ($allreceiver as $notification) {
                User::where('id',$notification)->first()->getNotification()->create([
                    'description'=> ' نامه داخلی جدید از طرف '. $request->sender,
                    'dispatch'=> json_encode(['IlsIlrStore','selectIlr']),
                    'data' => $ilsIlr->id,
                    'route' => 'ilrView',
                    'seen' => 0,
                    'user_id' => $notification,
                ]);
            }
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  ilsIlrRegister
    //////////////////////////////////////////////////////////////////////  ilrTable
    public function ilrTable(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $elrTable = auth()->user()->ilrIls()->with(['receiver'=>function($query){
                $query->with('userinfo')->get();
            }])->with('summary')->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($elrTable);
//
        }
    }
    //////////////////////////////////////////////////////////////////////  ilrTable
    //////////////////////////////////////////////////////////////////////  selectIlr
    public function selectIlr($id)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $selectEls = IlsIlr::where('id', $id)->with(['context','summary','attachment','document','receiver'=>
                function($query){
                    $query->with('userinfo')->get();
                }
            ])->first();
            return response()->json($selectEls);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectIlr
    //////////////////////////////////////////////////////////////////////  ilsTable
    public function ilsTable(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $elrTable = IlsIlr::where('user_id', auth()->user()->id)->with(['receiver'=>function($query){
                $query->with('userinfo')->get();
            }])->with('summary')->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($elrTable);
        }
    }
    //////////////////////////////////////////////////////////////////////  ilsTable
}
