<?php

use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Middleware\ValideToken;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register global middleware
        // $middleware->append(ValideToken::class);

        // OR register route middleware
        $middleware->alias([
            'valid.token' => ValideToken::class,
            'role' => EnsureUserHasRole::class, // Définir un alias 'role'
        ]);

        //* bundles multiple middleware into one name (protected).
        $middleware->group('protected', [
            'auth',         // Requires user authentication
            'valid.token',  // Requires a valid token in the request
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
