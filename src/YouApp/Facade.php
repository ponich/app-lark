<?php

namespace App\YouApp;

/**
 * @method static string getName()
 * @method static string getNamespace(string | null $path)
 * @method static string getLowName()
 * @method static string appPath(string|null $path)
 */
class Facade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return YouApp::class;
    }
}