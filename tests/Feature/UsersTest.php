<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_sign_up_test()
    {
        $user = User::factory()->make();

        $this->post('api/auth/register');

        $user->setDefaultAvatar($user);

        $this->assertCount(1, User::all());
    }
}
