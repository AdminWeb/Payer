<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 31/05/18
 * Time: 12:31
 */

namespace AdminWeb\Payer;


use AdminWeb\Payer\States\PendentState;
use Illuminate\Support\ServiceProvider;

class PayerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/payer.php' => config_path('payer.php'),
        ]);

        // $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');

        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        $this->loadViewsFrom(__DIR__ . '/../views', 'payer');

    }

    public function register()
    {
        $this->app->bind('InitialState',function(){
            return new PendentState();
        });
    }
}