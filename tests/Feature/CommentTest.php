<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Notice;
use App\Models\Comment;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function store_comment_test()
    {
        $user = User::factory()->make();

        $user->setDefaultAvatar($user);

        $notice = Notice::factory()->create([
            'user_id'             => $user->id,
            'notice_author'       => $user->name,
            'notice_author_email' => $user->email,
            'author_avatar'       => $user->avatar,
        ]);

        $notice->setStatus('aktywne');

        $comment = Comment::factory()->create([
            'comment_author' => $user->name,
            'author_avatar'  => $user->avatar,
            'notice_id'      => $notice->id,
        ]);

        $this->assertCount(1, Comment::all());
    }
}
