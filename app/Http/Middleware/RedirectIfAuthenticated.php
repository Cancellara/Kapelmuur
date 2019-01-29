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
       /* if (Auth::guard('admin')->check() )
        {
            return redirect()->route('admin.panel');
        }
        else*/if (Auth::guard('shop')->check())
        {
            //dd('hola');
            return redirect('/');
        }
        elseif (auth()->check())
        {
            return redirect('/');
        }
        return $next($request);


    }
}
