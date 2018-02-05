<?php

namespace App\YouApp\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\YouApp\Events;
use App\YouApp\Listeners;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

    ];

    public function boot()
    {
        parent::boot();
    }
}