<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang Anda kosong.');
        }

        // Group cart items by toko_id
        $groupedCart = [];
        foreach ($cart as $item) {
            $tokoId = $item['toko_id'];
            if (!isset($groupedCart[$tokoId])) {
                $groupedCart[$tokoId] = [];
            }
            $groupedCart[$tokoId][] = $item;
        }

        DB::transaction(function () use ($groupedCart) {
            $userId = Auth::id();

            foreach ($groupedCart as $tokoId => $items) {
                $totalHarga = array_reduce($items, function ($carry, $item) {
                    return $carry + ($item['harga'] * $item['jumlah']);
                }, 0);

                // Create Pesanan record per store
                $pesanan = Pesanan::create([
                    'user_id' => $userId,
                    'toko_id' => $tokoId,
                    'status' => 'menunggu konfirmasi',
                    'total_harga' => $totalHarga,
                ]);

                // Bulk insert DetailPesanan with price snapshot
                foreach ($items as $item) {
                    DetailPesanan::create([
                        'pesanan_id' => $pesanan->id,
                        'produk_id' => $item['produk_id'],
                        'jumlah' => $item['jumlah'],
                        'harga_satuan' => $item['harga'],
                    ]);
                }
            }

            // Clear session cart
            session()->forget('cart');
        });

        return redirect()->route('pesanan.index')->with('success', 'Checkout berhasil! Pesanan Anda telah dikirim ke masing-masing toko.');
    }
}