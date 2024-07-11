<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use App\Models\User;


class UsersTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_user_may_update_only_their_profile(): void
    {
        $user = $this->signIn();
        $userTwo = $this->signIn();

        $this->actingAs($userTwo)->patch("/users/{$user->id}", ['name' => 'Name'])->assertForbidden();
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'name' => 'Name'
        ]);

        $this->actingAs($user)->patch("/users/{$user->id}", ['name' => 'Name']);
        $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Name'
    ]);
    }
}
