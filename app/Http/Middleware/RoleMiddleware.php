<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission = null)
    {
//        if (!$request->user()->hasRole($role)) {
//            abort(Response::HTTP_NOT_FOUND);
//        }
        if ($permission !== null && !$request->user()->can($permission)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return $next($request);
    }
}
