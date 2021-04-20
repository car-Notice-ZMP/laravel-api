<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\UploadService;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Spatie\ModelStatus\HasStatuses;
use Illuminate\Support\Facades\Storage;


class Notice extends Model
{
    use HasFactory, Favoriteable, HasStatuses;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'notice_author',
        'image',
    ];

    protected $hidden = [
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function showNotice($id)
    {

        $notice = Notice::with('statuses', 'comments')
            ->where('id', $id)
            ->get();

        return $notice;
    }

    public function storeNotice(User $user, array $data, $upload)
    {
        $notice = new Notice;
        $image  = new UploadService;

        $image->setImage($upload);

        $notice->user_id       = $user->id;
        $notice->notice_author = $user->name;
        $notice->image_url     = $image->getImageUrl();
        $notice->image_name    = $image->getFileName();


        $notice->fill($data);

        $notice->save();

        $notice->setStatus('aktywne');

    }

    public function destroyNotice($id, User $user)
    {
        $notice = Notice::findOrFail($id);

        checkAuthor($notice->user_id, $user->id);

        $notice->delete();
    }

    public function updateNotice($id, array $data, User $user, $upload)
    {
        $notice = Notice::findOrFail($id);
        $image  = new UploadService;

        if($upload)
        {

            $image->setImage($upload);

            checkAuthor($notice->user_id, $user->id);

            Storage::disk('notices')->delete($notice->image_name);

            $notice->image_url     = $image->getImageUrl();
            $notice->image_name    = $image->getFileName();

            $notice->update($data);

        }else {

            $notice->update($data);

        }

    }

    public function freshNoticeStatus ($id, User $user)
    {
        $notice = Notice::findOrFail($id);

        checkAuthor($notice->user_id, $user->id);

        $notice->deleteStatus('nieaktywne');

        $notice->setStatus('aktywne');

    }
}
