<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
// middleware AuthAdmin para proteger o ACP
use App\Http\Middleware\AuthAdmin;
use App\Http\Middleware\AuthProp;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // cria novo alias para o middleware AuthAdmin
        $middleware->alias([
            'auth_admin' => AuthAdmin::class,
            'auth_prop' => AuthProp::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
