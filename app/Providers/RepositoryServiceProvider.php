<?php

namespace Sistema\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(\Sistema\Repositories\ProjectNoteRepository::class, \Sistema\Repositories\ProjectNoteRepositoryEloquent::class);
        //:end-bindings:
    }
}
