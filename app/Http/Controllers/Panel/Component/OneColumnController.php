<?php

namespace App\Http\Controllers\Panel\Component;

use App\Model\Panel\Component\ComponentOneColumn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Traits;

class OneColumnController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  oneColumn
    public function oneColumn()
    {
        if (Gate::allows('administrator')) {
            $oneColumn = ComponentOneColumn::where('status', 1)->get();
            return response()->json($oneColumn);
        }
    }
    //////////////////////////////////////////////////////////////////////  oneColumn

    //////////////////////////////////////////////////////////////////////  registerOneColumn
    public function registerOneColumn(Request $request)
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
                ComponentOneColumn::create(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('oneColumn',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('oneColumn',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerOneColumn

    /////////////////////////////////////////////////////////////////////////////////////oneColumnTable
    public function oneColumnTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =ComponentOneColumn::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////oneColumnTable



    //////////////////////////////////////////////////////////////////////  selectOneColumn
    public function selectOneColumn($id)
    {
        if (Gate::allows('administrator')) {
            $selectOneColumn = ComponentOneColumn::where('id', $id)->first();
            return response()->json($selectOneColumn);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectOneColumn
    //////////////////////////////////////////////////////////////////////  editOneColumn
    public function editOneColumn(Request $request, $id)
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
                $oneColumn = ComponentOneColumn::find($id);
                $oneColumn->update(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('oneColumn',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('oneColumn',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editOneColumn

    /////////////////////////////////////////////////////////////////////////////////////deleteOneColumn
    public function deleteOneColumn($id)
    {
        if (Gate::allows('administrator')) {
            $oneColumn = ComponentOneColumn::find($id);
            File::delete(public_path(ComponentOneColumn::find($id)->image1));
            $oneColumn->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteOneColumn
}
