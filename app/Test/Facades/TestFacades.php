<?php

namespace App\Test\Facades;
use Illuminate\Support\Facades\Facade;
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 4/27/2017
 * Time: 3:37 PM
 */
class TestFacades extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'test';
    }
}