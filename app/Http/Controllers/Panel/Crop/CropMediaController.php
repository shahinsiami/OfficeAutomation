<?php

namespace App\Http\Controllers\Panel\Crop;

use App\Model\Panel\Crop\CropMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Crop\Crop;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Traits;
use Illuminate\Support\Facades\File;

class CropMediaController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  allCroptForMedia
    public function allCroptForMedia(Request $request)
    {
        if (Gate::allows('administrator')) {

            $allCroptForMedia = Crop::where('name', 'like', '%' . $request->searchName . '%')->limit(100)->get();
            return response()->json($allCroptForMedia);
        }
    }
    //////////////////////////////////////////////////////////////////////  allCroptForMedia
    //////////////////////////////////////////////////////////////////////  registerCropMedia
    public function registerCropMedia(Request $request)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'crop_id' => 'required',
                'file' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
            if (!file_exists('Data/Document/Product/' . $request->crop_id)) {
                File::makeDirectory('Data/Document/Product/' . $request->crop_id, $mode = 0777, true, true);
            };
            foreach (json_decode($request->file) as $item) {
                rename(public_path('tempFile/' . $item->folder . '/' . $item->file), public_path('Data/Document/Product/' . $request->crop_id . '/' . $item->file));
                $file = 'Data/Document/Product/' . $request->crop_id . '/' . $item->file;
                $extension = preg_replace('/^.*\.([^.]+)$/D', '$1', $file);
                CropMedia::create(
                    [
                        'crop_id'=>$request->crop_id,
                        'file' => $file,
                        'extension' => $extension
                    ]
                );
            }

            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerCropMedia
    //////////////////////////////////////////////////////////////////////  cropMediaTable

    public function cropMediaTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable = CropMedia::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);

        }

    }
    //////////////////////////////////////////////////////////////////////  cropMediaTable
    //////////////////////////////////////////////////////////////////////  selectCropMedia
    public function selectCropMedia($id)
    {
        if (Gate::allows('administrator')) {
            $selectCropMedia = CropMedia::with('crop')->where('id', $id)->first();
            return response()->json($selectCropMedia);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectCropMedia
    //////////////////////////////////////////////////////////////////////  editCropMedia
    public function editCropMedia(Request $request)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'crop_id' => 'required',
                'full_Media' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
            $media = CropMedia::find($request->id);
            if (!file_exists('Data/Document/Product/' . $request->crop_id)) {
                File::makeDirectory('Data/Document/Product/' . $request->crop_id, $mode = 0777, true, true);
            };
            foreach (json_decode($request->file) as $item) {
                rename(public_path('tempFile/' . $item->folder . '/' . $item->file), public_path('Data/Document/Product/' . $request->crop_id . '/' . $item->file));
                $file = 'Data/Document/Product/' . $request->crop_id . '/' . $item->file;
                $extension = preg_replace('/^.*\.([^.]+)$/D', '$1', $file);
                $media->update(
                    [
                        'file' => $file,
                        'extension' => $extension
                    ]
                );

                return $this->vSuccess();
            }
        }
    }
    //////////////////////////////////////////////////////////////////////  editCropMedia
    //////////////////////////////////////////////////////////////////////  deleteCropMedia
    public function deleteCropMedia($id)
    {
        if (Gate::allows('administrator')) {
            $crop = CropMedia::find($id);
            $crop->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deleteCropMedia
}
