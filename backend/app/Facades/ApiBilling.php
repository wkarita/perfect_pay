<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ApiBilling extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'apiBilling';
    }
}
