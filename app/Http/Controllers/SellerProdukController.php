<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerProdukController extends Controller
{
    public function index()
    {
        $tokoId = Auth::user()->toko->id;
        $produks = Produk::where('toko_id', $tokoId)->latest()->get();

        return view('seller.produk.index', compact('produks'));
    }

    public function create()
    {
        return view('seller.produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|string',
        ]);

        $tokoId = Auth::user()->toko->id;

        Produk::create([
            'toko_id' => $tokoId,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'foto' => $request->foto,
        ]);

        return redirect()->route('seller.produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $tokoId = Auth::user()->toko->id;
        $produk = Produk::where('toko_id', $tokoId)->findOrFail($id);

        return view('seller.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $tokoId = Auth::user()->toko->id;
        $produk = Produk::where('toko_id', $tokoId)->findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|string',
        ]);

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'foto' => $request->foto,
        ]);

        return redirect()->route('seller.produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $tokoId = Auth::user()->toko->id;
        $produk = Produk::where('toko_id', $tokoId)->findOrFail($id);
        $produk->delete();

        return redirect()->route('seller.produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}