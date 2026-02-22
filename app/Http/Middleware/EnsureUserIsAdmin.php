<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->role === 0 && Auth::user()->employees->status === 0 || Auth::user()->role === 1 && Auth::user()->employees->status === 0)) {
            return $next($request);
        }
        //handle error
        abort(403, 'Bạn không có quyền vào khu vực này.');
    }
}
