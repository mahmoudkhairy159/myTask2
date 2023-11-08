<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait UploadImageTrait
{
    public function uploadImage($image, $folder, $fileName, int $width = 300, int $height = 200)
    {
        $imageExtension = $image->extension();
        $path = $folder . '/' . $fileName . '.' . $imageExtension;
        $image = Image::make($image)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($fileName, 90, $imageExtension);
        Storage::disk('public')->put($path, $image);
        return $path;

    }

    public function getPhotoAttribute($path)
    {
        return ($path != null) ? asset('storage/' . $path) : '';

    }
    public function deletePhoto($path)
    {
        Storage::disk('public')->delete($path);

    }

}
