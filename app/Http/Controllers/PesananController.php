<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::where('user_id', Auth::id())
            ->with(['toko', 'detailPesanan.produk'])
            ->latest()
            ->get();

        return view('pesanan.index', compact('pesanans'));
    }

    public function show($id)
    {
        $pesanan = Pesanan::where('user_id', Auth::id())
            ->with(['toko', 'detailPesanan.produk'])
            ->findOrFail($id);

        return view('pesanan.show', compact('pesanan'));
    }
}