@extends('layouts.seller')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Daftar Produk Toko</h1>
    <a href="{{ route('seller.produk.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold text-sm px-4 py-2 rounded-lg shadow transition">
        + Tambah Produk
    </a>
</div>

<div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                <th class="p-4">Foto & Nama</th>
                <th class="p-4">Harga</th>
                <th class="p-4">Stok</th>
                <th class="p-4 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm">
            @forelse($produks as $produk)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4">
                        <div class="flex items-center space-x-3">
                            <img src="{{ $produk->foto ?? 'https://images.unsplash.com/photo-1560343090-f0409e92791a?w=100&auto=format&fit=crop&q=60' }}" alt="{{ $produk->nama_produk }}" class="w-12 h-12 object-cover rounded-lg border border-gray-100">
                            <div>
                                <div class="font-semibold text-gray-900">{{ $produk->nama_produk }}</div>
                                <div class="text-xs text-gray-400 line-clamp-1 max-w-xs">{{ $produk->deskripsi ?? 'Tanpa deskripsi' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 font-bold text-orange-500">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                    <td class="p-4 font-medium text-gray-700">{{ $produk->stok }} pcs</td>
                    <td class="p-4 text-right space-x-2">
                        <a href="{{ route('seller.produk.edit', $produk->id) }}" class="text-xs font-semibold bg-gray-100 hover:bg-gray-200 text-gray-800 px-3 py-1.5 rounded-lg transition inline-block">
                            Edit
                        </a>
                        <form action="{{ route('seller.produk.destroy', $produk->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs font-semibold bg-red-50 hover:bg-red-500 hover:text-white text-red-600 px-3 py-1.5 rounded-lg transition">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-gray-400 italic">Belum ada produk. Tambahkan produk pertama Anda!</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection