<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
//        dd(auth()->user()->role->name, $role);
        if (!auth()->check() || auth()->user()->role->name !== $role) {
            // Redirect to a 403 Forbidden page or any other action
            return redirect('/');
        }
        return $next($request);
    }
}
