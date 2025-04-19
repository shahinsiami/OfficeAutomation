<?php

namespace App\Http\Controllers\Automation\Secretary;

use App\Model\Automation\Secretary\Document;
use App\Model\Automation\Secretary\DocumentAttachment;
use App\Model\Automation\Secretary\Secretary;
use App\Model\Automation\Secretary\SecretaryPort;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Traits;
use Illuminate\Support\Facades\File;

class Form extends Controller
{
     use Traits\validatorError;
    //////////////////////////////////////////////////////////////////////  secretaryRegister
    public function secretaryRegister(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            Secretary::create(
                $request->all()
            );
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  secretaryRegister
    //////////////////////////////////////////////////////////////////////  secretaryTable
    public function secretaryTable(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            $secretaryTable = Secretary::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($secretaryTable);

        }
    }
    //////////////////////////////////////////////////////////////////////  secretaryTable
    //////////////////////////////////////////////////////////////////////  selectSecretaryEdit
    public function selectSecretaryEdit($id)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            $selectjobClassificationEdit = Secretary::where('id', $id)->first();
            return response()->json($selectjobClassificationEdit);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectSecretaryEdit
    //////////////////////////////////////////////////////////////////////  editSecretary
    public function editSecretary(Request $request, $id)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            $JobClassification = Secretary::find($id);
            $JobClassification->update(
                $request->all()
            );
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editSecretary
    //////////////////////////////////////////////////////////////////////  deleteSecretary
    public function deleteSecretary($id)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            Secretary::where('id', $id)->first()->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deleteSecretary
    //
    //////////////////////////////////////////////////////////////////////  secretaryPortRegister
    public function secretaryPortRegister(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|',
                'indicator' => 'required',
                'secretary_id' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            SecretaryPort::create(
                $request->all()
            );
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  secretaryPortRegister
    //////////////////////////////////////////////////////////////////////  secretaryPortTable
    public function secretaryPortTable(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            $secretaryPortTable = SecretaryPort::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($secretaryPortTable);

        }
    }
    //////////////////////////////////////////////////////////////////////  secretaryPortTable
    //////////////////////////////////////////////////////////////////////  selectSecretaryPortEdit
    public function selectSecretaryPortEdit($id)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            $selectjobClassificationEdit = SecretaryPort::where('id', $id)->with('secretary')->first();
            return response()->json($selectjobClassificationEdit);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectSecretaryPortEdit
    //////////////////////////////////////////////////////////////////////  editSecretaryPort
    public function editSecretaryPort(Request $request, $id)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            $JobClassification = SecretaryPort::find($id);
            $JobClassification->update(
                $request->all()
            );
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editSecretaryPort
    //////////////////////////////////////////////////////////////////////  deleteSecretaryPort
    public function deleteSecretaryPort($id)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            SecretaryPort::where('id', $id)->first()->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deleteSecretaryPort
    //////////////////////////////////////////////////////////////////////  allSecretaryForSecretaryPort
    public function allSecretaryForSecretaryPort(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator')) {
            $allSecretaryForSecretaryPort = Secretary::where('name', 'like', '%' . $request->searchName . '%')->limit(100)->get();
            return response()->json($allSecretaryForSecretaryPort);
        }
    }
    //////////////////////////////////////////////////////////////////////  allSecretaryForSecretaryPort
    //








    //////////////////////////////////////////////////////////////////////  documentRegister
    public function documentRegister(Request $request)
    {
//        return json_decode($request->file);
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'description' => 'required',
                'registration_number' => 'required',
                'file' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            $document =  Document::create(
                $request->all()
            );
            if (!file_exists('Data/Document/'.$request->registration_number)) {
                File::makeDirectory('Data/Document/'.$request->registration_number, $mode = 0777, true, true);
            };
            foreach (json_decode($request->file) as $item){
                rename(public_path('tempFile/'.$item->folder.'/'.$item->file ), public_path('Data/Document/'.$request->registration_number.'/'.$item->file)) ;
                $file = 'Data/Document/'.$request->registration_number.'/'.$item->file;
                $extension = preg_replace('/^.*\.([^.]+)$/D', '$1', $file);
                $document->documentAttachment()->create(
                    [
                        'file'=>$file,
                        'extension'=>$extension
                    ]
                );



            }
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  documentRegister
    //////////////////////////////////////////////////////////////////////  documentTable
    public function documentTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $documentTable = Document::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($documentTable);

        }
    }
    //////////////////////////////////////////////////////////////////////  documentTable
    //////////////////////////////////////////////////////////////////////  selectdocumentEdit
    public function selectdocumentEdit($id)
    {
        if (Gate::allows('administrator')) {

            $selectjobClassificationEdit = Document::where('id', $id)->with('documentAttachment')->first();
            return response()->json($selectjobClassificationEdit);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectDocumentEdit
    //////////////////////////////////////////////////////////////////////  editDocument
    public function editDocument(Request $request, $id)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'description' => 'required',
                'registration_number' => 'required',
                'file' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            $editDocument = Document::find($id);
            $editDocument->update(
                $request->all()
            );
            if (!file_exists('Data/Document/'.$request->registration_number)) {
                File::makeDirectory('Data/Document/'.$request->registration_number, $mode = 0777, true, true);
            };
            foreach (json_decode($request->file) as $item){
                rename(public_path('tempFile/'.$item->folder.'/'.$item->file ), public_path('Data/Document/'.$request->registration_number.'/'.$item->file)) ;
                $file = 'Data/Document/'.$request->registration_number.'/'.$item->file;
                $extension = preg_replace('/^.*\.([^.]+)$/D', '$1', $file);
                $editDocument->documentAttachment()->create(
                    [
                        'file'=>$file,
                        'extension'=>$extension
                    ]
                );
            }
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editDocument
    //////////////////////////////////////////////////////////////////////  deleteDocument
    public function deleteDocument($id)
    {
        if (Gate::allows('administrator')) {

            Document::where('id', $id)->first()->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deleteDocument
    //////////////////////////////////////////////////////////////////////  deleteDocumentAttachment
    public function deleteDocumentAttachment($id)
    {
        if (Gate::allows('administrator')) {

            DocumentAttachment::where('id', $id)->first()->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deleteDocumentAttachment

}
