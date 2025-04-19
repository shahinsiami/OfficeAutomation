<?php

namespace App\Http\Controllers\Panel\Component;

use App\Model\Panel\Component\ComponentThreeColumn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Traits;

class ThreeColumnController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  threeColumn
    public function threeColumn()
    {
        if (Gate::allows('administrator')) {
            $threeColumn = ComponentThreeColumn::where('status', 1)->get();
            return response()->json($threeColumn);
        }
    }
    //////////////////////////////////////////////////////////////////////  threeColumn

    //////////////////////////////////////////////////////////////////////  registerThreeColumn
    public function registerThreeColumn(Request $request)
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
                ComponentThreeColumn::create(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('threeColumn',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('threeColumn',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerThreeColumn

    /////////////////////////////////////////////////////////////////////////////////////threeColumnTable
    public function threeColumnTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =ComponentThreeColumn::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////threeColumnTable



    //////////////////////////////////////////////////////////////////////  selectThreeColumn
    public function selectThreeColumn($id)
    {
        if (Gate::allows('administrator')) {
            $selectThreeColumn = ComponentThreeColumn::where('id', $id)->first();
            return response()->json($selectThreeColumn);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectThreeColumn
    //////////////////////////////////////////////////////////////////////  editThreeColumn
    public function editThreeColumn(Request $request, $id)
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
                'name' => 'required',
                'section' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $threeColumn = ComponentThreeColumn::find($id);
                $threeColumn->update(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('threeColumn',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('threeColumn',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editThreeColumn

    /////////////////////////////////////////////////////////////////////////////////////deleteThreeColumn
    public function deleteThreeColumn($id)
    {
        if (Gate::allows('administrator')) {
            $threeColumn = ComponentThreeColumn::find($id);
            File::delete(public_path(ComponentThreeColumn::find($id)->image1));
            $threeColumn->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteThreeColumn
}
