<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function image(Request $request){
        $folder_name = $request->path;
        if(!isset($folder_name)){
            return BaseController::response(false, 'required, path');
        }
        if($request->hasFile('image')){
            $extension = $request->file('image')->extension();
            $path = "images/$folder_name";
            $file_name = time().'-'.Str::random(32).'.'.$extension;
            $request->file('image')->move(public_path($path), $file_name);
            $data['image'] = $path.'/'.$file_name;
            return BaseController::response(true, 'successful', ['path'=>$data['image']]);
        }

    }
}
