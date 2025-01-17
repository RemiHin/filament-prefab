<?php

use App\Actions\Log404;
use App\Http\Middleware\RestrictAccessMiddleware;
use Exception as ThrownException;
use Illuminate\Foundation\Application;
use App\Http\Middleware\RedirectsMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append([
            RedirectsMiddleware::class,
        ]);

        $middleware->appendToGroup('web', [
            RestrictAccessMiddleware::class,
        ]);

        $middleware->priority([
            RestrictAccessMiddleware::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(fn (ThrownException $exception) => (new Log404())->handle($exception));
    })->create();
