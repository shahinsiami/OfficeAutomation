<?php

namespace App\Http\Controllers\Panel\Crop;
use App\Model\Panel\Crop\CropSegment;
use App\Model\Panel\Crop\CropEvent;
use App\Model\Panel\Crop\CropSubSegment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Traits;

class CropSubSegmentController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  cropSegmentForCropSubSegment
    public function cropSegmentForCropSubSegment()
    {
        if (Gate::allows('administrator')) {
            $allCropSubSegment = CropSegment::all();
            return response()->json($allCropSubSegment);
        }
    }
    //////////////////////////////////////////////////////////////////////  cropSegmentForCropSubSegment
    //////////////////////////////////////////////////////////////////////  cropEventForCropSubSegment
    public function cropEventForCropSubSegment()
    {
        if (Gate::allows('administrator')) {
            $allCropEvent = CropEvent::all();
            return response()->json($allCropEvent);
        }
    }
    //////////////////////////////////////////////////////////////////////  cropEventForCropSubSegment
    //////////////////////////////////////////////////////////////////////  registerCropSubSegment
    public function registerCropSubSegment(Request $request)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'priority' => 'required',
                'crop_event_id' => 'required',
                'crop_segment_id' => 'required',
                'image' => 'max:150',

            ]);

            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                CropSubSegment::create(array_merge($request->all(), array(
                    'image' => $this->saveImage('cropSubSegment', $request->name, $request->image, 1280, 427)
                )));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerCropSubSegment
    //////////////////////////////////////////////////////////////////////  cropSubSegmentTable
    public function cropSubSegmentTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =cropSubSegment::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    //////////////////////////////////////////////////////////////////////  cropSubSegmentTable

    //////////////////////////////////////////////////////////////////////  selectCropSubSegment
    public function selectCropSubSegment($id)
    {
        if (Gate::allows('administrator')) {
            $selectCropSubSegment = CropSubSegment::where('id', $id)->first();
            return response()->json($selectCropSubSegment);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectCropSubSegment

    //////////////////////////////////////////////////////////////////////  editCropSubSegment
    public function editCropSubSegment(Request $request, $id)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'priority' => 'required',
                'crop_segment_id' => 'required',
                'crop_event_id' => 'required',
                'image' => 'max:150',
            ]);

            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $cropSubCategory = CropSubSegment::find($id);
                $cropSubCategory->update(array_merge($request->all(), array(
                    'image' => $this->saveImage('cropSubSegment', $request->name, $request->image, 1280, 427)
                )));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editCropSubSegment
    //////////////////////////////////////////////////////////////////////  deleteCropSubSegment
    public function deleteCropSubSegment($id)
    {
        if (Gate::allows('administrator')) {
            $cropSubSegment = CropSubSegment::find($id);
            File::delete(public_path(CropSubSegment::find($id)->image));
            $cropSubSegment->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deleteCropSubSegment
    ///
}
