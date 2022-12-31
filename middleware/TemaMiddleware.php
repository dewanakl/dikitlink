<?php

namespace Middleware;

use Closure;
use Core\Http\Request;
use Core\Middleware\MiddlewareInterface;

final class TemaMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next)
    {
        if (isset($request->dark)) {
            session()->set('dark', true);
            respond()->redirect($request->server('PATH_INFO'));
        } else if (isset($request->light)) {
            session()->set('dark', false);
            respond()->redirect($request->server('PATH_INFO'));
        }

        return $next($request);
    }
}
