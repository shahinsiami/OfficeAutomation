<?php

namespace App\Http\Controllers\Panel\Component;

use App\Model\Panel\Component\ComponentTextRow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Traits;


class TextRowController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  textrow
    public function TextRow()
    {
        if (Gate::allows('administrator')) {
            $textrow = ComponentTextRow::where('status', 1)->get();
            return response()->json($textrow);
        }
    }
    //////////////////////////////////////////////////////////////////////  textrow

    //////////////////////////////////////////////////////////////////////  registerTextRow
    public function registerTextRow(Request $request)
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
                'name' => 'required|max:50',
                'section' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                ComponentTextRow::create(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('textrow',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('textrow',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerTextRow

    /////////////////////////////////////////////////////////////////////////////////////textRowTable
    public function textRowTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =ComponentTextRow::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////textRowTable



    //////////////////////////////////////////////////////////////////////  selectTextRow
    public function selectTextRow($id)
    {
        if (Gate::allows('administrator')) {
            $selectTextRow = ComponentTextRow::where('id', $id)->first();
            return response()->json($selectTextRow);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectTextRow
    //////////////////////////////////////////////////////////////////////  editTextRow
    public function editTextRow(Request $request, $id)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'title1' => 'required',
                'description' => 'required',
                'status' => 'required|numeric',
                'link' => 'required',
                'seo' => 'required',
                'page_template_id' => 'required',
                'page_language_id' => 'required',
                'name' => 'required|max:50',
                'section' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $textrow = ComponentTextRow::find($id);
                $textrow->update(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('textrow',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('textrow',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editTextRow

    /////////////////////////////////////////////////////////////////////////////////////deleteTextRow
    public function deleteTextRow($id)
    {
        if (Gate::allows('administrator')) {
            $textrow = ComponentTextRow::find($id);
            File::delete(public_path(ComponentTextRow::find($id)->image1));
            $textrow->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteTextRow
}
