<?php

namespace App\Http\Controllers\Panel\Crop;

use App\Model\Panel\Crop\CropAttribute;
use App\Model\Panel\Crop\CropSubSegment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Crop\Crop;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Traits;

class CropAttributeController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;
    //////////////////////////////////////////////////////////////////////  allCroptForAttribute
    public function allCroptForAttribute(Request $request)
    {
        if (Gate::allows('administrator')) {

            $allCroptForAttribute = Crop::where('name', 'like', '%' . $request->searchName . '%')->limit(100)->get();
            return response()->json($allCroptForAttribute);
        }
    }
    //////////////////////////////////////////////////////////////////////  allCroptForAttribute
    //////////////////////////////////////////////////////////////////////  registerCropAttribute
    public function registerCropAttribute(Request $request)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'crop_id' => 'required',
                'details' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
            Crop::find($request->crop_id)->Attribute()->create([
                'details'=> $request->details
            ]);

            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerCropAttribute
    //////////////////////////////////////////////////////////////////////  cropAttributeTable

    public function cropAttributeTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =CropAttribute::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);

        }

    }
    //////////////////////////////////////////////////////////////////////  cropAttributeTable
    //////////////////////////////////////////////////////////////////////  selectCropAttribute
    public function selectCropAttribute($id)
    {
        if (Gate::allows('administrator')) {
            $selectCropAttribute = CropAttribute::with('crop')->where('id', $id)->first();
            return response()->json($selectCropAttribute);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectCropAttribute
    //////////////////////////////////////////////////////////////////////  editCropAttribute
    public function editCropAttribute(Request $request)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'crop_id' => 'required',
                'details' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
            CropAttribute::find($request->id)->update($request->all());

            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editCropAttribute
    //////////////////////////////////////////////////////////////////////  deleteCropAttribute
    public function deleteCropAttribute($id)
    {
        if (Gate::allows('administrator')) {
            $crop = CropAttribute::find($id);
            $crop->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deleteCropAttribute
    //////////////////////////////////////////////////////////////////////  cropDetailForCropsAttribute
    public function cropDetailForCropsAttribute($id)
    {
        if (Gate::allows('administrator')) {
            $cropDetailForCropAttribute = CropSubSegment::where('id', $id)->first()->detail()->get();
            return response()->json($cropDetailForCropAttribute);
        }
    }
    //////////////////////////////////////////////////////////////////////  cropDetailForCropsAttribute
}
