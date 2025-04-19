<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait uploadImage
{
    public function saveImage($category, $name, $file, $width, $height)
    {
        $basePath = 'img/database/'.env('APP_NAME') .'/'. $category . '/' . $name;
        if (gettype($file) == 'string') {
            return $file;
        } else
            if ($file == null) {
                return null;
            } else {
                $subPath = $basePath . '/' . $name . '_' . mt_rand(100, 1000) . $file->getExtension();
                if (!file_exists($subPath)) {
                    File::makeDirectory($basePath, $mode = 0777, true, true);
                };
                image::make($file->getRealPath())->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path() . '/' . $subPath);
                return $subPath;
            }
    }
    public function saveImageAbsolute($category, $name, $file)
    {
        $basePath = 'img/database/'.env('APP_NAME') .'/' . $category . '/' . $name;
        if (gettype($file) == 'string') {
            return $file;
        } else
            if ($file == null) {
                return null;
            } else {
                $subPath = $basePath . '/' . $name . '_' . mt_rand(100, 1000) . $file->getExtension();
                if (!file_exists($subPath)) {
                    File::makeDirectory($basePath, $mode = 0777, true, true);
                };
                image::make($file->getRealPath())->save(public_path() . '/' . $subPath);
                return $subPath;
            }
    }

}
