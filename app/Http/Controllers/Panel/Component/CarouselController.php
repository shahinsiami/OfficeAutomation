<?php

namespace App\Http\Controllers\Panel\Component;

use App\Model\Panel\Component\ComponentCarousel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Traits;
class CarouselController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  Carousel
    public function Carousel()
    {
        if (Gate::allows('administrator')) {
            $carousel = ComponentCarousel::where('status', 1)->get();
            return response()->json($carousel);
        }
    }
    //////////////////////////////////////////////////////////////////////  Carousel

    //////////////////////////////////////////////////////////////////////  registerCarousel
    public function registerCarousel(Request $request)
    {
        if (Gate::allows('administrator')) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'image1' => 'required',
                'title1' => 'required',
                'description' => 'required',
                'link' => 'required',
                'seo' => 'required',
                'status' => 'required',
                'page_template_id' => 'required',
                'page_language_id' => 'required',
                'section' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                ComponentCarousel::create(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('Carousel',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('Carousel',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerCarousel

    /////////////////////////////////////////////////////////////////////////////////////carouselTable
    public function carouselTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =ComponentCarousel::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////carouselTable



    //////////////////////////////////////////////////////////////////////  selectCarousel
    public function selectCarousel($id)
    {
        if (Gate::allows('administrator')) {
            $selectCarousel = ComponentCarousel::where('id', $id)->first();
            return response()->json($selectCarousel);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectCarousel
    //////////////////////////////////////////////////////////////////////  editCarousel
    public function editCarousel(Request $request, $id)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'title1' => 'required',
                'description' => 'required',
                'status' => 'required|numeric',
                'link' => 'required',
                'seo' => 'required',
                'page_template_id' => 'required',
                'page_language_id' => 'required',
                'section' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $carousel = ComponentCarousel::find($id);
                $carousel->update(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('Carousel',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('Carousel',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editCarousel

    /////////////////////////////////////////////////////////////////////////////////////deleteCarousel
    public function deleteCarousel($id)
    {
        if (Gate::allows('administrator')) {
            $carousel = ComponentCarousel::find($id);
            File::delete(public_path(ComponentCarousel::find($id)->image1));
            $carousel->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteCarousel
}
