<?php

namespace App\Http\Controllers\Panel\Component;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Component\ComponentHeader;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Traits;


class HeaderController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  header
    public function Header()
    {
        if (Gate::allows('administrator')) {
            $header = ComponentHeader::where('status', 1)->get();
            return response()->json($header);
        }
    }
    //////////////////////////////////////////////////////////////////////  header

    //////////////////////////////////////////////////////////////////////  registerHeader
    public function registerHeader(Request $request)
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
                ComponentHeader::create(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('header',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('header',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerHeader

    /////////////////////////////////////////////////////////////////////////////////////HeaderTable
    public function HeaderTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $headerTable =ComponentHeader::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($headerTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////HeaderTable



    //////////////////////////////////////////////////////////////////////  selectHeader
    public function selectHeader($id)
    {
        if (Gate::allows('administrator')) {
            $selectHeader = ComponentHeader::where('id', $id)->first();
            return response()->json($selectHeader);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectHeader
    //////////////////////////////////////////////////////////////////////  editHeader
    public function editHeader(Request $request, $id)
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
                $header = ComponentHeader::find($id);
                $header->update(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('header',$request->name,$request->image1)),
                    array( 'image2' => $this->saveImageAbsolute('header',$request->name,$request->image2))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editHeader

    /////////////////////////////////////////////////////////////////////////////////////deleteHeader
    public function deleteHeader($id)
    {
        if (Gate::allows('administrator')) {
            $header = ComponentHeader::find($id);
            File::delete(public_path(ComponentHeader::find($id)->image1));
            $header->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteHeader
}
