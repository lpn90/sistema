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

        $this->app->bind(
            \Sistema\Repositories\ProjectRepository::class,
            \Sistema\Repositories\ProjectRepositoryEloquent::class
        );

        $this->app->bind(
            \Sistema\Repositories\ProjectNoteRepository::class,
            \Sistema\Repositories\ProjectNoteRepositoryEloquent::class
        );

        $this->app->bind(
            \Sistema\Repositories\ProjectNoteRepository::class,
            \Sistema\Repositories\ProjectNoteRepositoryEloquent::class
        );
        $this->app->bind(
            \Sistema\Repositories\ProjectTaskRepository::class,
            \Sistema\Repositories\ProjectTaskRepositoryEloquent::class
        );

        $this->app->bind(
            \Sistema\Repositories\UserRepository::class,
            \Sistema\Repositories\UserRepositoryEloquent::class
        );

        $this->app->bind(
            \Sistema\Repositories\ProjectFileRepository::class,
            \Sistema\Repositories\ProjectFileRepositoryEloquent::class
        );
    }
}
