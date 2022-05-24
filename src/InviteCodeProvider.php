<?php

namespace Yangzx\InviteCode;

use Illuminate\Support\ServiceProvider;

class InviteCodeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton("InviteCode",function ($app){
            return new InviteCode($app['config']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //自动发布配置文件，其中invitecode参数为tag
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('invitecode.php'),
        ],'invitecode');
    }
}
