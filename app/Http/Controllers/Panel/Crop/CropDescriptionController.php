<?php

namespace App\Http\Controllers\Panel\Crop;

use App\Model\Panel\Crop\CropDescription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Crop\Crop;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Traits;
class CropDescriptionController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;
    //////////////////////////////////////////////////////////////////////  allCroptForDescription
    public function allCroptForDescription(Request $request)
    {
        if (Gate::allows('administrator')) {

            $allCroptForDescription = Crop::where('name', 'like', '%' . $request->searchName . '%')->limit(100)->get();
            return response()->json($allCroptForDescription);
        }
    }
    //////////////////////////////////////////////////////////////////////  allCroptForDescription
    //////////////////////////////////////////////////////////////////////  registerCropDescription
    public function registerCropDescription(Request $request)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'crop_id' => 'required',
                'full_description' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
            Crop::find($request->crop_id)->fulldescription()->create([
                'full_description'=> $request->full_description
            ]);

            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerCropDescription
    //////////////////////////////////////////////////////////////////////  cropDescriptionTable

    public function cropDescriptionTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =CropDescription::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);

        }

    }
    //////////////////////////////////////////////////////////////////////  cropDescriptionTable
    //////////////////////////////////////////////////////////////////////  selectCropDescription
    public function selectCropDescription($id)
    {
        if (Gate::allows('administrator')) {
            $selectCropDescription = CropDescription::with('crop')->where('id', $id)->first();
            return response()->json($selectCropDescription);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectCropDescription
    //////////////////////////////////////////////////////////////////////  editCropDescription
    public function editCropDescription(Request $request)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'crop_id' => 'required',
                'full_description' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
            CropDescription::find($request->id)->update($request->all());

            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editCropDescription
    //////////////////////////////////////////////////////////////////////  deleteCropDescription
    public function deleteCropDescription($id)
    {
        if (Gate::allows('administrator')) {
            $crop = CropDescription::find($id);
            $crop->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deleteCropDescription
}



