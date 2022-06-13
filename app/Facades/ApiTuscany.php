<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ApiTuscany extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'api-tuscany';
    }
}