<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            \Log::info('DEBUG: RedirectIfAuthenticated - guard: ' . $guard . ', checked: ' . (Auth::guard($guard)->check() ? 'YES' : 'NO'));
            if (Auth::guard($guard)->check()) {
                \Log::info('DEBUG: User is authenticated, redirecting to /dashboard');
                return redirect('/dashboard');
            }
        }

        \Log::info('DEBUG: RedirectIfAuthenticated - allowing request to pass through');
        return $next($request);
    }
}