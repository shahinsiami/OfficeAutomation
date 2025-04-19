<?php

namespace App\Http\Controllers\Panel\Crop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Crop\CropEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Traits;
class CropEventController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;
    //////////////////////////////////////////////////////////////////////  registerCropEvent
    public function registerCropEvent(Request $request)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'percentage' => 'required|numeric|min:0|max:100',
                'image' => 'max:150',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                CropEvent::create(array_merge($request->all(), array(
                    'image' => $this->saveImage('cropEvent', $request->name, $request->image, 1280, 427)
                )));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerCropEvent
    //////////////////////////////////////////////////////////////////////  cropEventTable
    public function cropEventTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $cropEventTable =CropEvent::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($cropEventTable);

        }
    }
    //////////////////////////////////////////////////////////////////////  cropEventTable

    //////////////////////////////////////////////////////////////////////  selectCropEvent
    public function selectCropEvent($id)
    {
        if (Gate::allows('administrator')) {
            $selectCropEvent = CropEvent::where('id', $id)->first();
            return response()->json($selectCropEvent);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectCropEvent
    //////////////////////////////////////////////////////////////////////  editCropEvent
    public function editCropEvent(Request $request, $id)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'percentage' => 'required|numeric|min:0|max:100',
                'image' => 'max:150',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $event = CropEvent::find($id);
                $event->update(array_merge($request->all(), array(
                    'image' => $this->saveImage('cropEvent', $request->name, $request->image, 1280, 427)
                )));
                return response()->json([
                    'type' => 'success',
                    'title' => 'عملیات با موفقیت انجام شد',
                    'text' => ' ',
                    'status' => 555
                ]);
            }
    }
    //////////////////////////////////////////////////////////////////////  editCropEvent
    //////////////////////////////////////////////////////////////////////  deleteCropEvent
    public function deleteCropEvent($id)
    {
        if (Gate::allows('administrator')) {
            $cropSegment = CropEvent::find($id);
            File::delete(public_path(CropEvent::find($id)->image));
            $cropSegment->delete();
            return response()->json([
                'type' => 'success',
                'title' => 'عملیات با موفقیت انجام شد',
                'text' => 'اطلاعات با موفقیت ثبت شد'
            ]);
        }
    }
    //////////////////////////////////////////////////////////////////////  deleteCropEvent
}
