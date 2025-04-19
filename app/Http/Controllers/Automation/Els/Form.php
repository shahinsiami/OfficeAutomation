<?php

namespace App\Http\Controllers\Automation\Els;

use App\Model\Automation\Letters\Exterior\Send\Els;
use App\Model\Automation\Letters\Exterior\Send\ElsAttachment;
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

    //////////////////////////////////////////////////////////////////////  allUserForEls
    public function allUserForEls(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {

            $allUserForEls = UserInfo::where('name', 'like', '%' . $request->searchName . '%')->with('user')->limit(100)->get();
            return response()->json($allUserForEls);
        }
    }
    //////////////////////////////////////////////////////////////////////  allUserForEls
    //////////////////////////////////////////////////////////////////////  managementUserForEls
    public function managementUserForEls(Request $request)
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
    //////////////////////////////////////////////////////////////////////  managementUserForEls
    //////////////////////////////////////////////////////////////////////  allDocumentForEls
    public function allDocumentForEls(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {

            $allDocumentForEls = Document::where('name', 'like', '%' . $request->searchName . '%')->limit(100)->get();
            return response()->json($allDocumentForEls);
        }
    }
    //////////////////////////////////////////////////////////////////////  allDocumentForEls
    //////////////////////////////////////////////////////////////////////  allGateForEls
    public function allGateForEls()
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {

            $allGateForEls = SecretaryPort::get();
            return response()->json($allGateForEls);
        }
    }
    //////////////////////////////////////////////////////////////////////  allGateForEls
    //////////////////////////////////////////////////////////////////////  ElsRegister
    public function ElsRegister(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'receiver' => 'required',
                'date_of_letter' => 'required',
                'security' => 'required',
                'type_of_letter' => 'required',
                'letter_priority' => 'required',
                'number_of_letter' => 'required',
                'indicator' => 'required',
                'hint' => 'required',
                'subject' => 'required',
                'registrar' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //
            $els = Els::create([
                'receiver' => $request->receiver,
                'registrar' => $request->registrar,
                'date_of_letter' => $request->date_of_letter,
                'security' => $request->security,
                'type_of_letter' => $request->type_of_letter,
                'letter_priority' => $request->letter_priority,
                'indicator' => $request->indicator . '/' . $request->number_of_letter,
            ]);
            //
            if($request->context){
                $els->context()->create([
                    'content' => $request->context,
                ]);
            }
            //
            $alldocument = [];
            if ($request->document !== null) {
                foreach (json_decode($request->document) as $documentItem) {
                    array_push($alldocument, $documentItem->id);
                }
                $els->document()->sync($alldocument);
            }
            //
            $els->summary()->create([
                'hint' => $request->hint,
                'summary' => $request->summary,
                'subject' => $request->subject,
                'note' => $request->note,
            ]);
            //
            if ($request->attachment !== null) {
                $path = 'Data/Letter/Exterior/' . Carbon::today()->toDateString() . '/' . $request->receiver;
                if (!file_exists($path)) {
                    File::makeDirectory($path, $mode = 0777, true, true);
                };
                foreach (json_decode($request->attachment) as $item) {
                    rename(public_path('tempFile/' . $item->folder . '/' . $item->file), public_path($path . '/' . $item->file));
                    $file = $path . '/' . $item->file;
                    $extension = preg_replace('/^.*\.([^.]+)$/D', '$1', $file);
                    $els->attachment()->create(
                        [
                            'file' => $file,
                            'extension' => $extension
                        ]
                    );
                }
            }
            //
            $allsender = [];
            if ($request->sender !== null) {
                foreach (json_decode($request->sender) as $sender) {
                    array_push($allsender, $sender->userinfo->user_id);
                }
                $els->sender()->sync($allsender);
            }
            //
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  ElsRegister
    //////////////////////////////////////////////////////////////////////  elsTable
    public function elsTable(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            $elsTable = Els::with(['sender'=>function($query){
                $query->with('userinfo')->get();
            }])->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($elsTable);

        }
    }
    //////////////////////////////////////////////////////////////////////  elsTable
    //////////////////////////////////////////////////////////////////////  selectElsEdit
        public function selectElsEdit($id)
        {
            if (Gate::allows('secretariat') || Gate::allows('administrator')) {
                $selectEls = Els::where('id', $id)->with(['context','summary','attachment','document','sender'=>
                function($query){
                     $query->with('userinfo')->get();
                }
                ])->first();
                return response()->json($selectEls);

            }
        }
    //////////////////////////////////////////////////////////////////////  selectEls
    //////////////////////////////////////////////////////////////////////  deleteElsDocumentAttachment
    public function deleteElsDocumentAttachment($id)
    {
        if (Gate::allows('administrator')) {

            ElsAttachment::where('id', $id)->first()->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deleteElsDocumentAttachment
    //////////////////////////////////////////////////////////////////////  editEls
    public function editEls(Request $request,$id)
    {

        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'receiver' => 'required',
                'date_of_letter' => 'required',
                'security' => 'required',
                'type_of_letter' => 'required',
                'letter_priority' => 'required',
                'indicator' => 'required',
                'hint' => 'required',
                'subject' => 'required',
                'registrar' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //
            $els = Els::find($id);
            $els->update([
                'receiver' => $request->receiver,
                'registrar' => $request->registrar,
                'date_of_letter' => $request->date_of_letter,
                'security' => $request->security,
                'type_of_letter' => $request->type_of_letter,
                'letter_priority' => $request->letter_priority,
                'indicator' => $request->indicator ,
            ]);
            //
            if($request->context){
                $els->context()->update([
                    'content' => $request->context,
                ]);
            }
            //
            $alldocument = [];
            if ($request->document !== null) {
                $els->document()->detach();
                foreach (json_decode($request->document) as $documentItem) {
                    array_push($alldocument, $documentItem->id);
                }
                $els->document()->sync($alldocument);
            }
            //
            $els->summary()->update([
                'hint' => $request->hint,
                'summary' => $request->summary,
                'subject' => $request->subject,
                'note' => $request->note,
            ]);
            //
            if ($request->attachment !== null) {
                $path = 'Data/Letter/Exterior/' . Carbon::today()->toDateString() . '/' . $request->receiver;
                if (!file_exists($path)) {
                    File::makeDirectory($path, $mode = 0777, true, true);
                };
                foreach (json_decode($request->attachment) as $item) {
                    rename(public_path('tempFile/' . $item->folder . '/' . $item->file), public_path($path . '/' . $item->file));
                    $file = $path . '/' . $item->file;
                    $extension = preg_replace('/^.*\.([^.]+)$/D', '$1', $file);
                    $els->attachment()->create(
                        [
                            'file' => $file,
                            'extension' => $extension
                        ]
                    );
                }
            }

            //
            $allsender = [];
            if ($request->sender !== null) {
                $els->sender()->detach();
                foreach (json_decode($request->sender) as $sender) {
                    array_push($allsender, $sender->userinfo->user_id);
                }
                $els->sender()->sync($allsender);
            }
            //
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editEls
}
