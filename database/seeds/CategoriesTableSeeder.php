<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\ApiVue\Models\Category::class, 10)->create()
            ->each(function($cat){
                $cat->products()->saveMany(factory(\ApiVue\Models\Product::class, 10)->make()); // Pra cada categoria, adiciona 10 produtos
            });
    }

}
