<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use \ApiVue\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text
    ];
});
