<?php

namespace AvoRed\Framework\Support\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var \AvoRed\Framework\Database\Models\AdminUser $user */
        $user = Auth::guard('admin')->user();
        $routeName = Route::currentRouteName();
        if ($user->hasPermission($routeName)) {
            return $next($request);
        }

        abort(403);
    }
}
