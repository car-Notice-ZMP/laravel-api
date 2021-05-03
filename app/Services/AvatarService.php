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

        $avatar = new Avatar(config('laravolt.avatar'));
        $avatar->create($user->name)
               ->save(public_path('storage/users_avatars/'.$image_name.'.png', $quality = 100));

        $image_url = Storage::disk('public')->url('users_avatars/'.$image_name.'.png');

        return $image_url;
    }
}














