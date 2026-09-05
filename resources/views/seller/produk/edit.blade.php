@extends('layouts.seller')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Edit Produk</h1>
        <a href="{{ route('seller.produk.index') }}" class="text-xs text-gray-500 hover:text-gray-800">&larr; Batal</a>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
        <form action="{{ route('seller.produk.update', $produk->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Nama Produk</label>
                <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" required class="w-full border-gray-300 rounded-lg text-sm focus:ring-orange-500 focus:border-orange-500">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Harga (Rp)</label>
                    <input type="number" name="harga" value="{{ $produk->harga }}" required min="0" class="w-full border-gray-300 rounded-lg text-sm focus:ring-orange-500 focus:border-orange-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Stok</label>
                    <input type="number" name="stok" value="{{ $produk->stok }}" required min="0" class="w-full border-gray-300 rounded-lg text-sm focus:ring-orange-500 focus:border-orange-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">URL Foto Produk</label>
                <input type="url" name="foto" value="{{ $produk->foto }}" class="w-full border-gray-300 rounded-lg text-sm focus:ring-orange-500 focus:border-orange-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Deskripsi Produk</label>
                <textarea name="deskripsi" rows="4" class="w-full border-gray-300 rounded-lg text-sm focus:ring-orange-500 focus:border-orange-500">{{ $produk->deskripsi }}</textarea>
            </div>

            <div class="pt-4 flex justify-end space-x-3">
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold text-sm px-6 py-2.5 rounded-lg shadow transition">
                    Perbarui Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection