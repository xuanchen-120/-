<?php

namespace App\Facades\Sms;

use Config;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * 在容器中注册绑定。
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('sendsms', function () {
            $config = Config::get('easysms');
            return new SmsFactory($config);
        });
    }
}
