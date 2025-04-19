<?php

namespace App\Http\Controllers\Panel\Crop;

use App\Model\Panel\Crop\CropCategory;
use App\Model\Panel\Crop\CropSubCategory;
use App\Model\Panel\Crop\CropSegment;
use App\Model\Panel\Crop\CropSubSegment;
use App\Model\Panel\Crop\Crop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use App\Traits;


class CropController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  cropCategoryForCrops
    public function cropCategoryForCrops()
    {
        if (Gate::allows('administrator')) {
            $cropCategoryForCrops = CropCategory::all();
            return response()->json($cropCategoryForCrops);
        }
    }
    //////////////////////////////////////////////////////////////////////  cropCategoryForCrops
    //////////////////////////////////////////////////////////////////////  cropSubcategoryForCrops
    public function cropSubcategoryForCrops()
    {
        if (Gate::allows('administrator')) {
            $cropSubcategoryForCrops = CropSubCategory::all();
            return response()->json($cropSubcategoryForCrops);
        }
    }
    //////////////////////////////////////////////////////////////////////  cropSubcategoryForCrops
    //////////////////////////////////////////////////////////////////////  cropSubcategoryForCropsBySelection
    public function cropSubcategoryForCropsBySelection($id)
    {
        if (Gate::allows('administrator')) {
            $cropSubcategoryForCropsBySelection = CropCategory::get()->where('id', $id)->first()->subcategory()->get();
            return response()->json($cropSubcategoryForCropsBySelection);
        }
    }
    //////////////////////////////////////////////////////////////////////  cropSubcategoryForCropsBySelection
    //////////////////////////////////////////////////////////////////////  cropSegmentForCrops
    public function cropSegmentForCrops()
    {
        if (Gate::allows('administrator')) {
            $cropSegmentForCrops = CropSegment::all();
            return response()->json($cropSegmentForCrops);
        }
    }
    //////////////////////////////////////////////////////////////////////  cropSegmentForCrops
    //////////////////////////////////////////////////////////////////////  cropSegmentForCropsBySelection
    public function cropSegmentForCropsBySelection($id)
    {
        if (Gate::allows('administrator')) {
            $cropSegmentForCropsBySelection = CropSubCategory::get()->where('id', $id)->first()->segment()->get();
            return response()->json($cropSegmentForCropsBySelection);
        }
    }
    //////////////////////////////////////////////////////////////////////  cropSegmentForCropsBySelection

    //////////////////////////////////////////////////////////////////////  cropSubSegmentForCrops
    public function cropSubSegmentForCrops()
    {
        if (Gate::allows('administrator')) {
            $cropSubSegmentForCrops = CropSubSegment::all();
            return response()->json($cropSubSegmentForCrops);
        }
    }
    //////////////////////////////////////////////////////////////////////  cropSubSegmentForCrops
    //////////////////////////////////////////////////////////////////////  cropSubSegmentForCropsBySelection
    public function cropSubSegmentForCropsBySelection($id)
    {
        if (Gate::allows('administrator')) {
            $cropSubSegmentForCropsBySelection = CropSegment::get()->where('id', $id)->first()->subsegment()->get();
            return response()->json($cropSubSegmentForCropsBySelection);
        }
    }
    //////////////////////////////////////////////////////////////////////  cropSubSegmentForCropsBySelection

    //////////////////////////////////////////////////////////////////////  cropDetailForCrops
    public function cropDetailForCrops($id)
    {
        if (Gate::allows('administrator')) {
            $cropDetailForCrops = CropSubSegment::where('id', $id)->first()->detail()->get();
            return response()->json($cropDetailForCrops);
        }
    }
    //////////////////////////////////////////////////////////////////////  cropDetailForCrops
    //////////////////////////////////////////////////////////////////////  registerCrop
    public function registerCrop(Request $request)
    {
        if (Gate::allows('administrator')) {

            $basepath = public_path() . '/img/database/product/';
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'brand' => 'required',
                'madein' => 'required',
                'meta' => 'required',
                'image1' => 'max:150|mimes:jpeg,png,jpg',
                'crop_sub_segment_id' => 'required',
                'image2' => 'nullable|max:150|mimes:jpeg,png,jpg',
                'image3' => 'nullable|max:150|mimes:jpeg,png,jpg',
                'image4' => 'nullable|max:150|mimes:jpeg,png,jpg',
                'image5' => 'nullable|max:150|mimes:jpeg,png,jpg',
                'image6' => 'nullable|max:150|mimes:jpeg,png,jpg',
                'image7' => 'nullable|max:150|mimes:jpeg,png,jpg',
                'image8' => 'nullable|max:150|mimes:jpeg,png,jpg',
                'image9' => 'nullable|max:150|mimes:jpeg,png,jpg',
                'image10' => 'nullable|max:150|mimes:jpeg,png,jpg',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $basepath = 'img/database/product/' . $request->name;
                ////////////////////////////////////////1000
                $newCrop = Crop::create(array_merge($request->all(),
                    array('timage1' => $this->saveImage('crop', $request->name, $request->image1, 430, 430)),
                    array('image1' => $this->saveImage('product', $request->name, $request->image1, 1080, 1080)),
                    array('image2' => $this->saveImage('product', $request->name, $request->image2, 1080, 1080)),
                    array('image3' => $this->saveImage('product', $request->name, $request->image3, 1080, 1080)),
                    array('image4' => $this->saveImage('product', $request->name, $request->image4, 1080, 1080)),
                    array('image5' => $this->saveImage('product', $request->name, $request->image5, 1080, 1080)),
                    array('image6' => $this->saveImage('product', $request->name, $request->image6, 1080, 1080)),
                    array('image7' => $this->saveImage('product', $request->name, $request->image7, 1080, 1080)),
                    array('image8' => $this->saveImage('product', $request->name, $request->image8, 1080, 1080)),
                    array('image9' => $this->saveImage('product', $request->name, $request->image9, 1080, 1080)),
                    array('image10' => $this->saveImage('product', $request->name, $request->image10, 1080, 1080))));
                $newCrop->rate()->create([
                    'score' => '0',
                    'rate' => '0',
                    'voter' => '0'
                ]);
                $newCrop->saleamount()->create([
                    'salenumber' => '0',
                    'amount' => '0',
                ]);
                return $this->vSuccess();
            }
    }
    //////////////////////////////////////////////////////////////////////  registerCrop
    //////////////////////////////////////////////////////////////////////  tableCrop

    public function cropTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =Crop::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);

        }

    }
    //////////////////////////////////////////////////////////////////////  tableCrop
    //////////////////////////////////////////////////////////////////////  selectCrop
    public function selectCrop($id)
    {
        if (Gate::allows('administrator')) {
            $selectCrop = Crop::where('id', $id)->first();
            return response()->json($selectCrop);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectCrop
    //////////////////////////////////////////////////////////////////////  editCrop
    public function editCrop(Request $request, $id)
    {
        if (Gate::allows('administrator')) {

            $basepath = public_path() . '/img/database/product/';
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'brand' => 'required',
                'madein' => 'required',
                'meta' => 'required',
                'image1' => 'nullable|max:150',
                'crop_sub_segment_id' => 'required',
                'image2' => 'nullable|max:150',
                'image3' => 'nullable|max:150',
                'image4' => 'nullable|max:150',
                'image5' => 'nullable|max:150',
                'image6' => 'nullable|max:150',
                'image7' => 'nullable|max:150',
                'image8' => 'nullable|max:150',
                'image9' => 'nullable|max:150',
                'image10' => 'nullable|max:150',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $crop = Crop::find($id);
                $crop->update(array_merge($request->all(),
                    array('timage1' => $this->saveImage('product', $request->name, $request->image1, 430, 430)),
                    array('image1' => $this->saveImage('product', $request->name, $request->image1, 1080, 1080)),
                    array('image2' => $this->saveImage('product', $request->name, $request->image2, 1080, 1080)),
                    array('image3' => $this->saveImage('product', $request->name, $request->image3, 1080, 1080)),
                    array('image4' => $this->saveImage('product', $request->name, $request->image4, 1080, 1080)),
                    array('image5' => $this->saveImage('product', $request->name, $request->image5, 1080, 1080)),
                    array('image6' => $this->saveImage('product', $request->name, $request->image6, 1080, 1080)),
                    array('image7' => $this->saveImage('product', $request->name, $request->image7, 1080, 1080)),
                    array('image8' => $this->saveImage('product', $request->name, $request->image8, 1080, 1080)),
                    array('image9' => $this->saveImage('product', $request->name, $request->image9, 1080, 1080)),
                    array('image10' => $this->saveImage('product', $request->name, $request->image10, 1080, 1080))));
                return $this->vSuccess();
            }
    }
    //////////////////////////////////////////////////////////////////////  editCrop
    //////////////////////////////////////////////////////////////////////  deleteCrop
    public function deleteCrop($id)
    {
        if (Gate::allows('administrator')) {
            $crop = Crop::find($id);
            File::delete(public_path(Crop::find($id)->image1));
            File::delete(public_path(Crop::find($id)->image2));
            File::delete(public_path(Crop::find($id)->image3));
            File::delete(public_path(Crop::find($id)->image4));
            File::delete(public_path(Crop::find($id)->image5));
            File::delete(public_path(Crop::find($id)->image6));
            File::delete(public_path(Crop::find($id)->image7));
            File::delete(public_path(Crop::find($id)->image8));
            File::delete(public_path(Crop::find($id)->image9));
            File::delete(public_path(Crop::find($id)->image10));
            $crop->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deleteCrop

}
