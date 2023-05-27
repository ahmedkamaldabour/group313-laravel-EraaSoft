<?php

namespace App\Http\traits;

use function file_exists;
use function public_path;
use function time;
use function unlink;

trait FileTrait
{
    private function uploadImage($path, $image, $old_image = null)
    {
        if ($old_image != null) {
            $this->removeImage($path, $old_image);
        }
        $image_name = time() . '-' . $image->getClientOriginalName();
        $image->move(public_path($path), $image_name);
        return $image_name;
    }

    private function removeImage($path, $old_image)
    {
        $image_path = public_path($path . $old_image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

}
