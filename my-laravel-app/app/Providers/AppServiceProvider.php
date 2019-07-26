<?php

namespace App\Providers;

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
        // if ($this->app->environment('local', 'testing', 'staging')) {
        //   $this->app->register(DuskServiceProvider::class);
        // }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 本番環境(Heroku)でhttpsを強制する
        if (\App::environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
