<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'comment_author',
        'author_avatar',

    ];

    protected $hidden = [
        'user_id'
    ];

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }

    public function storeComment(User $user, array $data, $id)
    {
        $comment = new Comment;

        $comment->comment_author = $user->name;
        $comment->author_avatar  = $user->avatar;
        $comment->notice_id = $id;

        $comment->fill($data);

        $comment->save();
    }
}
