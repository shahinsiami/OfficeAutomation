<?php

namespace App\Http\Controllers\Panel\Component;


use App\Model\Panel\Component\ComponentManyColumn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Traits;

class ManyColumnController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  manyColumn
    public function manyColumn()
    {
        if (Gate::allows('administrator')) {
            $manyColumn = ComponentManyColumn::where('status', 1)->get();
            return response()->json($manyColumn);
        }
    }
    //////////////////////////////////////////////////////////////////////  manyColumn

    //////////////////////////////////////////////////////////////////////  registerManyColumn
    public function registerManyColumn(Request $request)
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
                ComponentManyColumn::create(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('manyColumn',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('manyColumn',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerManyColumn

    /////////////////////////////////////////////////////////////////////////////////////manyColumnTable
    public function manyColumnTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =ComponentManyColumn::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////manyColumnTable



    //////////////////////////////////////////////////////////////////////  selectManyColumn
    public function selectManyColumn($id)
    {
        if (Gate::allows('administrator')) {
            $selectManyColumn = ComponentManyColumn::where('id', $id)->first();
            return response()->json($selectManyColumn);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectManyColumn
    //////////////////////////////////////////////////////////////////////  editManyColumn
    public function editManyColumn(Request $request, $id)
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
                $manyColumn = ComponentManyColumn::find($id);
                $manyColumn->update(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('manyColumn',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('manyColumn',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editManyColumn

    /////////////////////////////////////////////////////////////////////////////////////deleteManyColumn
    public function deleteManyColumn($id)
    {
        if (Gate::allows('administrator')) {
            $manyColumn = ComponentManyColumn::find($id);
            File::delete(public_path(ComponentManyColumn::find($id)->image1));
            $manyColumn->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteManyColumn
}
