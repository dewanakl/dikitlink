<?php

namespace Middleware;

use Closure;
use Core\Request;

final class AdminMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role_id == 1) {
            return $next($request);
        }

        return abort();
    }
}
