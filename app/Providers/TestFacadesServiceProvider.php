<?php

namespace app\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class TestFacadesServiceProvider extends ServiceProvider
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
        App::bind('test', function (){
            return new \app\Test\TestFacades();
        });
    }
}
