<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAlumni
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth = session('auth');

        // Belum login
        if (!$auth || empty($auth['token']) || empty($auth['user'])) {
            return redirect()
                ->route('auth.index')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Bukan alumni
        if (($auth['user']['role'] ?? null) !== 'alumni') {
            abort(403, 'Hanya alumni yang dapat mengakses fitur ini.');
        }

        return $next($request);
    }
}
