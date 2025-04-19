<?php

namespace App\Http\Controllers\Panel\Component;

use App\Model\Panel\Component\ComponentSlider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Traits;


class SliderController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  Slider
    public function Slider()
    {
        if (Gate::allows('administrator')) {
            $Slider = ComponentSlider::where('status', 1)->get();
            return response()->json($Slider);
        }
    }
    //////////////////////////////////////////////////////////////////////  Slider

    //////////////////////////////////////////////////////////////////////  registerSlider
    public function registerSlider(Request $request)
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
                'name' => 'required',
                'section' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                ComponentSlider::create(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('slider',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('slider',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerSlider

    /////////////////////////////////////////////////////////////////////////////////////sliderTable
    public function sliderTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =ComponentSlider::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////sliderTable



    //////////////////////////////////////////////////////////////////////  selectSlider
    public function selectSlider($id)
    {
        if (Gate::allows('administrator')) {
            $selectSlider = ComponentSlider::where('id', $id)->first();
            return response()->json($selectSlider);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectSlider
    //////////////////////////////////////////////////////////////////////  editSlider
    public function editSlider(Request $request, $id)
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
                'name' => 'required',
                'section' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $Slider = ComponentSlider::find($id);
                $Slider->update(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('slider',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('slider',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editSlider
    //////////////////////////////////////////////////////////////////////  deleteSlider
    public function deleteSlider($id)
    {
        if (Gate::allows('administrator')) {
            $Slider = ComponentSlider::find($id);
            File::delete(public_path($Slider->image1));
            File::delete(public_path($Slider->image2));
            $Slider->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deleteSlider
}
