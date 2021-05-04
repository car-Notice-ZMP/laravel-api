<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\UploadService;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Spatie\ModelStatus\HasStatuses;
use Illuminate\Support\Facades\Storage;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\Search;

class Notice extends Model implements Searchable
{
    use HasFactory, Favoriteable, HasStatuses;

    protected $fillable = [
        'title',
        'message',
        'notice_author_email',
        'user_id',
        'notice_author',
        'author_avatar',
        'mark',
        'model',
        'color',
        'year',
        'mileage',
        'price',
        'body',
        'image',
    ];

    protected $hidden = [
        'user_id',
        'image',
        'image_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function getSearchResult(): SearchResult
    {
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->title,
        );
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

        $notice->user_id             = $user->id;
        $notice->notice_author       = $user->name;
        $notice->notice_author_email = $user->email;
        $notice->author_avatar       = $user->avatar;
        $notice->image_url           = $image->getImageUrl();
        $notice->image_name          = $image->getFileName();

        $notice->fill($data);

        $notice->save();

        $notice->setStatus('aktywne');

    }

    public function destroyNotice($id)
    {
        $notice = Notice::findOrFail($id);

        $notice->delete();
    }

    public function updateNotice($id, array $data, $upload)
    {
        $notice = Notice::findOrFail($id);
        $image  = new UploadService;

        if($upload)
        {
            $image->setImage($upload);

            Storage::disk('notices')->delete($notice->image_name);

            $notice->image_url     = $image->getImageUrl();
            $notice->image_name    = $image->getFileName();

            $notice->update($data);

        }else {
            $notice->update($data);
        }
    }

    public function freshNoticeStatus ($id)
    {
        $notice = Notice::findOrFail($id);

        $notice->deleteStatus('nieaktywne');

        $notice->setStatus('aktywne');
    }

    public function performSearch ($request)
    {
        $searchResults = (new Search())
            ->registerModel(Notice::class, [
                'title',
                'message',
                'mark',
                'model',
                'color',
                'body',
                'mileage',
                'price',
                'year'
            ])
            ->perform($request->get('search'));

        return $searchResults;
    }

    public function performSearchInRange ($request)
    {
        $result = Notice::select('*')
            ->WhereBetween($request->field, [$request->min, $request->max])
            ->get();

        return $result;
    }
}
