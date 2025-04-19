<?php

namespace App\Http\Controllers\Panel\Crop;


use App\Model\Panel\Crop\CropCategory;
use App\Model\Panel\Crop\CropSubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
class CropSubCategoryController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  registerCropSubCategory
    public function registerCropSubCategory(Request $request)
    {
        if (Gate::allows('administrator')) {
            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'priority' => 'required',
                'crop_category_id' => 'required',
                'image' => 'max:150',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                CropSubCategory::create(array_merge($request->all(), array(
                    'image' => $this->saveImage('cropSubCategory', $request->name, $request->image, 1280, 427)
                )));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerCropSubCategory
    //////////////////////////////////////////////////////////////////////  editCropSubCategory
    public function editCropSubCategory(Request $request, $id)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'priority' => 'required',
                'image' => 'max:150',
                'crop_category_id' => 'max:150',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $cropSubCategory = CropSubCategory::find($id);
                $cropSubCategory->update(array_merge($request->all(), array(
                    'image' => $this->saveImage('cropSubCategory', $request->name, $request->image, 1280, 427)
                )));
                return $this->vSuccess();

        }
    }
    //////////////////////////////////////////////////////////////////////  editCropSubCategory
    //////////////////////////////////////////////////////////////////////  cropCategoryForCropSubCategories
    public function cropCategoryForCropSubCategories()
    {
        if (Gate::allows('administrator')) {
            $allCropCategory = CropCategory::all();
            return response()->json($allCropCategory);
        }
    }
    //////////////////////////////////////////////////////////////////////  cropCategoryForCropSubCategories
    /////////////////////////////////////////////////////////////////////////////////////cropSubCategoryTable
    public function cropSubCategoryTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =CropSubCategory::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);

        }

    }
    /////////////////////////////////////////////////////////////////////////////////////cropSubCategoryTable

    //////////////////////////////////////////////////////////////////////  selectCropSubCategory
    public function selectCropSubCategory($id)
    {
        if (Gate::allows('administrator')) {
            $selectCropSubCategory = CropSubCategory::where('id', $id)->first();
            return response()->json($selectCropSubCategory);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectCropSubCategory
    //////////////////////////////////////////////////////////////////////  deleteCropSubCategory
    public function deleteCropSubCategory($id)
    {
        if (Gate::allows('administrator')) {
            $deleteCropSubCategory = CropSubCategory::find($id);
            File::delete(public_path(CropSubCategory::find($id)->image));
            $deleteCropSubCategory->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deleteCropSubCategory
}
