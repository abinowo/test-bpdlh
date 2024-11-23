<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (Str::startsWith($request->path(), ['api/v1'])) {
            if (! auth()->check()) {
                return route('auth.unauthorized');
            }
        }

        return $request->expectsJson() ? null : route('login');
    }
}
