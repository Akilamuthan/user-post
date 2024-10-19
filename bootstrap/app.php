<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Admin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

 
          // App\Http\Middleware\Admin::class, 
  
        $middleware->group('web', [
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\AutoLogin::class,
            \App\Http\Middleware\User::class, 
           
        ]);

       
        $middleware->group('api', [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\CustomVerifyCsrfToken::class,
        ]);
        
        $middleware->alias([
            'admin' => App\Http\Middleware\Admin::class, 
        ]);
        
    })
    
    ->withExceptions(function (Exceptions $exceptions) {
       
    })
    ->create();
   