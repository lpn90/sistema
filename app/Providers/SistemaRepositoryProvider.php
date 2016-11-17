<?php

namespace Sistema\Providers;

use Illuminate\Support\ServiceProvider;

class SistemaRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
          \Sistema\Repositories\ClientRepository::class,
            \Sistema\Repositories\ClientRepositoryEloquent::class
        );
    }
}
