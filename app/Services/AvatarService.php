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
               ->setDimension(150)
               ->setFontSize(82)
               ->setBackground('#821f10')
               ->setForeground('#ffffff')
               ->save('storage/users_avatars/'.$image_name.'.png');
        $image_url = Storage::disk('public')->url('users_avatars/'.$image_name.'.png');

        return $image_url;
    }
}














