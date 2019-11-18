<?php

use ApiVue\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(\ApiVue\Models\User::class, 5)
            ->states('admin')
            ->create()
            ->each(function($user){
                $user->client()->save(factory(\ApiVue\Models\Client::class)
                    ->create(['user_id' => $user->id])); // Pra cada usuário, um novo cliente
            });

        factory(\ApiVue\Models\User::class, 50)
            ->states('client')
            ->create()
            ->each(function($user){
                $user->client()->save(factory(\ApiVue\Models\Client::class)
                    ->create(['user_id' => $user->id])); // Pra cada usuário, um novo cliente
            });

    }

}
