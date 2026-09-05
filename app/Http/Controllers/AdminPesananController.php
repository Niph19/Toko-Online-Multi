<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class AdminPesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with(['user', 'toko', 'detailPesanan.produk'])
            ->latest()
            ->get();

        return view('admin.pesanan.index', compact('pesanans'));
    }
}