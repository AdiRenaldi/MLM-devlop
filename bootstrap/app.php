<?php

use App\Http\Middleware\LoginAdmin;
use App\Http\Middleware\RoleAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'Login' => LoginAdmin::class,
            'Admin' => RoleAdmin::class,
        ]);

        // Middleware hanya untuk API agar tidak mengganggu web
        $middleware->group('api', [
            EnsureFrontendRequestsAreStateful::class, // Middleware Sanctum
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

