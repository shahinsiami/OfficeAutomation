<?php

namespace App\Http\Controllers\Panel\Component;

use App\Model\Panel\Component\ComponentManyColumnFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Traits;

class ManyColumnFileController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  manyColumnFile
    public function manyColumnFile()
    {
        if (Gate::allows('administrator')) {
            $manyColumnFile = ComponentManyColumnFile::where('status', 1)->get();
            return response()->json($manyColumnFile);
        }
    }
    //////////////////////////////////////////////////////////////////////  manyColumnFile

    //////////////////////////////////////////////////////////////////////  registerManyColumnFile
    public function registerManyColumnFile(Request $request)
    {
        if (Gate::allows('administrator')) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'image1' => 'required',
                'title1' => 'required',
                'description' => 'required',
                'file' => 'required',
                'seo' => 'required',
                'status' => 'required',
                'page_template_id' => 'required',
                'page_language_id' => 'required',
                'section' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }

            if ($request->file !== null) {
                $fileArray = [];
                $path =  'img/database/'.env('APP_NAME') .'/file/' . $request->name;
                if (!file_exists($path)) {
                    File::makeDirectory($path, $mode = 0777, true, true);
                };
                foreach (json_decode($request->file) as $item) {
                    rename(public_path('tempFile/' . $item->folder . '/' . $item->file), public_path($path . '/' . $item->file));
                    $file = $path . '/' . $item->file;
                    array_push($fileArray,$file);
                }
            }
            //validator//
            ComponentManyColumnFile::create(array_merge($request->all(),array('file'=>json_encode($fileArray)),
                array( 'image1' => $this->saveImageAbsolute('manyColumnFile',$request->name,$request->image1)),
                array( 'image2' => $this->saveImageAbsolute('manyColumnFile',$request->name,$request->image2))));
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerManyColumnFile
    /////////////////////////////////////////////////////////////////////////////////////manyColumnFileTable
    public function manyColumnFileTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =ComponentManyColumnFile::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////manyColumnFileTable



    //////////////////////////////////////////////////////////////////////  selectManyColumnFile
    public function selectManyColumnFile($id)
    {
        if (Gate::allows('administrator')) {
            $selectManyColumnFile = ComponentManyColumnFile::where('id', $id)->first();
            return response()->json($selectManyColumnFile);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectManyColumnFile
    //////////////////////////////////////////////////////////////////////  editManyColumnFile
    public function editManyColumnFile(Request $request, $id)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'title1' => 'required',
                'description' => 'required',
                'status' => 'required|numeric',
              
                'seo' => 'required',
                'page_template_id' => 'required',
                'page_language_id' => 'required',
                'section' => 'required',

            ]);
                       if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            
            if ($request->file !== null) {
                $fileArray = [];
                $path =  'img/database/'.env('APP_NAME') .'/file/' . $request->name;
                if (!file_exists($path)) {
                    File::makeDirectory($path, $mode = 0777, true, true);
                };
                foreach (json_decode($request->file) as $item) {
                    rename(public_path('tempFile/' . $item->folder . '/' . $item->file), public_path($path . '/' . $item->file));
                    $file = $path . '/' . $item->file;
                    array_push($fileArray,$file);
                }
            }else{
			$fileArray = json_decode(ComponentManyColumnFile::find($id)->first()->file);
			}
            //validator//
            $manyColumnFile = ComponentManyColumnFile::find($id);
            $manyColumnFile->update(array_merge($request->all(),array('file'=>json_encode($fileArray)),
                array( 'image1' => $this->saveImageAbsolute('manyColumnFile',$request->name,$request->image1)),
                array( 'image2' => $this->saveImageAbsolute('manyColumnFile',$request->name,$request->image2))));
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editManyColumnFile
    /////////////////////////////////////////////////////////////////////////////////////deleteManyColumnFile
    public function deleteManyColumnFile($id)
    {
        if (Gate::allows('administrator')) {
            $manyColumnFile = ComponentManyColumnFile::find($id);
            File::delete(public_path(ComponentManyColumnFile::find($id)->image1));
            $manyColumnFile->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteManyColumnFile
}
