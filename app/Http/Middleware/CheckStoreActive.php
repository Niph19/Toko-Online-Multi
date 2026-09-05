<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckStoreActive
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || !$user->toko) {
            abort(403, 'Anda belum mendaftarkan toko.');
        }

        $status = $user->toko->status;

        if ($status === 'menunggu') {
            abort(403, 'Toko Anda masih dalam proses peninjauan oleh Admin. Harap tunggu persetujuan.');
        }

        if ($status === 'nonaktif') {
            abort(403, 'Toko Anda telah dinonaktifkan oleh Admin. Silakan hubungi dukungan.');
        }
        return $next($request);
    }
}
