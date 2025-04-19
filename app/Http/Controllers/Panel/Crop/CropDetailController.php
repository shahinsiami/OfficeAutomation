<?php

namespace App\Http\Controllers\Panel\Crop;


use App\Model\Panel\Crop\CropDetail;
use App\Model\Panel\Crop\CropSubSegment;
use App\Exports\V1\DetailExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Traits;
class CropDetailController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;
    //////////////////////////////////////////////////////////////////////  cropSubSegmentForCropDetail
    public function cropSubSegmentForCropDetail()
    {
        if (Gate::allows('administrator')) {
            $cropSubSegmentForCropDetail = CropSubSegment::all();
            return response()->json($cropSubSegmentForCropDetail);
        }
    }
    //////////////////////////////////////////////////////////////////////  cropSubSegmentForCropDetail
    //////////////////////////////////////////////////////////////////////  registerCropDetail
    public function registerCropDetail(Request $request)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'attribute' => 'required',
                'description' => 'required',
                'crop_sub_segment_id' => 'required|numeric|',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                CropDetail::create($request->all());
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerCropDetail
    //////////////////////////////////////////////////////////////////////  cropDetailTable
    public function cropDetailTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =CropDetail::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    //////////////////////////////////////////////////////////////////////  cropDetailTable
    //////////////////////////////////////////////////////////////////////  selectCropDetail
    public function selectCropDetail($id)
    {
        if (Gate::allows('administrator')) {
            $selectCropDetail = CropDetail::where('id', $id)->first();
            return response()->json($selectCropDetail);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectCropDetail
    ///
    //////////////////////////////////////////////////////////////////////  editCropDetail
    public function editCropDetail(Request $request, $id)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'attribute' => 'required',
                'description' => 'required',
                'crop_sub_segment_id' => 'required|numeric|',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $cropDetail = CropDetail::find($id);
                $cropEdit = $request->all();
                $cropDetail->update($cropEdit);
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editCropDetail

    //////////////////////////////////////////////////////////////////////  deleteCropDetail
    public function deleteCropDetail($id)
    {
        if (Gate::allows('administrator')) {
            $cropDetail = CropDetail::find($id);
            $cropDetail->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deleteCropDetail
}
