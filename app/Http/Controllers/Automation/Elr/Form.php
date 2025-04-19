<?php

namespace App\Http\Controllers\Automation\Elr;

use App\Model\Automation\Letters\Exterior\Receive\Elr;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    //////////////////////////////////////////////////////////////////////  allUserForElr
    public function allUserForElr(Request $request)
    {
        if (Gate::allows('administrator')) {

            $managementUserForElr = JobPosition::with(['user'=>function($query){
                $query->select(['id'])->with('userinfo:user_id,name,family')->get();
            }])->get();
            $users = [];
            foreach ($managementUserForElr as $item){
                if(sizeof($item->user)){
                    foreach ($item->user as $array){
                        array_push($users,$array);
                    }
                }
            }

            return response()->json($users);
        }
    }
    //////////////////////////////////////////////////////////////////////  allUserForElr
    //////////////////////////////////////////////////////////////////////  managementUserForElr
    public function managementUserForElr(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            $managementUserForElr = JobPosition::where('job_hierarchical_id', 1)->orWhere('job_hierarchical_id', 2)->orWhere('job_hierarchical_id', 3)->with(['user' => function ($query) {
                $query->select(['id'])->with('userinfo:user_id,name,family')->get();
            }])->get();
            $users = [];
            foreach ($managementUserForElr as $item) {
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
    //////////////////////////////////////////////////////////////////////  managementUserForElr
    //////////////////////////////////////////////////////////////////////  allDocumentForElr
    public function allDocumentForElr(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {

            $allDocumentForElr = Document::where('name', 'like', '%' . $request->searchName . '%')->limit(100)->get();
            return response()->json($allDocumentForElr);
        }
    }
    //////////////////////////////////////////////////////////////////////  allDocumentForElr
    //////////////////////////////////////////////////////////////////////  allGateForElr
    public function allGateForElr()
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {

            $allGateForElr = SecretaryPort::get();
            return response()->json($allGateForElr);
        }
    }
    //////////////////////////////////////////////////////////////////////  allGateForElr
    //////////////////////////////////////////////////////////////////////  elrRegister
    public function elrRegister(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'sender' => 'required',
                'registrar' => 'required',
                'receivers' => 'required',
                'date_of_entry' => 'required',
                'date_of_letter' => 'required',
                'security' => 'required',
                'type_of_letter' => 'required',
                'letter_priority' => 'required',
                'number_of_letter' => 'required',
                'hint' => 'required',
                'subject' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            $elr = Elr::create([
                'sender' => $request->sender,
                'registrar' => $request->registrar,
                'date_of_entry' => $request->date_of_entry,
                'date_of_letter' => $request->date_of_letter,
                'security' => $request->security,
                'type_of_letter' => $request->type_of_letter,
                'letter_priority' => $request->letter_priority,
                'number_of_letter' => $request->number_of_letter,
            ]);
            if($request->context){
            $elr->context()->create([
                'content' => $request->context,
            ]);
            }

            $elr->summary()->create([
                'hint' => $request->hint,
                'summary' => $request->summary,
                'subject' => $request->subject,
                'note' => $request->note,
            ]);

            if ($request->attachment !== null) {
                $path = 'Data/Letter/Exterior/' . Carbon::today()->toDateString() . '/' . $request->sender;
                if (!file_exists($path)) {
                    File::makeDirectory($path, $mode = 0777, true, true);
                };
                foreach (json_decode($request->attachment) as $item) {
                    rename(public_path('tempFile/' . $item->folder . '/' . $item->file), public_path($path . '/' . $item->file));
                    $file = $path . '/' . $item->file;
                    $extension = preg_replace('/^.*\.([^.]+)$/D', '$1', $file);
                    $elr->attachment()->create(
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
                $elr->document()->sync($alldocument);
            }
            //
            $allreceiver = [];
            if ($request->receivers !== null) {
                foreach (json_decode($request->receivers) as $receiver) {
                    array_push($allreceiver, $receiver->userinfo->user_id);
                }
                $elr->receiver()->sync($allreceiver);
            }
            foreach ($allreceiver as $notification) {
                User::where('id',$notification)->first()->getNotification()->create([
                    'description'=> ' نامه خارجی جدید از طرف '. $request->sender,
                    'dispatch'=> json_encode(['ElrStore','selectcElrView']),
                    'data' => $elr->id,
                    'route' => 'cElrView',
                    'seen' => 0,
                    'user_id' => $notification,
                ]);
            }
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  elrRegister
    //////////////////////////////////////////////////////////////////////  elrTable
    public function elrTable(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            $elrTable = Elr::with(['receiver'=>function($query){
                $query->with('userinfo')->get();
            }])->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($elrTable);

        }
}
//////////////////////////////////////////////////////////////////////  elrTable
    //////////////////////////////////////////////////////////////////////  selectElrEdit
    public function selectElrEdit($id)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            $selectElr = Elr::where('id', $id)->with(['summary','attachment','document','receiver'=>
                function($query){
                    $query->with('userinfo')->get();
                }
            ])->first();
            return response()->json($selectElr);

        }
    }
    //////////////////////////////////////////////////////////////////////  selectElrEdit
    //////////////////////////////////////////////////////////////////////  deleteElrDocumentAttachment
    public function deleteElrDocumentAttachment($id)
    {
        if (Gate::allows('administrator')) {

            ElrAttachment::where('id', $id)->first()->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deleteElrDocumentAttachment
    //////////////////////////////////////////////////////////////////////  editElr
    public function editElr(Request $request, $id)
    {


        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'sender' => 'required',
                'registrar' => 'required',
                'date_of_letter' => 'required',
                'security' => 'required',
                'type_of_letter' => 'required',
                'letter_priority' => 'required',
                'number_of_letter' => 'required',
                'hint' => 'required',
                'subject' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            $elr = Elr::find($id);
            $elr->update([
                'sender' => $request->sender,
                'registrar' => $request->registrar,
                'date_of_letter' => $request->date_of_letter,
                'security' => $request->security,
                'type_of_letter' => $request->type_of_letter,
                'letter_priority' => $request->letter_priority,
                'number_of_letter' => $request->number_of_letter,
            ]);
            if($request->context){
                $elr->update([
                    'content' => $request->context,
                ]);
            }

            $elr->summary()->update([
                'hint' => $request->hint,
                'summary' => $request->summary,
                'subject' => $request->subject,
                'note' => $request->note,
            ]);
            if ($request->attachment !== null) {
                $path = 'Data/Letter/Exterior/' . Carbon::today()->toDateString() . '/' . $request->sender;
                if (!file_exists($path)) {
                    File::makeDirectory($path, $mode = 0777, true, true);
                };
                foreach (json_decode($request->attachment) as $item) {
                    rename(public_path('tempFile/' . $item->folder . '/' . $item->file), public_path($path . '/' . $item->file));
                    $file = $path . '/' . $item->file;
                    $extension = preg_replace('/^.*\.([^.]+)$/D', '$1', $file);
                    $elr->attachment()->create(
                        [
                            'file' => $file,
                            'extension' => $extension
                        ]
                    );
                }
            }
            $alldocument = [];
            if ($request->document !== null) {
                $elr->document()->detach();
                foreach (json_decode($request->document) as $documentItem) {
                    array_push($alldocument, $documentItem->id);
                }
                $elr->document()->sync($alldocument);
            }
            //
            $allreceiver = [];
            if ($request->receivers !== null) {
                $elr->receiver()->detach();
                foreach (json_decode($request->receivers) as $receiver) {
                    array_push($allreceiver, $receiver->userinfo->user_id);
                }
                $elr->receiver()->sync($allreceiver);
            }

            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editElr
}
