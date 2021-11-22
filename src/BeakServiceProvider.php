<?php

namespace Jorgenwdm\Beak;

use Illuminate\Support\ServiceProvider;

class BeakServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {               
        $publishTag = 'laravel-beak';       
        if (app() instanceof \Illuminate\Foundation\Application) {
            $this->publishes([
                __DIR__.'/config/laravel-beak.php' => config_path('laravel-beak.php'),
            ], $publishTag);
        }

    }
}