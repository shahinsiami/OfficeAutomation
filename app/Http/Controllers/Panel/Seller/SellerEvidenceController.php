<?php

namespace App\Http\Controllers\Panel\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Area\AreaCity;
use App\Model\Area\AreaState;
use App\Model\Area\AreaZone;
use App\Model\Panel\Crop\CropCategory;
use App\Model\Panel\Seller\Seller;
use App\Model\Panel\Seller\SellerEvidence;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Traits;
use App\User;

class SellerEvidenceController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;
    //////////////////////////////////////////////////////////////////////  sellerEvidenceTable
    public function sellerEvidenceTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $sellerEvidenceTable = SellerEvidence::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($sellerEvidenceTable);

        }
    }
    //////////////////////////////////////////////////////////////////////  sellerEvidenceTable
    //////////////////////////////////////////////////////////////////////  selectSellerEvidence
        public function selectSellerEvidence($id)
        {
            if (Gate::allows('administrator')) {
                $selectSellerEvidence = SellerEvidence::with('state', 'category', 'city', 'zone')->where('id', $id)->first();
                return response()->json($selectSellerEvidence);
            }
        }
    //////////////////////////////////////////////////////////////////////  selectSellerEvidence
    //////////////////////////////////////////////////////////////////////  deleteSellerEvidence
        public function deleteSellerEvidence($id)
        {
            if (Gate::allows('administrator')) {
                $storeevidence = SellerEvidence::find($id);
                $storeevidence->delete();
                return $this->vSuccess();
            }
        }
    //////////////////////////////////////////////////////////////////////  deleteSellerEvidence
    //////////////////////////////////////////////////////////////////////  registerSellerEvidence
    public function registerSellerEvidence(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'storename' => 'required',
            'owner' => 'required',
            'postcode' => 'required|numeric',
            'phonenumber' => 'required|numeric|min:99999|max:9999999999999',
            'address' => 'required',
            'cardnumber' => 'numeric',
            'economiccode' => 'numeric',
            'companynumber' => 'numeric',
            'companynationalcode' => 'numeric',
            'area_state_id' => 'required|numeric',
            'area_city_id' => 'required|numeric',
            'area_zone_id' => 'required|numeric',
            'crop_category_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return $this->vError($validator->errors());
        }
        //validator//
        if (Gate::allows('administrator')) {
            SellerEvidence::create(array_merge($request->all(),
                array('license' => $this->saveImage('SellerStoreEvidences',$request->name,$request->license,1000,1000)),
                array('stewardship' => $this->saveImage('SellerStoreEvidences',$request->name,$request->stewardship,1000,1000)),
                array('nationalcard' => $this->saveImage('SellerStoreEvidences',$request->name,$request->nationalcard,1000,1000)),
                array('officialnewspaper' => $this->saveImage('SellerStoreEvidences',$request->name,$request->officialnewspaper,1000,1000)),
                array('registration' => $this->saveImage('SellerStoreEvidences',$request->name,$request->registration,1000,1000)),
                array('activitypermission' => $this->saveImage('SellerStoreEvidences',$request->name,$request->activitypermission,1000,1000)),
                array('formalrequest' => $this->saveImage('SellerStoreEvidences',$request->name,$request->formalrequest,1000,1000)),
                array('latestofficialnewspaper' => $this->saveImage('SellerStoreEvidences',$request->name,$request->latestofficialnewspaper,1000,1000)),
                array('user_id' => auth()->user()->id)));
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerSellerEvidence
    //////////////////////////////////////////////////////////////////////  editSellerEvidence
    public function editSellerEvidence(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'storename' => 'required',
            'owner' => 'required',
            'postcode' => 'required|numeric',
            'phonenumber' => 'required|numeric|min:99999|max:9999999999999',
            'address' => 'required',
            'cardnumber' => 'numeric',
            'economiccode' => 'numeric',
            'companynumber' => 'numeric',
            'companynationalcode' => 'numeric',
            'area_state_id' => 'required|numeric',
            'area_city_id' => 'required|numeric',
            'area_zone_id' => 'required|numeric',
            'crop_category_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return $this->vError($validator->errors());
        }
        //validator//
        if (Gate::allows('administrator')) {
            $storeupdate = SellerEvidence::find($id);
            $storeupdate->update(array_merge($request->all(),
                array('license' => $this->saveImage('SellerStoreEvidences',$request->name,$request->license,1000,1000)),
                array('stewardship' => $this->saveImage('SellerStoreEvidences',$request->name,$request->stewardship,1000,1000)),
                array('nationalcard' => $this->saveImage('SellerStoreEvidences',$request->name,$request->nationalcard,1000,1000)),
                array('officialnewspaper' => $this->saveImage('SellerStoreEvidences',$request->name,$request->officialnewspaper,1000,1000)),
                array('registration' => $this->saveImage('SellerStoreEvidences',$request->name,$request->registration,1000,1000)),
                array('activitypermission' => $this->saveImage('SellerStoreEvidences',$request->name,$request->activitypermission,1000,1000)),
                array('formalrequest' => $this->saveImage('SellerStoreEvidences',$request->name,$request->formalrequest,1000,1000)),
                array('latestofficialnewspaper' => $this->saveImage('SellerStoreEvidences',$request->name,$request->latestofficialnewspaper,1000,1000)),
                array('user_id' => auth()->user()->id)));
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editSellerEvidence
     //////////////////////////////////////////////////////////////////////  allStateForEvidence
     public function allStateForEvidence()
     {
         if (Gate::allows('administrator')) {
             $allStateForEvidence = AreaState::all();
             return response()->json($allStateForEvidence);
         }
     }
     //////////////////////////////////////////////////////////////////////  allStateForEvidence
    //////////////////////////////////////////////////////////////////////  allCityForEvidence
    public function allCityForEvidence()
    {
        if (Gate::allows('administrator')) {
            $allCityForStore = AreaCity::all();
            return response()->json($allCityForStore);
        }
    }
    //////////////////////////////////////////////////////////////////////  allCityForEvidence
    //////////////////////////////////////////////////////////////////////  selectCityForEvidence
    public function selectCityForEvidence($id)
    {
        if (Gate::allows('administrator')) {
            $selectCityForEvidence = AreaCity::where('area_state_id', $id)->get();
            return response()->json($selectCityForEvidence);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectCityForEvidence
     //////////////////////////////////////////////////////////////////////  allZoneForEvidence
     public function allZoneForEvidence()
     {
         if (Gate::allows('administrator')) {
             $allZoneForEvidence = AreaZone::all();
             return response()->json($allZoneForEvidence);
         }
     }
     //////////////////////////////////////////////////////////////////////  allZoneForEvidence
     //////////////////////////////////////////////////////////////////////  selectZoneForEvidence
     public function selectZoneForEvidence($id)
     {
         if (Gate::allows('administrator')) {
             $selectZoneForEvidence = AreaZone::where('area_city_id', $id)->get();
             return response()->json($selectZoneForEvidence);
         }
     }
     //////////////////////////////////////////////////////////////////////  selectZoneForEvidence
     //////////////////////////////////////////////////////////////////////  cropCategoryForSellerEvidence
     public function cropCategoryForSellerEvidence()
     {
         if (Gate::allows('administrator')) {
             $cropCategoryForSellerEvidence = CropCategory::all();
             return response()->json($cropCategoryForSellerEvidence);
         }
        }
     //////////////////////////////////////////////////////////////////////  selectZocropCategoryForSellerEvidenceeForEvidence
    //////////////////////////////////////////////////////////////////////  createCase
       public function createCase($id, Request $request)
       {
           if (Gate::allows('administrator')) {
               $storeupdate = SellerEvidence::find($id);
               if (!Seller::where('seller_evidence_id', $storeupdate->id)->first()) {
                   $store = Seller::create([
                       'name' => $storeupdate->storename,
                       'phonenumber' => $storeupdate->phonenumber,
                       'seller_evidence_id' => $storeupdate->id,
                       'crop_category_id' => $storeupdate->crop_category_id,
                       'user_id' => $storeupdate->user_id,
                   ]);
   //                $store->rate()->create([
   //                    'score' => '0',
   //                    'rate' => '0',
   //                    'voter' => '0'
   //                ]);
                   $storeupdate->update(array_merge(array('status' => 'فعال')));
                   $user = User::find($storeupdate->user_id);
                   $user->update(['type' => 'seller,']);
                   return $this->vSuccess();
               } else {
                   return response()->json([
                       'type' => 'error',
                       'title' => 'فروشگاه قبلا ایجاد شده است',
                       'text' => 'می توانید فروشگاه را غیر فعال کنید'
                   ]);
               }
   
           }
       }
       //////////////////////////////////////////////////////////////////////  createCase
       //////////////////////////////////////////////////////////////////////  deactivateSeller
       public function deactivateSeller ($id)
       {
           if (Gate::allows('administrator')) {
               $storeupdate = SellerEvidence::find($id);
               $storeupdate->update(array_merge(array('status' => 'غیر فعال')));
               return response()->json([
                   'type' => 'success',
                   'title' => 'فروشگاه غیر فعال شد',
                   'text' => ' '
               ]);
           }
       }
       //////////////////////////////////////////////////////////////////////  deactivateSeller
       //////////////////////////////////////////////////////////////////////  activeSeller
       public function activeSeller($id)
       {
           if (Gate::allows('administrator')) {
               $storeupdate = SellerEvidence::find($id);
               $storeupdate->update(array_merge(array('status' => 'فعال')));
               return response()->json([
                   'type' => 'success',
                   'title' => 'فعال سازی با موفقیت انجام شد',
                   'text' => ' '
               ]);
           }
       }
       //////////////////////////////////////////////////////////////////////  activeSeller
     
}
