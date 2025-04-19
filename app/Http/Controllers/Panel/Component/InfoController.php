<?php

namespace App\Http\Controllers\Panel\Component;

use App\Model\Panel\Component\ComponentInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Traits;



class InfoController extends Controller
{

    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  info
    public function info()
    {
        if (Gate::allows('administrator')) {
            $info = ComponentInfo::where('status', 1)->get();
            return response()->json($info);
        }
    }
    //////////////////////////////////////////////////////////////////////  info

    //////////////////////////////////////////////////////////////////////  registerInfo
    public function registerInfo(Request $request)
    {
        if (Gate::allows('administrator')) {

            $validator = Validator::make($request->all(), [
                'type' => 'required',
                'address' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                ComponentInfo::create(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('info',$request->title1,$request->image1))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerInfo

    /////////////////////////////////////////////////////////////////////////////////////infoTable
    public function infoTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =ComponentInfo::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////infoTable



    //////////////////////////////////////////////////////////////////////  selectInfo
    public function selectInfo($id)
    {
        if (Gate::allows('administrator')) {
            $selectInfo = ComponentInfo::where('id', $id)->first();
            return response()->json($selectInfo);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectInfo
    //////////////////////////////////////////////////////////////////////  editInfo
    public function editInfo(Request $request, $id)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'type' => 'required',
                'address' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $info = ComponentInfo::find($id);
                $info->update(array_merge($request->all(),
                    array( 'image1' => $this->saveImageAbsolute('info',$request->title1,$request->image1))));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editInfo

    /////////////////////////////////////////////////////////////////////////////////////deleteInfo
    public function deleteInfo($id)
    {
        if (Gate::allows('administrator')) {
            $info = ComponentInfo::find($id);
            File::delete(public_path(ComponentInfo::find($id)->image1));
            $info->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteInfo




}
