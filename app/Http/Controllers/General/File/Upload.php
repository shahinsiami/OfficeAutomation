<?php

namespace App\Http\Controllers\General\File;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class Upload extends Controller
{
    public function uploadFile(Request $request)
    {
        $tempFolder = time() . mt_rand(100, 1000);
        $filename = $request->file->getClientOriginalName();
        $request->file->move(public_path('tempFile/' . $tempFolder), $filename);
        return response()->json(['file' => $filename, 'folder' => $tempFolder]);
    }

    public function removeFile(Request $request)
    {
        function dir_is_empty($dirname)
        {
            if (!is_dir($dirname)) return false;
            foreach (scandir($dirname) as $file) {
                if (!in_array($file, array('.', '..', '.svn', '.git'))) return false;
            }
            return true;
        }

        if(file_exists(public_path('tempFile/' . $request->folder . '/' . $request->file))){
        unlink(public_path('tempFile/' . $request->folder . '/' . $request->file));
        if (dir_is_empty(public_path('tempFile/' . $request->folder))) {
            rmdir(public_path('tempFile/' . $request->folder));
        }
    }
        return response()->json(['file' => $request->file, 'folder' => $request->folder]);

    }
}
