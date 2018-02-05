<?php

namespace Ponich\AppLark;

use Ponich\AppLark\Commands;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->commands([
            Commands\MakeApp::class
        ]);
    }

    public function register()
    {

    }

}