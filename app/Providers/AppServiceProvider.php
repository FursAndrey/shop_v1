<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        //для пагинаций
        Paginator::useBootstrap();
        //для подсветки выбранного путнкта меню
        Blade::directive('routeactive', function ($route) {
            return "<?php 
                if (Route::currentRouteNamed($route)) {
                    echo \"class='menu-active'\";
                }
            ?>";
        });
    }
}
