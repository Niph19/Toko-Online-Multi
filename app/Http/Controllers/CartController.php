<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        $groupedCart = [];
        foreach ($cart as $item) {
            $tokoId = $item['toko_id'];
            if (!isset($groupedCart[$tokoId])) {
                $groupedCart[$tokoId] = [
                    'nama_toko' => $item['nama_toko'] ?? 'Toko',
                    'items' => []
                ];
            }
            $groupedCart[$tokoId]['items'][] = $item;
        }

        $totalHarga = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['harga'] * $item['jumlah']);
        }, 0);

        return view('keranjang', compact('groupedCart', 'totalHarga', 'cart'));
    }

    public function add(Request $request, Produk $produk)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'jumlah' => 'nullable|integer|min:1',
        ]);

        $produk = Produk::with('toko')->findOrFail($request->produk_id);
        $jumlah = $request->jumlah ?? 1;

        $cart = session()->get('cart', []);

        if (isset($cart[$produk->id])) {
            $cart[$produk->id]['jumlah'] += $jumlah;
        } else {
            $cart[$produk->id] = [
                'produk_id' => $produk->id,
                'toko_id' => $produk->toko_id,
                'nama_toko' => $produk->toko->nama_toko,
                'nama_produk' => $produk->nama_produk,
                'harga' => (float) $produk->harga,
                'jumlah' => $jumlah,
                'foto' => $produk->foto,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function remove($produk_id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$produk_id])) {
            unset($cart[$produk_id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('keranjang.index')->with('success', 'Produk dihapus dari keranjang.');
    }
}