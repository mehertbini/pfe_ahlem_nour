<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isAdmin' => App\Http\Middleware\adminMiddleware::class,
            'isFarmer' => App\Http\Middleware\userMiddleware::class,
            'isTransporter' => App\Http\Middleware\transporteurMiddleware::class,
            'isDistributor' => App\Http\Middleware\distibuteurMiddleware::class,
            'isIndividual' => App\Http\Middleware\individuelMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
