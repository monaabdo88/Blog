<?php 
namespace App\Http\Trait;

use \Illuminate\Support\Str;

trait UploadImage
{
    public function upload($file,$path_folder)
    {
        $filename = Str::uuid() . $file->getClientOriginalName();
        $file->move(public_path('uploads/'.$path_folder), $filename);
        //$path = $path_folder.'/' . $filename;
        return $filename;
    }
}