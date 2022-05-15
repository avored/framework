<?php

namespace AvoRed\Framework\Support\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AdminAuth extends Middleware
{
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('admin.login');
        }
    }
}
