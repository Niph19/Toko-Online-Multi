<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Toko;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalTokoMenunggu = Toko::where('status', 'menunggu')->count();
        $totalTokoAktif = Toko::where('status', 'aktif')->count();
        $totalPesanan = Pesanan::count();
        $totalTransaksi = Pesanan::sum('total_harga');

        return view('admin.dashboard', compact(
            'totalTokoMenunggu',
            'totalTokoAktif',
            'totalPesanan',
            'totalTransaksi',
        ));
    }
}