<?php

namespace App\Http\Controllers\Panel\Seller;

use App\Model\Panel\Crop\CropCategory;
use App\Model\Panel\Crop\CropSegment;
use App\Model\Panel\Crop\CropSubCategory;
use App\Model\Panel\Crop\CropSubSegment;
use App\Model\Panel\Seller\SellerEvidence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Model\Panel\Seller\Seller;
use Illuminate\Support\Facades\Validator;
use App\Model\Panel\Seller\SellerSubSegment;


use App\Traits;

class SellerContractController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;
    //////////////////////////////////////////////////////////////////////  sellerLicenseTable
    public function sellerLicenseTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $sellerEvidenceTable = Seller::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($sellerEvidenceTable);

        }

    }
    //////////////////////////////////////////////////////////////////////  sellerLicenseTable
    //////////////////////////////////////////////////////////////////////  selectSellerLicense
    public function selectSellerLicense($id)
    {
        if (Gate::allows('administrator')) {
            $selectSellerLicense = Seller::where('id', $id)->first()->with('category')->first();
            return response()->json($selectSellerLicense);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectSellerLicense
    //////////////////////////////////////////////////////////////////////  categoryForSellerLicence
    public function categoryForSellerLicence()
    {
        if (Gate::allows('administrator')) {
            $categoryForSellerLicence = CropCategory::all();
            return response()->json($categoryForSellerLicence);
        }
    }
    //////////////////////////////////////////////////////////////////////  categoryForSellerLicence
    //////////////////////////////////////////////////////////////////////  subcategoryForSellerLicence
    public function subcategoryForSellerLicence()
    {
        if (Gate::allows('administrator')) {
            $subcategoryForSellerLicence = CropSubCategory::all();
            return response()->json($subcategoryForSellerLicence);
        }
    }
    //////////////////////////////////////////////////////////////////////  subcategoryForSellerLicence
    //////////////////////////////////////////////////////////////////////  subcategoryForSellerLicenceBySelection
    public function subcategoryForSellerLicenceBySelection($id)
    {
        if (Gate::allows('administrator')) {
            $subcategoryForSellerLicenceBySelection = CropCategory::get()->where('id', $id)->first()->subcategory()->get();
            return response()->json($subcategoryForSellerLicenceBySelection);
        }
    }
    //////////////////////////////////////////////////////////////////////  subcategoryForSellerLicenceBySelection
    //////////////////////////////////////////////////////////////////////  segmentForSellerLicence
    public function segmentForSellerLicence()
    {
        if (Gate::allows('administrator')) {
            $segmentForSellerLicence = CropSegment::all();
            return response()->json($segmentForSellerLicence);
        }
    }
    //////////////////////////////////////////////////////////////////////  segmentForSellerLicence
    //////////////////////////////////////////////////////////////////////  segmentForSellerLicenceBySelection
    public function segmentForSellerLicenceBySelection($id)
    {
        if (Gate::allows('administrator')) {
            $segmentForSellerLicenceBySelection = CropSubCategory::get()->where('id', $id)->first()->segment()->get();
            return response()->json($segmentForSellerLicenceBySelection);
        }
    }
    //////////////////////////////////////////////////////////////////////  segmentForSellerLicenceBySelection
    //////////////////////////////////////////////////////////////////////  subSegmentForSellerLicence
    public function subSegmentForSellerLicence()
    {
        if (Gate::allows('administrator')) {
            $subSegmentForSellerLicence = CropSubSegment::all();
            return response()->json($subSegmentForSellerLicence);
        }
    }
    //////////////////////////////////////////////////////////////////////  subSegmentForSellerLicence
    //////////////////////////////////////////////////////////////////////  subSegmentForSellerLicenceBySelection
    public function subSegmentForSellerLicenceBySelection($id)
    {
        if (Gate::allows('administrator')) {
            $subSegmentForSellerLicenceBySelection = CropSegment::get()->where('id', $id)->first()->subsegment()->get();
            return response()->json($subSegmentForSellerLicenceBySelection);
        }
    }
    //////////////////////////////////////////////////////////////////////  subSegmentForSellerLicenceBySelection
    //////////////////////////////////////////////////////////////////////  registSellerLicence
    public function registSellerLicence(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'percentage' => 'required|numeric|min:0|max:100',
            'crop_sub_segment_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
        }
        //validator//
        if (Gate::allows('administrator')) {
            $subsegment = CropSubSegment::find($request->crop_sub_segment_id);
            $store = Seller::find($request->seller_id);
            $StoreSubSegment = SellerSubSegment::where('crop_sub_segment_id', $request->crop_sub_segment_id)->where('seller_id', $store->id);
            if ($StoreSubSegment) {
                $StoreSubSegment->delete();
            }
            SellerSubSegment::create(array_merge($request->all(), array('subsegmentname' => $subsegment->name), array('storename' => $store->name)));
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registSellerLicence
    //////////////////////////////////////////////////////////////////////  sellerPerecentageTable
    public function sellerPerecentageTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $sellerEvidenceTable = SellerSubSegment::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($sellerEvidenceTable);

        }
    }
    //////////////////////////////////////////////////////////////////////  sellerPerecentageTable
    //////////////////////////////////////////////////////////////////////  selectSellerPrecentage
    public function selectSellerPrecentage($id)
    {
        if (Gate::allows('administrator')) {
            $selectSellerPrecentage = SellerSubSegment::find($id);
            return response()->json($selectSellerPrecentage);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectSellerPrecentage
    //////////////////////////////////////////////////////////////////////  editSellerPrecentage
    public function editSellerPrecentage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'percentage' => 'required|numeric|min:0|max:100',
        ]);
        if ($validator->fails()) {
            return $this->vError($validator->errors());
        }
        //validator//
        if (Gate::allows('administrator')) {
            $StoreSubSegmentedit = SellerSubSegment::find($request->id);
            $StoreSubSegmentedit->update(array_merge($request->all(), array('percentage' => $request->percentage)));
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editSellerPrecentage

}
