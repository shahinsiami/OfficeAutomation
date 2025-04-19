<?php

namespace App\Http\Controllers\Automation\DlsDlr;

use App\Model\Automation\Job\JobPosition;
use App\Model\Automation\Letters\Draft\DlsDlr;
use App\Model\Automation\Letters\Exterior\Send\Els;
use App\Model\Automation\Letters\Interior\IlsIlr;
use App\Model\Automation\Secretary\Document;
use App\User;
use App\UserInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Traits;

class Form extends Controller
{
    use Traits\validatorError;
    //////////////////////////////////////////////////////////////////////  allUserForDls
    public function allUserForDls(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $allUserForDls = JobPosition::with(['user' => function ($query) {
                $query->select(['id'])->with('userinfo:user_id,name,family')->get();
            }])->get();
            $users = [];
            foreach ($allUserForDls as $item) {
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
    //////////////////////////////////////////////////////////////////////  allUserForDls
    //////////////////////////////////////////////////////////////////////  allDocumentForDls
    public function allDocumentForDls(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {

            $allDocumentForDls = Document::where('name', 'like', '%' . $request->searchName . '%')->limit(100)->get();
            return response()->json($allDocumentForDls);
        }
    }
    //////////////////////////////////////////////////////////////////////  allDocumentForDls
    //////////////////////////////////////////////////////////////////////  dlsRegister
    public function dlsRegister(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $validator = Validator::make($request->all(), [
                'sender' => 'required',
                'receivers' => 'required',
                'security' => 'required',
                'hint' => 'required',
                'subject' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            $dlsdlr = DlsDlr::create([
                'sender' => $request->sender,
                'user_id' => auth()->user()->id,
                'security' => $request->security,
                'letter_priority' => $request->letter_priority,
            ]);
            if ($request->context) {
                $dlsdlr->context()->create([
                    'content' => $request->context,
                ]);
            }

            $dlsdlr->summary()->create([
                'hint' => $request->hint,
                'summary' => $request->summary,
                'subject' => $request->subject,
                'note' => $request->note,
            ]);

            if ($request->attachment !== null) {
                $path = 'Data/Letter/Draft/' . Carbon::today()->toDateString() . '/' . $request->sender;
                if (!file_exists($path)) {
                    File::makeDirectory($path, $mode = 0777, true, true);
                };
                foreach (json_decode($request->attachment) as $item) {
                    rename(public_path('tempFile/' . $item->folder . '/' . $item->file), public_path($path . '/' . $item->file));
                    $file = $path . '/' . $item->file;
                    $extension = preg_replace('/^.*\.([^.]+)$/D', '$1', $file);
                    $dlsdlr->attachment()->create(
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
                $dlsdlr->document()->sync($alldocument);
            }
            //
            $allreceiver = [];
            if ($request->receivers !== null) {
                foreach (json_decode($request->receivers) as $receiver) {
                    array_push($allreceiver, $receiver->userinfo->user_id);
                }
                $dlsdlr->receiver()->sync($allreceiver);
            }
            foreach ($allreceiver as $notification) {
                User::where('id',$notification)->first()->getNotification()->create([
                    'description'=> ' پیش نویس جدید از طرف '. $request->sender,
                    'dispatch'=> json_encode(['DlsDlrStore','selectDls']),
                    'data' => $dlsdlr->id,
                    'route' => 'dlrView',
                    'seen' => 0,
                    'user_id' => $notification,
                ]);
            }
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  dlsRegister
    //////////////////////////////////////////////////////////////////////  dlsTable
    public function dlsTable(Request $request)
    {

        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
                $elrTable = DlsDlr::where('user_id', auth()->user()->id)->with(['receiver'=>function($query){
                    $query->with('userinfo')->get();
                }])->with('summary')->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
                return response()->json($elrTable);
            }
        }
    }
    //////////////////////////////////////////////////////////////////////  dlsTable
    //////////////////////////////////////////////////////////////////////  dlrTable
    public function dlrTable(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $elrTable = auth()->user()->dlsDlr()->with(['receiver'=>function($query){
                $query->with('userinfo')->get();
            }])->with('summary')->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($elrTable);
        }
    }
    //////////////////////////////////////////////////////////////////////  dlrTable
    //////////////////////////////////////////////////////////////////////  selectDls
    public function selectDls($id)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $selectDlr = DlsDlr::where('id', $id)->with(['context','summary','attachment','document','receiver'=>
                function($query){
                    $query->with('userinfo')->get();
                }
            ])->first();
            return response()->json($selectDlr);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectDls
}



