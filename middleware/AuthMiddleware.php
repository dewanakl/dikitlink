<?php

namespace Middleware;

use Closure;
use Core\Http\Request;
use Core\Middleware\MiddlewareInterface;

final class AuthMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            respond()->with('gagal', 'Silahkan login dahulu !');
            respond()->redirect(route('login'));
        }

        return $next($request);
    }
}
