<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'customer':
                if (Auth::guard($guard)->check()) {
                    return redirect('/customer/dashboard');
                }
                break;
            case 'restaurant':
                if (Auth::guard($guard)->check()) {
                    return redirect('/restaurant/dashboard');
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/home');
                }
                break;
        }

        return $next($request);
    }
}
