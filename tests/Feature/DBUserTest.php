<?php

namespace Tests\Feature;

use ApiVue\Models\User;
use App;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DBUserTest extends TestCase
{

    public function test_add_user()
    {

        $attr = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'role' => 1
        ];

        $user = factory(User::create($attr));
        self::assertDatabaseHas('users', $attr);
    }

    public function test_update_user()
    {

        $user = User::latest()->first();
        $user->role = 2;
        $user->save();

        self::assertDatabaseHas('users', $user->getAttributes());
    }

    public function test_remove_user()
    {

        $user = User::latest()->first();
        $user->delete();
        self::assertSoftDeleted('users', $user->getAttributes() );
    }

    public function test_show_user()
    {

        $user = User::latest()->first();
        self::assertDatabaseHas('users', $user->getAttributes());
    }

}
