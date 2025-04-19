<?php

namespace App\Http\Controllers\Panel\Component;

use App\Model\Panel\Component\ComponentContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Traits;

class ContatcController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  contact
    public function contact()
    {
        if (Gate::allows('administrator')) {
            $contact = ComponentContact::where('status', 1)->get();
            return response()->json($contact);
        }
    }
    //////////////////////////////////////////////////////////////////////  contact

    //////////////////////////////////////////////////////////////////////  registerContact
    public function registerContact(Request $request)
    {
        if (Gate::allows('administrator')) {

            $validator = Validator::make($request->all(), [
                'image1' => 'required',
                'title1' => 'required',
                'description' => 'required',
                'link' => 'required',
                'seo' => 'required',
                'status' => 'required',
                'page_template_id' => 'required',
                'page_language_id' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                ComponentContact::create(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('contact',$request->title1,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('contact',$request->title1,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerContact

    /////////////////////////////////////////////////////////////////////////////////////contactTable
    public function contactTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =ComponentContact::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////contactTable



    //////////////////////////////////////////////////////////////////////  selectContact
    public function selectContact($id)
    {
        if (Gate::allows('administrator')) {
            $selectContact = ComponentContact::where('id', $id)->first();
            return response()->json($selectContact);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectContact
    //////////////////////////////////////////////////////////////////////  editContact
    public function editContact(Request $request, $id)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'title1' => 'required',
                'description' => 'required',
                'status' => 'required|numeric',
                'link' => 'required',
                'seo' => 'required',
                'image1' => 'max:150',
                'page_template_id' => 'required',
                'page_language_id' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $contact = ComponentContact::find($id);
                $contact->update(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('contact',$request->title1,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('contact',$request->title1,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editContact

    /////////////////////////////////////////////////////////////////////////////////////deleteContact
    public function deleteContact($id)
    {
        if (Gate::allows('administrator')) {
            $contact = ComponentContact::find($id);
            File::delete(public_path(ComponentContact::find($id)->image1));
            $contact->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteContact
}
