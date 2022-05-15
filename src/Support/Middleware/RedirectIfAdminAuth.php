<?php

namespace AvoRed\Framework\Support\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdminAuth
{
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (Auth::guard($guard)->check()) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
