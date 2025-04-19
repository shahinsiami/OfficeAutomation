<?php

namespace App\Http\Controllers\Panel\Component;

use App\Model\Panel\Component\ComponentAbout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Traits;

class AboutController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  about
    public function about()
    {
        if (Gate::allows('administrator')) {
            $about = ComponentAbout::where('status', 1)->get();
            return response()->json($about);
        }
    }
    //////////////////////////////////////////////////////////////////////  about

    //////////////////////////////////////////////////////////////////////  registerAbout
    public function registerAbout(Request $request)
    {
        if (Gate::allows('administrator')) {

            $validator = Validator::make($request->all(), [
                'title1' => 'required',
                'description' => 'required',
                'link' => 'required',
                'seo' => 'required',
                'status' => 'required',
                'page_template_id' => 'required',
                'page_language_id' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                ComponentAbout::create(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('about',$request->title1,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('about',$request->title1,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerAbout

    /////////////////////////////////////////////////////////////////////////////////////aboutTable
    public function aboutTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =ComponentAbout::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////aboutTable



    //////////////////////////////////////////////////////////////////////  selectAbout
    public function selectAbout($id)
    {
        if (Gate::allows('administrator')) {
            $selectAbout = ComponentAbout::where('id', $id)->first();
            return response()->json($selectAbout);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectAbout
    //////////////////////////////////////////////////////////////////////  editAbout
    public function editAbout(Request $request, $id)
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
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $about = ComponentAbout::find($id);
                $about->update(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('about',$request->title1,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('about',$request->title1,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editAbout

    /////////////////////////////////////////////////////////////////////////////////////deleteAbout
    public function deleteAbout($id)
    {
        if (Gate::allows('administrator')) {
            $about = ComponentAbout::find($id);
            File::delete(public_path(ComponentAbout::find($id)->image1));
            $about->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteAbout
}
