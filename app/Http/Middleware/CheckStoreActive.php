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
            return redirect()->route('seller.dashboard')->with('warning', 'Anda belum mendaftarkan toko.');
        }

        $status = $user->toko->status;

        if ($status === 'menunggu') {
            return redirect()->route('seller.dashboard')->with('warning', 'Toko Anda masih menunggu konfirmasi.');
        }

        if ($status === 'nonaktif') {
            return redirect()->route('seller.dashboard')->with('warning', 'Toko Anda sedang nonaktif. Silakan hubungi dukungan.');
        }
        return $next($request);
    }
}
