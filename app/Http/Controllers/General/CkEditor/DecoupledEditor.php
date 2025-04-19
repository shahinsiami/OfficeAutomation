<?php

namespace App\Http\Controllers\General\CkEditor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DecoupledEditor extends Controller
{
    public function ckUpload(Request $request)
    {
        $this->validate($request, [
            'upload' => ['required', 'image']
        ]);

        try {
            $file = $request->upload;
            $path = str_replace('local/public/', '', public_path('/img/ckeditor/'.$request->title));
            $name = round(microtime(true) * 1000) . '-' . rand(100000, 999999) . '.';
            $fileMimeType = $file->getMimeType();
            $name = $name . str_after($fileMimeType, '/');
            $file->move(($path), $name);
            return  response()->json(['fileName'=>$name,'uploaded'=>1,'url'=>'/img/ckeditor/'.$request->title.'/' . $name],200);
        } catch (\Exception $exception) {
            return httpStatusCode::status500();
        }
    }
}
