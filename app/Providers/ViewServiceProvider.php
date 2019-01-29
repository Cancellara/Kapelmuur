<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('shop', function() {
            //dd(auth('web'));
            return (auth('shop')->check());

        });

        Blade::if('user', function (){
            return (auth('web')->check());
        });

        Blade::if('visitor', function () {
           return  (!(auth('web')->check())) && (!(auth('shop')->check()));
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
