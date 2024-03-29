<?php

declare(strict_types=1);

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
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
#dump($request, $next, $guard);
#dd(Auth::guard($guard));
#dd(Auth::guard($guard)->check());
        if (Auth::guard($guard)->check()) {
            return redirect(route('guest.personal.activity'));
        }

        return $next($request);
    }
}
