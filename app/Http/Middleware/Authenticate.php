<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {

        if (! Auth::user())
        {
            return route('login');
        }
        else {
            if (!$request->expectsJson()) {
                return route('dashboard');
            }
        }
    }

//    public function handle($request, Closure $next, ...$guards)
//    {
//        if (! $this->auth->user())
//        {
//            return redirect()->route('login');
//        }
//        else
//            {
//                return redirect()->route('dashboard');
//            }
//        return $next($request);
//
//    }
}
