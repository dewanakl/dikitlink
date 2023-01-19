<?php

namespace App\Middleware;

use Closure;
use Core\Http\Request;
use Core\Middleware\MiddlewareInterface;

final class EmailMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->email_verify) {
            return $next($request);
        }

        respond()->redirect(route('profile'));
    }
}
