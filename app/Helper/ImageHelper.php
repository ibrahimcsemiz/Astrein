<?php

namespace App\Helper;

use Illuminate\Support\Facades\File;

class ImageHelper
{
    static function singleUpload($name, $directory, $file)
    {
        if (!empty($file)) {
            $imageDestinationPath = $directory;

            $postImage = $name . "." . $file->getClientOriginalExtension();

            $file->move($imageDestinationPath, $postImage);

            return $postImage;
        } else {
            return false;
        }
    }

    static function delete($files = [])
    {
        return File::delete($files);
    }
}
