<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            abort(403);
        }

        if (!in_array(auth()->user()->id_roles, $roles)) {
            abort(403);
        }

        return $next($request);
    }
}
