<?php

namespace App\Http\Controllers\Panel\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Area\AreaCity;
use App\Model\Area\AreaState;
use App\Model\Area\AreaZone;
use App\Model\Panel\Seller\SellerAddress;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

use App\Traits;
class SellerAddressController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  registSellerAddress
    public function registSellerAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'area_state_id' => 'required|numeric',
            'area_city_id' => 'required|numeric|',
            'area_zone_id' => 'required|numeric|',
            'superscription' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zone' => 'required',
            'postcode' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->vError($validator->errors());
        }
        //validator//
        if (Gate::allows('administrator')) {
            $seller_id = auth()->user()->seller()->first()->id;
            SellerAddress::create(array_merge($request->all(), array('seller_id' => $seller_id)));
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registSellerAddress
    //////////////////////////////////////////////////////////////////////  sellerAddressTable
    public function sellerAddressTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $sellerEvidenceTable = SellerAddress::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($sellerEvidenceTable);

        }
    }
    //////////////////////////////////////////////////////////////////////  sellerAddressTable
    //////////////////////////////////////////////////////////////////////  selectSellerAddress
    public function selectSellerAddress($id)
    {
        if (Gate::allows('administrator')) {
            $selectSellerAddress = SellerAddress::find($id);
            return response()->json($selectSellerAddress);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectSellerAddress
    //////////////////////////////////////////////////////////////////////  editSellerAddress
    public function editSellerAddress(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'area_state_id' => 'required|numeric',
            'area_city_id' => 'required|numeric|',
            'area_zone_id' => 'required|numeric|',
            'superscription' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zone' => 'required',
            'postcode' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->vError($validator->errors());
        }
        //validator//
        if (Gate::allows('administrator')) {
            $seller_id = auth()->user()->seller()->first()->id;
            $storeAddress = SellerAddress::find($id);
            $storeAddress->update(array_merge($request->all(), array('seller_id' => $seller_id)));
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editSellerAddress
    //////////////////////////////////////////////////////////////////////  deletSellerAddress
    public function deletSellerAddress($id)
    {
        if (Gate::allows('administrator')) {
            $deleteStoreAddress = SellerAddress::find($id);
            $deleteStoreAddress->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deletSellerAddress
    //////////////////////////////////////////////////////////////////////  allStateForAddress
    public function allStateForAddress()
    {
        if (Gate::allows('administrator')) {
            $allStateForAddress = AreaState::all();
            return response()->json($allStateForAddress);
        }
    }
    //////////////////////////////////////////////////////////////////////  allStateForAddress
    //////////////////////////////////////////////////////////////////////  allCityForAddress
    public function allCityForAddress()
    {
        if (Gate::allows('administrator')) {
            $allCityForAddress = AreaCity::all();
            return response()->json($allCityForAddress);
        }
    }
    //////////////////////////////////////////////////////////////////////  allCityForAddress
    //////////////////////////////////////////////////////////////////////  selectCityForAddress
    public function selectCityForAddress($id)
    {
        if (Gate::allows('administrator')) {
            $selectCityForAddress = AreaCity::where('area_state_id', $id)->get();
            return response()->json($selectCityForAddress);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectCityForAddress


    //////////////////////////////////////////////////////////////////////  allZoneForAddress
    public function allZoneForAddress()
    {
        if (Gate::allows('administrator')) {
            $allZoneForAddress = AreaZone::all();
            return response()->json($allZoneForAddress);
        }
    }
    //////////////////////////////////////////////////////////////////////  allZoneForAddress
    //////////////////////////////////////////////////////////////////////  selectZoneForAddress
    public function selectZoneForAddress($id)
    {
        if (Gate::allows('administrator')) {
            $selectZoneForAddress = AreaZone::where('area_city_id', $id)->get();
            return response()->json($selectZoneForAddress);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectZoneForAddress
}
