<?php

namespace App\YouApp\Models\Traits;

use App\YouApp\Observers\ModelBaseObserver;

trait RegisterBaseObserver
{
    public static function boot()
    {
        parent::boot();
        static::observe(ModelBaseObserver::class);
    }
}