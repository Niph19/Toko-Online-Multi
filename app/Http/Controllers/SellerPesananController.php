<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerPesananController extends Controller
{
    public function index()
    {
        $tokoId = Auth::user()->toko->id;
        $pesanans = Pesanan::where('toko_id', $tokoId)
            ->with(['user', 'detailPesanan.produk'])
            ->latest()
            ->get();

        return view('seller.pesanan.index', compact('pesanans'));
    }

    public function show($id)
    {
        $tokoId = Auth::user()->toko->id;
        $pesanan = Pesanan::where('toko_id', $tokoId)
            ->with(['user', 'detailPesanan.produk'])
            ->findOrFail($id);

        return view('seller.pesanan.show', compact('pesanan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $tokoId = Auth::user()->toko->id;
        $pesanan = Pesanan::where('toko_id', $tokoId)->findOrFail($id);

        $request->validate([
            'status' => 'required|in:menunggu konfirmasi,diproses,dikirim,selesai',
        ]);

        $pesanan->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}