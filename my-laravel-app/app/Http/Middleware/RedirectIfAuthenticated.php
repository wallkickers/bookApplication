<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/books');
        }

        return $next($request);
    }

    private function getRedirectPath($guard)
    {
        $path = '/';
        if($guard) {
            if ($guard == 'admin') {
                $path = '/admin';
            }
        }
        return $path;
    }
}
