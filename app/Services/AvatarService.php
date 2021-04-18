<?php

namespace App\Services;

use Laravolt\Avatar\Avatar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AvatarService
{
    public function generate ($user)
    {

        $image_name = Str::random(20);

        $avatar = new Avatar;
        $avatar->create($user->email)
               ->setShape('circle')
               ->setDimension(500)
               ->setFontSize(200)
               ->setBackground('#1E90FF')
               ->setForeground('#ffffff')
               ->save('storage/users_avatars/'.$image_name.'.png', $quality = 100);
        $image_url = Storage::disk('public')->url('users_avatars/'.$image_name.'.png');

        return $image_url;
    }
}














