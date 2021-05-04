<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Notice;

class NoticeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function store_notice_test()
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

        $this->assertCount(1, Notice::all());
    }

    //** @test */
    public function delete_notice_test()
    {
        $user = User::factory()->make();

        $user->setDefaultAvatar($user);

        $notice = Notice::factory()->create([
            'user_id'             => $user->id,
            'notice_author'       => $user->name,
            'notice_author_email' => $user->email,
            'author_avatar'       => $user->avatar,
        ]);

        $notice->delete();

        $this->assertCount(0, Notice::all());
    }
}
