<?php

namespace App\Facades\Sms;

use Illuminate\Support\Facades\Facade;

class SmsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sendsms';
    }
}
