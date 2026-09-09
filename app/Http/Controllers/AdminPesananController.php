<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;

class AdminPesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with(['user', 'toko', 'detailpesanan.produk'])
            ->latest()
            ->get();

        return view('admin.pesanan.index', compact('pesanans'));
    }
}