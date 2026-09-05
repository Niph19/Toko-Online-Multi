<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $toko = Auth::user()->toko;

        if (!$toko) {
            abort(403, 'Toko tidak ditemukan.');
        }

        $totalProduk = Produk::where('toko_id', $toko->id)->count();
        $totalPesanan = Pesanan::where('toko_id', $toko->id)->count();
        $pesananMenunggu = Pesanan::where('toko_id', $toko->id)->where('status', 'menunggu konfirmasi')->count();
        $totalPendapatan = Pesanan::where('toko_id', $toko->id)->where('status', 'selesai')->sum('total_harga');

        return view('seller.dashboard', compact('toko', 'totalProduk', 'totalPesanan', 'pesananMenunggu', 'totalPendapatan'));
    }
}