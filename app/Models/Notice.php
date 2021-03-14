<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;


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

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function storeNotice (User $user, array $data)
    {
        $notice = new Notice;

        $notice->user_id = $user->id;
        $notice->notice_author = $user->name;

        $notice->fill($data);

        $notice->save();

    }

    public function destroyNotice ($id)
    {
        $notice = Notice::find($id);
        $notice->delete();
    }

    public function updateNotice ($id, array $data)
    {
        Notice::find($id)->update($data);

    }
}

