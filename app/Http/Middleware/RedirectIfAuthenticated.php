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
      
       if (Auth::check() && Auth::user()->role == 1) {
            return redirect('/categorys');
        }
        if (Auth::check() && Auth::user()->user_role_id == 2){
            return redirect('/online_course');
        }
        return $next($request);
    }
}
