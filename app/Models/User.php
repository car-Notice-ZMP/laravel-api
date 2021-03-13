<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Storage;
use Laravolt\Avatar\Avatar;
use Illuminate\Support\Str;
use JWTAuth;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function googleCallback($user)
    {

        $name           = $user->getName();
        $avatar         = $user->getAvatar();
        $email          = $user->getEmail();


        $this->user = User::where([
            'name'           => $name,
            'email'          => $email,
            'avatar'         => $avatar,
        ])->first();


        $user = User::firstOrCreate([
            'name'           => $name,
            'email'          => $email,
            'avatar'         => $avatar,
        ]);

        $token = JWTAuth::fromUser($user);

        return [
            'access_token'   => $token,
            'name'           => $name,
            'email'          => $email,
            'avatar'         => $avatar,
        ];
    }

    public function setDefaultAvatar ($user, $request)
    {
        $image_name = Str::random(20);

        $avatar = new Avatar;
        $avatar->create($user->email)
               ->setShape('square')
               ->setDimension(150)
               ->setFontSize(82)
               ->setBackground('#0080ff')
               ->setForeground('#ffffff')
               ->save('storage/users_avatars/'.$image_name.'.png');
        $image_url = Storage::disk('public')->url('users_avatars/'.$image_name.'.png');

        $user->avatar = $image_url;

        $user->save();
    }






}
