<?php

namespace ApiVue\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\ApiVue\Repositories\UserRepository::class, \ApiVue\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\ApiVue\Repositories\CategoryRepository::class, \ApiVue\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\ApiVue\Repositories\ProductRepository::class, \ApiVue\Repositories\ProductRepositoryEloquent::class);
        $this->app->bind(\ApiVue\Repositories\ClientRepository::class, \ApiVue\Repositories\ClientRepositoryEloquent::class);
        $this->app->bind(\ApiVue\Repositories\OrderRepository::class, \ApiVue\Repositories\OrderRepositoryEloquent::class);
        //:end-bindings:
    }
}
