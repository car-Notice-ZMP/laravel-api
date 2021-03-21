<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;


class UploadService
{
    public function setImage ($uploadFolder, $upload)
    {

        $image_uploaded_path = $upload->store($uploadFolder, 'public');

        $image_url  = Storage::disk('public')->url($image_uploaded_path);

        return $image_url;

    }

}














?>
