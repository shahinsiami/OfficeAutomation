<?php

namespace App\Http\Controllers\Panel\Component;


use App\Model\Panel\Component\ComponentFlashSale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Traits;

class FlashSaleController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  flashSale
    public function flashSale()
    {
        if (Gate::allows('administrator')) {
            $flashSale = ComponentFlashSale::where('status', 1)->get();
            return response()->json($flashSale);
        }
    }
    //////////////////////////////////////////////////////////////////////  flashSale

    //////////////////////////////////////////////////////////////////////  registerFlashSale
    public function registerFlashSale(Request $request)
    {
        if (Gate::allows('administrator')) {

            $validator = Validator::make($request->all(), [
                'image1' => 'required',
                'title1' => 'required',
                'description' => 'required',
                'link' => 'required',
                'seo' => 'required',
                'status' => 'required',
                'page_template_id' => 'required',
                'page_language_id' => 'required',
                'startdate' => 'required',
                'enddate' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                ComponentFlashSale::create(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('flashSale',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('flashSale',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerFlashSale

    /////////////////////////////////////////////////////////////////////////////////////flashSaleTable
    public function flashSaleTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =ComponentFlashSale::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////flashSaleTable



    //////////////////////////////////////////////////////////////////////  selectFlashSale
    public function selectFlashSale($id)
    {
        if (Gate::allows('administrator')) {
            $selectFlashSale = ComponentFlashSale::where('id', $id)->first();
            return response()->json($selectFlashSale);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectFlashSale
    //////////////////////////////////////////////////////////////////////  editFlashSale
    public function editFlashSale(Request $request, $id)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'title1' => 'required',
                'description' => 'required',
                'status' => 'required|numeric',
                'link' => 'required',
                'seo' => 'required',
                'page_template_id' => 'required',
                'page_language_id' => 'required',
                'startdate' => 'required',
                'enddate' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $flashSale = ComponentFlashSale::find($id);
                $flashSale->update(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('flashSale',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('flashSale',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editFlashSale

    /////////////////////////////////////////////////////////////////////////////////////deleteFlashSale
    public function deleteFlashSale($id)
    {
        if (Gate::allows('administrator')) {
            $flashSale = ComponentFlashSale::find($id);
            File::delete(public_path(ComponentFlashSale::find($id)->image1));
            $flashSale->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteFlashSale
}
