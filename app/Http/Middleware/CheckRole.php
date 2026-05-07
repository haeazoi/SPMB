<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Ambil role dari session
        $sessionRole = session('role');

        // 3. Cek apakah role di session ada dalam daftar role yang diizinkan
        if (in_array($sessionRole, $roles)) {
            return $next($request);
        }

        // Jika tidak punya akses, arahkan kembali atau ke halaman 403
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
