 <?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\CheckKampusSelected;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Onlydosen;
use App\Http\Middleware\Onlyadmin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
       $middleware->alias([

        'Onlydosen' => \App\Http\Middleware\Onlydosen::class,
        'Onlyadmin' => \App\Http\Middleware\Onlyadmin::class,

       ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
