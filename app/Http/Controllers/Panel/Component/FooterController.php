<?php

namespace App\Http\Controllers\Panel\Component;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Component\ComponentFooter;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Traits;

class FooterController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  footer
    public function Footer()
    {
        if (Gate::allows('administrator')) {
            $footer = ComponentFooter::where('status', 1)->get();
            return response()->json($footer);
        }
    }
    //////////////////////////////////////////////////////////////////////  footer

    //////////////////////////////////////////////////////////////////////  registerFooter
    public function registerFooter(Request $request)
    {
        if (Gate::allows('administrator')) {

            $validator = Validator::make($request->all(), [
                'title1' => 'required',
                'status' => 'required',
                'page_template_id' => 'required',
                'page_language_id' => 'required',
                'name' => 'required|max:50',
                'section' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                ComponentFooter::create(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('footer',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('footer',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerFooter

    /////////////////////////////////////////////////////////////////////////////////////FooterTable
    public function FooterTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $footerTable =ComponentFooter::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($footerTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////FooterTable



    //////////////////////////////////////////////////////////////////////  selectFooter
    public function selectFooter($id)
    {
        if (Gate::allows('administrator')) {
            $selectFooter = ComponentFooter::where('id', $id)->first();
            return response()->json($selectFooter);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectFooter
    //////////////////////////////////////////////////////////////////////  editFooter
    public function editFooter(Request $request, $id)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'title1' => 'required',
                'status' => 'required',
                'page_template_id' => 'required',
                'page_language_id' => 'required',
                'name' => 'required|max:50',
                'section' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $footer = ComponentFooter::find($id);
                $footer->update(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('footer',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('footer',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editFooter

    /////////////////////////////////////////////////////////////////////////////////////deleteFooter
    public function deleteFooter($id)
    {
        if (Gate::allows('administrator')) {
            $footer = ComponentFooter::find($id);
            File::delete(public_path(ComponentFooter::find($id)->image1));
            $footer->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteFooter
}
