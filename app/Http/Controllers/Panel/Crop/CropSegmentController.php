<?php

namespace App\Http\Controllers\Panel\Crop;

use App\Model\Panel\Crop\CropCategory;
use App\Model\Panel\Crop\CropSegment;
use App\Model\Panel\Crop\CropSubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CropSegmentController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;
    //////////////////////////////////////////////////////////////////////  cropCategoryForCropSegment
    public function cropCategoryForCropSegment()
    {
        if (Gate::allows('administrator')) {
            $cropCategoryForCropSegment = CropCategory::all();
            return response()->json($cropCategoryForCropSegment);
        }
    }
    //////////////////////////////////////////////////////////////////////  cropCategoryForCropSegment

    //////////////////////////////////////////////////////////////////////  cropSubCategoryForCropSegment
    public function cropSubCategoryForCropSegment()
    {
        if (Gate::allows('administrator')) {
            $cropSubCategoryForCropSegment = CropSubCategory::all();
            return response()->json($cropSubCategoryForCropSegment);
        }
    }
    //////////////////////////////////////////////////////////////////////  cropSubCategoryForCropSegment
    //////////////////////////////////////////////////////////////////////  registerCropSegment
    public function registerCropSegment(Request $request)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'priority' => 'required',
                'crop_sub_category_id' => 'required',
                'image' => 'max:150',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                CropSegment::create(array_merge($request->all(), array(
                    'image' => $this->saveImage('cropSegment', $request->name, $request->image, 1280, 427)
                )));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerCropSegment
    //////////////////////////////////////////////////////////////////////  cropSegmentTable
    public function cropSegmentTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =CropSegment::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    //////////////////////////////////////////////////////////////////////  cropSegmentTable
    //////////////////////////////////////////////////////////////////////  selectCropSegment
    public function selectCropSegment($id)
    {
        if (Gate::allows('administrator')) {
            $selectCropSegment = CropSegment::where('id', $id)->first();
            return response()->json($selectCropSegment);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectCropSegment
    //////////////////////////////////////////////////////////////////////  editCropSegment
    public function editCropSegment(Request $request, $id)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'priority' => 'required',
                'crop_sub_category_id' => 'required',
                'image' => 'max:150',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $cropSubCategory = CropSegment::find($id);
                $cropSubCategory->update(array_merge($request->all(), array(
                    'image' => $this->saveImage('cropSegment', $request->name, $request->image, 1280, 427)
                )));
                return $this->vSuccess();

        }
    }
    //////////////////////////////////////////////////////////////////////  editCropSegment
    //////////////////////////////////////////////////////////////////////  deleteCropSegment
    public function deleteCropSegment($id)
    {
        if (Gate::allows('administrator')) {
            $cropSegment = CropSegment::find($id);
            File::delete(public_path(CropSegment::find($id)->image));
            $cropSegment->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deleteCropSegment

    //////////////////////////////////////////////////////////////////////  choiceCropSubCategory
    public function choiceCropSubCategory(CropCategory $cropCategory, $id)
    {
        if (Gate::allows('administrator')) {
            return $cropCategory->whereId($id)->first()->subcategory()->get();
        }
    }
    //////////////////////////////////////////////////////////////////////  choiceCropSubCategory
}
