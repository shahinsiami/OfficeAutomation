<?php

namespace App\Http\Controllers\Panel\Component;

use App\Model\Panel\Component\ComponentTwoColumn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Traits;
class TwoColumnController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  twoColumn
    public function twoColumn()
    {
        if (Gate::allows('administrator')) {
            $twoColumn = ComponenttwoColumn::where('status', 1)->get();
            return response()->json($twoColumn);
        }
    }
    //////////////////////////////////////////////////////////////////////  twoColumn

    //////////////////////////////////////////////////////////////////////  registerTwoColumn
    public function registerTwoColumn(Request $request)
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
                'name' => 'required',
                'section' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                ComponentTwoColumn::create(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('twoColumn',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('twoColumn',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerTwoColumn

    /////////////////////////////////////////////////////////////////////////////////////twoColumnTable
    public function twoColumnTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =ComponentTwoColumn::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////twoColumnTable



    //////////////////////////////////////////////////////////////////////  selectTwoColumn
    public function selectTwoColumn($id)
    {
        if (Gate::allows('administrator')) {
            $selectTwoColumn = ComponentTwoColumn::where('id', $id)->first();
            return response()->json($selectTwoColumn);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectTwoColumn
    //////////////////////////////////////////////////////////////////////  editTwoColumn
    public function editTwoColumn(Request $request, $id)
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
                $twoColumn = ComponentTwoColumn::find($id);
                $twoColumn->update(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('twoColumn',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('twoColumn',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editTwoColumn
    /////////////////////////////////////////////////////////////////////////////////////deleteTwoColumn
    public function deleteTwoColumn($id)
    {
        if (Gate::allows('administrator')) {
            $twoColumn = ComponentTwoColumn::find($id);
            File::delete(public_path(ComponentTwoColumn::find($id)->image1));
            $twoColumn->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteTwoColumn
}
