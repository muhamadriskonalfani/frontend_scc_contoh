<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FrontendAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Mengecek apakah frontend memiliki token API di session
        if (!session()->has('auth.token') || !session()->has('auth.user')) {
            return redirect()->route('index')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
