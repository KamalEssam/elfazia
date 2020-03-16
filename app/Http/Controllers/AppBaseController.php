<?php

namespace App\Http\Controllers;

use function Helper\Common\upload;
use Illuminate\Http\Request;

class AppBaseController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function uploadFile(Request $request,$field , $thum = true)
    {
        if ($request->hasFile($field)) {
            $uploaded = upload($request->file($field), $thum);
            if ($thum) {
                $file = $uploaded['thum'];
            } else {
                $file = $uploaded['img'];
            }
            return $file;
        } else {
            return "";
        }
    }
}
