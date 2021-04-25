<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Comment $comment, $id)
    {
        $user   = auth()->user();

        $comment->storeComment($user, $request->all(), $id);

        return response()->json(['message' => 'Udało się dodać komentarz']);
    }
}
