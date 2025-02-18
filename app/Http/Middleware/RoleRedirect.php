<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('filament.admin.panel');
            } elseif (auth()->user()->hasRole('customer')) {
                return redirect()->route('customer.dashboard');
            }
        }
        return $next($request);
    }
}
