<?php
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
return Application::configure(basePath: dirname(__DIR__))
 ->withRouting(api: __DIR__.'/../routes/api.php', health: '/up', commands: __DIR__.'/../routes/console.php')
 ->withMiddleware(fn(Middleware $m) => null)
 ->withExceptions(function (Exceptions $e) { $e->shouldRenderJsonWhen(fn() => true); })
 ->create();
