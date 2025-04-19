<?php

namespace App\Http\Controllers\Panel\Crop;


use App\Model\Panel\Crop\CropCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
class CropCategoryController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;
    /////////////////////////////////////////////////////////////////////////////////////registerCropCategory
    public function registerCropCategory(Request $request)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'priority' => 'required',
                'image' => 'max:150',
                'page_template_id' => 'required',
                'page_language_id' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                CropCategory::create(array_merge($request->all(), array(
                    'image' => $this->saveImage('cropCategory', $request->name, $request->image, 1280, 427)
                )));
                return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////registerCropCategory
    /////////////////////////////////////////////////////////////////////////////////////cropCategoryTable
    public function cropCategoryTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =CropCategory::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);

        }

    }
    /////////////////////////////////////////////////////////////////////////////////////cropCategoryTable
    /////////////////////////////////////////////////////////////////////////////////////selectCropCategory
    public function selectCropCategory($id)
    {
        if (Gate::allows('administrator')) {
            $selectCropCategory = CropCategory::where('id', $id)->first();
            return response()->json($selectCropCategory);
        }

    }
    /////////////////////////////////////////////////////////////////////////////////////selectCropCategory
    /////////////////////////////////////////////////////////////////////////////////////editCropCategory
    public function editCropCategory(Request $request, $id)
    {
        if (Gate::allows('administrator')) {
            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'priority' => 'required',
                'image' => 'max:150',
                'page_template_id' => 'required',
                'page_language_id' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $cropCategory = CropCategory::find($id);
                $basepath = 'img/database/category/' . $request->name;
                $cropCategory->update(array_merge($request->all(), array(
                    'image' => $this->saveImage('cropCategory',$request->name,$request->image,1280,427)
                )));
                return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////editCropCategory
    /////////////////////////////////////////////////////////////////////////////////////deleteCropCategory
    public function deleteCropCategory($id)
    {
        if (Gate::allows('administrator')) {
            $cropCategory = CropCategory::find($id);
            File::delete(public_path(CropCategory::find($id)->image));
            $cropCategory->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteCropCategory

}
