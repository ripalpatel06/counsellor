<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultstringLength(191);
        //  view()->composer('*', function ($view) {
        //     $action = app('request')->route()->getAction();
        //     $controller = class_basename($action['controller']);

        //     list($controller, $action) = explode('@', $controller);

        //     $controller = strtolower(substr($controller, 0, -10));

        //     $view->with(compact('controller', 'action'));
        // });
    }
}
