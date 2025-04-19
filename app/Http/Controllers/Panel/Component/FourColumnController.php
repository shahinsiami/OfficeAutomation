<?php

namespace App\Http\Controllers\Panel\Component;

use App\Model\Panel\Component\ComponentFourColumn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Traits;
class FourColumnController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  fourColumn
    public function fourColumn()
    {
        if (Gate::allows('administrator')) {
            $fourColumn = ComponentFourColumn::where('status', 1)->get();
            return response()->json($fourColumn);
        }
    }
    //////////////////////////////////////////////////////////////////////  fourColumn

    //////////////////////////////////////////////////////////////////////  registerFourColumn
    public function registerFourColumn(Request $request)
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
                ComponentFourColumn::create(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('fourColumn',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('fourColumn',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerFourColumn

    /////////////////////////////////////////////////////////////////////////////////////fourColumnTable
    public function fourColumnTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =ComponentFourColumn::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////fourColumnTable



    //////////////////////////////////////////////////////////////////////  selectFourColumn
    public function selectFourColumn($id)
    {
        if (Gate::allows('administrator')) {
            $selectFourColumn = ComponentFourColumn::where('id', $id)->first();
            return response()->json($selectFourColumn);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectFourColumn
    //////////////////////////////////////////////////////////////////////  editFourColumn
    public function editFourColumn(Request $request, $id)
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
                $fourColumn = ComponentFourColumn::find($id);
                $fourColumn->update(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('fourColumn',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('fourColumn',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editFourColumn

    /////////////////////////////////////////////////////////////////////////////////////deleteFourColumn
    public function deleteFourColumn($id)
    {
        if (Gate::allows('administrator')) {
            $fourColumn = ComponentFourColumn::find($id);
            File::delete(public_path(ComponentFourColumn::find($id)->image1));
            $fourColumn->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteFourColumn
}
