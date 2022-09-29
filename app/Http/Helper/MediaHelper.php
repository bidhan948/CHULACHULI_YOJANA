<?php

namespace App\Http\Helper;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MediaHelper
{
    public function uploadSingleImage($image, $folder = "upload")
    {
        $orginalName = Str::before($image->getClientOriginalName(), '.');
        $imageName =  $orginalName . "-" . Str::random(10) . "." . $image->extension();
        $image->storeAs($folder, $imageName, 'public');
        return $imageName;
    }

   
}
