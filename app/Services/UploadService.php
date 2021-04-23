<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UploadService
{
    private $file_name;
    private $image_url;

    public function setImage ($upload)
    {
        $file_name           = $upload->hashName();
        $image_uploaded_path = $upload->storeAs('notices', $file_name, 'public');
        $image_url           = Storage::disk('public')->url($image_uploaded_path);

        $this->image_url = $image_url;
        $this->file_name = $file_name;
    }

    public function getImageUrl()
    {
        return $this->image_url;
    }

    public function getFileName()
    {
        return $this->file_name;
    }
}














?>
