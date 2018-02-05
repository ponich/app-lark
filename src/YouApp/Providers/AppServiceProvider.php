<?php

namespace App\YouApp\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use App\YouApp\Console\Commands;
use App\YouApp\Http\Middleware;
use App\YouApp\Facade as YouApp;
use Illuminate\Contracts\Console\Kernel;
use App\YouApp\Console\Kernel as AppKernel;

class AppServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $this->registerMiddleware($router);
        $this->registerRoutes($router);
        $this->registerServiceProviders();
    }

    /**
     *
     */
    public function register()
    {
        // Console Kernel
        $this->app->singleton(Kernel::class, AppKernel::class);
        $this->app->get(Kernel::class)->bootstrap();

        // Events
        $this->app->register(
            EventServiceProvider::class
        );

    }

    /**
     * Регистрация провайдеров
     */
    public function registerServiceProviders()
    {

    }

    /**
     * Регистрация routes
     */
    public function registerRoutes(Router $router)
    {
        $router->group(['namespace' => YouApp::getNamespace('Http\Controllers')], function ($router) {
            require __DIR__ . '/../Http/routes.php';
        });
    }

    /**
     * Регистрация Http Middlewares
     * @param \Illuminate\Routing\Router $router
     */
    public function registerMiddleware(Router $router)
    {
        $router->aliasMiddleware(YouApp::getLowName() . '.verify.token', Middleware\VerifyToken::class);
    }
}