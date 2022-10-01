<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            switch ($guard)
            {
                case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('admin.dashboard');
                }
                break;
                case 'reporter':
                    if (Auth::guard($guard)->check()) {
                        return redirect()->route('reporter.dashboard');
                    }
                    break;
                case 'staff':
                    if (Auth::guard($guard)->check()) {
                        return redirect()->route('staff.dashboard');
                    }
                    break;
                default:
                    if (Auth::guard($guard)->check()) {
                        return redirect()->intended(route('user.dashboard'));
                    }
                break;
            }
        }
 
        return $next($request);
    }
}
