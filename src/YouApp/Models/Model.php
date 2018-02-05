<?php

namespace App\YouApp\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

/**
 * Базовая модель. Все модели данного app наследует текущую модель
 */
class Model extends EloquentModel
{
    use Traits\RegisterBaseObserver;
}