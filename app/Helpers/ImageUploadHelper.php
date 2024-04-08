<?php

namespace App\Helpers;

use Request;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use File;

class ImageUploadHelper
{

    private static $mainImgWidth = 900;
    private static $mainImgHeight = 900;

    private static $thumbImgWidth1 = 250;
    private static $thumbImgHeight1 = 250;

    private static $thumbFolder1 = '/thumbnails/250';

    public static function UploadImage($destinationPath, $field, $newName = '', $width = 0, $height = 0, $makeOtherSizesImages = true)
    {
        if ($width > 0 && $height > 0) {
            self::$mainImgWidth = $width;
            self::$mainImgHeight = $height;
        }

        $destinationPath = ImageUploadHelper::real_public_path() . $destinationPath;

        $midImagePath = $destinationPath . self::$thumbFolder1;

        $extension = $field->getClientOriginalExtension();
        $fileName = Str::slug($newName, '-') . '-' . time() . '-' . rand(1, 999) . '.' . $extension;

        $field->move($destinationPath, $fileName);

        /*         * **** Resizing Images ******** */
        $imageToResize = Image::make($destinationPath . '/' . $fileName);

        $imageToResize->resize(self::$mainImgWidth, self::$mainImgHeight, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($destinationPath . '/' . $fileName);

        if ($makeOtherSizesImages === true) {

            $imageToResize->resize(self::$thumbImgWidth1, self::$thumbImgHeight1, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($midImagePath . '/' . $fileName);
            
            
            /* * **** End Resizing Images ******** */
        }

        return $fileName;
    }

    public static function real_public_path()
    {
        return public_path() . DIRECTORY_SEPARATOR;
    }

    public static function deleteImage($image, $folder)
    {
        try {
            if (!empty($image)) {
                File::delete(ImageUploadHelper::real_public_path() . $folder.'/' . $image);
                File::delete(ImageUploadHelper::real_public_path() . $folder.'/thumbnails/250/' . $image);
            }
            
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}
