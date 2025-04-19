<?php

namespace App\Http\Controllers\Panel\Discount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Traits;
use Morilog\Jalali\Jalalian;
use App\Model\Panel\Discount\Discount;

class DiscountController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  registDiscount
    public function registDiscount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required',
            'count' => 'required',
            'minprice' => 'required|numeric',
            'startdate' => 'required',
            'enddate' => 'required',
            'status' => 'required',
            'percentage' => 'numeric|min:0|max:100',
        ]);
        if ($validator->fails()) {
            return $this->vError($validator->errors());
        }
        //validator//
        if (Gate::allows('administrator')) {
            $startDateTemp = Jalalian::fromFormat('Y-m-d H:i:s', $request->startdate);
            $startDate = $startDateTemp->toCarbon()->toDateTimeString();
            $endDateTemp = Jalalian::fromFormat('Y-m-d H:i:s', $request->enddate);
            $endDate = $endDateTemp->toCarbon()->toDateTimeString();
            Discount::create(array_merge($request->all(), array('startdate' => $startDate), array('enddate' => $endDate)));
            return $this->vSuccess();
        }

    }
    //////////////////////////////////////////////////////////////////////  registDiscount
    //////////////////////////////////////////////////////////////////////  tableDiscount
    public function tableDiscount(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =Discount::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);

        }
    }
    //////////////////////////////////////////////////////////////////////  tableDiscount
    //////////////////////////////////////////////////////////////////////  selectDiscount
    public function selectDiscount($id)
    {
        if (Gate::allows('administrator')) {
            $selectDiscount = Discount::where('id', $id)->first();
            return response()->json($selectDiscount);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectDiscount

    //////////////////////////////////////////////////////////////////////  editDiscount
    public function editDiscount(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required',
            'count' => 'required',
            'minprice' => 'required|numeric',
            'startdate' => 'required',
            'enddate' => 'required',
            'status' => 'required',
            'percentage' => 'numeric|min:0|max:100',
        ]);
        if ($validator->fails()) {
            return $this->vError($validator->errors());
        }
        //validator//
        if (Gate::allows('administrator')) {
            /// date
            $startDateTemp = Jalalian::fromFormat('Y-m-d H:i:s', $request->startdate);
            $startDate = $startDateTemp->toCarbon()->toDateTimeString();
            $endDateTemp = Jalalian::fromFormat('Y-m-d H:i:s', $request->enddate);
            $endDate = $endDateTemp->toCarbon()->toDateTimeString();
            /// date
            $editDiscount = Discount::find($id);
            $editDiscount->update(array_merge($request->all(), array('startdate' => $startDate), array('enddate' => $endDate)));
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editDiscount
    //////////////////////////////////////////////////////////////////////  deletDiscount
    public function deletDiscount($id)
    {
        if (Gate::allows('administrator')) {
            $BillDiscount = Discount::find($id);
            $BillDiscount->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deletDiscount

    //////////////////////////////////////////////////////////////////////  excelDiscount
    public function excelDiscount()
    {
        if (Gate::allows('administrator')) {
            return Excel::download(new Discount(), 'discount.xls');
        }
    }
    //////////////////////////////////////////////////////////////////////  excelDiscount
}
