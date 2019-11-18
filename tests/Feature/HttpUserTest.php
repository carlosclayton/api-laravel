<?php

namespace Tests\Feature;

use ApiVue\Models\User;
use Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use JWTAuth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HttpUserTest extends TestCase
{

    protected $headers;

    protected function createAuthenticatedUser()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);
        $headers['Authorization'] = "Bearer $token";
        $this->headers = $headers;
    }

    public function test_get_user_all_by_http()
    {
        $this->createAuthenticatedUser();
        $response = $this->get('http://localhost:8000/api/users', $this->headers);
        $response
            ->assertStatus(200);

    }

    public function test_add_user_by_http()
    {
        $attr = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'role' => rand(1, 2)
        ];

        $this->createAuthenticatedUser();
        $response = $this->json('POST', 'http://localhost:8000/api/users', $attr, $this->headers);

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'User created.',
            ]);

    }
}
