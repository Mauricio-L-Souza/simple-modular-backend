<?php

namespace Core\Auth\Tests;

use Tests\TestCase;
use Core\Auth\Cases\CreateUser;
use Core\Auth\Payloads\UserPayload;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_user()
    {
        /** @var CreateUser */
        $case = app(CreateUser::class);

        $payload = new UserPayload(
            name: 'Fake Customer',
            email: 'fakemail@mail.com',
            rawAccesses: ['favorites.store', 'favorites.delete']
        );
        $case->execute($payload);

        $this->assertDatabaseHas('users', [
            'id' => 1,
            'name' => 'Fake Customer',
            'email' => 'fakemail@mail.com'
        ]);

        $this->assertDatabaseHas('user_accesses', [
            'user_id' => 1,
            'name' => 'favorites.store'
        ]);

        $this->assertDatabaseHas('user_accesses', [
            'user_id' => 1,
            'name' => 'favorites.delete'
        ]);
    }
}
