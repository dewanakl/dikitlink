<?php

namespace App\Middleware;

use Closure;
use Core\Http\Request;
use Core\Middleware\MiddlewareInterface;

final class TemaMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next)
    {
        if (!is_null($request->get('dark'))) {
            session()->set('dark', true);
            respond()->redirect(route('profile'));
        } else if (!is_null($request->get('light'))) {
            session()->set('dark', false);
            respond()->redirect(route('profile'));
        }

        return $next($request);
    }
}
