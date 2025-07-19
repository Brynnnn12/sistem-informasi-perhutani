<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Hanya admin dan petugas yang boleh akses
        if (!$user->hasAnyRole(['admin', 'petugas'])) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk mengakses panel admin.');
        }

        return $next($request);
    }
}
