<?php

namespace App\Http\Controllers\Panel\Component;

use App\Model\Panel\Component\ComponentRow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Traits;

class RowController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  row
    public function Row()
    {
        if (Gate::allows('administrator')) {
            $row = ComponentRow::where('status', 1)->get();
            return response()->json($row);
        }
    }
    //////////////////////////////////////////////////////////////////////  row

    //////////////////////////////////////////////////////////////////////  registerRow
    public function registerRow(Request $request)
    {
        if (Gate::allows('administrator')) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'image1' => 'required',
                'title1' => 'required',
                'description' => 'required',
                'link' => 'required',
                'seo' => 'required',
                'status' => 'required',
                'page_template_id' => 'required',
                'page_language_id' => 'required',
                'section' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                ComponentRow::create(array_merge($request->all(),
                    array( 'image1' => $this->saveImage('row',$request->name,$request->image1,430,430)),
                    array( 'image2' => $this->saveImage('row',$request->name,$request->image2,1080,1080))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerRow

    /////////////////////////////////////////////////////////////////////////////////////rowTable
    public function rowTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =ComponentRow::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////rowTable



    //////////////////////////////////////////////////////////////////////  selectRow
    public function selectRow($id)
    {
        if (Gate::allows('administrator')) {
            $selectRow = ComponentRow::where('id', $id)->first();
            return response()->json($selectRow);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectRow
    //////////////////////////////////////////////////////////////////////  editRow
    public function editRow(Request $request, $id)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'title1' => 'required',
                'description' => 'required',
                'status' => 'required|numeric',
                'link' => 'required',
                'seo' => 'required',
                'page_template_id' => 'required',
                'page_language_id' => 'required',
                'section' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $row = ComponentRow::find($id);
                $row->update(array_merge($request->all(),
                    array( 'image1' => $this->saveImage('row',$request->name,$request->image1,430,430)),
                    array( 'image2' => $this->saveImage('row',$request->name,$request->image2,1080,1080))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editRow

    /////////////////////////////////////////////////////////////////////////////////////deleteRow
    public function deleteRow($id)
    {
        if (Gate::allows('administrator')) {
            $row = ComponentRow::find($id);
            File::delete(public_path(ComponentRow::find($id)->image1));
            $row->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteRow
}
