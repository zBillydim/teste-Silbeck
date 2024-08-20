<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function r(Request $request, Closure $next, string $role)
    {
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }
        return response()->json(['success' => false, 'message' => 'You do not have permission to access this resource.'], 403);
    }
}
