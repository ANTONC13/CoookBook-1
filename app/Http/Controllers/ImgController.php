<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Intervention\Image\Facades\Image;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class ImgController extends Controller
{
    public function img( Request $request, $fname ) 
    {

        $file = storage_path() . '/app/public/uploaded_imgs/' . $fname;

        if(!File::exists($file) ) { App::abort(404);
        }

        $img = Image::make($file);

        $img->resize(
            300, null, function ( $constraint ) {
                $constraint->aspectRatio();
            }
        );

        return $img->response('jpg');
    }

    public function bimg( Request $request, $fname ) 
    {

        $file = storage_path() . '/app/public/uploaded_imgs/' . $fname;

        if(!File::exists($file) ) { App::abort(404);
        }

        $img = Image::make($file);

        return $img->response('jpg');
    }
}
