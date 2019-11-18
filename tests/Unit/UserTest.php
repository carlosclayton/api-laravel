<?php

namespace Tests\Unit;

use ApiVue\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
            $attr = [
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'password' => $this->faker->password,
                'role' => 1
            ];

            $user = new User($attr);
            self::assertEquals($attr, $user->getAttributes());








    }
}
