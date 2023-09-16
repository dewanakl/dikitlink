<?php

namespace App\Middleware;

use App\Models\Link;
use Closure;
use Core\Http\Request;
use Core\Middleware\MiddlewareInterface;
use Core\Valid\Validator;

final class NoPermissionMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next)
    {
        $valid = Validator::make($request->only(['name', 'old']), [
            'name' => ['required', 'str', 'trim', 'slug', 'min:3', 'max:25'],
            'old' => ['str', 'trim', 'slug', 'max:25']
        ]);

        if ($valid->fails()) {
            return json([
                'error' => $valid->failed()
            ], 400);
        }

        $result = Link::where('name', $valid->name)
            ->where('user_id', auth()->user()->id)
            ->first();

        if (!empty($result->unsafe)) {
            return json([
                'error' => [
                    'name' => 'No Permission'
                ]
            ], 400);
        }

        if (!empty($valid->old)) {
            $result = Link::where('name', $valid->old)
                ->where('user_id', auth()->user()->id)
                ->first();

            if (!empty($result->unsafe)) {
                return json([
                    'error' => [
                        'name' => 'No Permission'
                    ]
                ], 400);
            }
        }

        return $next($request);
    }
}
