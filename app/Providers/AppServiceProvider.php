<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // this sets the default string length to avoid database error when creating string columns
        Schema::defaultStringLength(191);

        Route::resourceVerbs([
            'create' => 'criar',
            'edit' => 'editar',
            'index' => 'listar'
        ]);
    }
}
