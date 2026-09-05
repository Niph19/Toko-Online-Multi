@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('pesanan.index') }}" class="text-sm font-medium text-gray-600 hover:text-orange-500 flex items-center space-x-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            <span>Kembali ke Riwayat Pesanan</span>
        </a>
        <span class="text-xs text-gray-400">ID Pesanan: #{{ $pesanan->id }}</span>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
        <div class="bg-gray-900 text-white p-6 flex flex-wrap justify-between items-center gap-4">
            <div>
                <p class="text-xs text-orange-400 font-semibold uppercase tracking-wider">Detail Pesanan</p>
                <h1 class="text-xl font-bold mt-1">Toko {{ $pesanan->toko->nama_toko }}</h1>
                <p class="text-xs text-gray-400 mt-1">Dipesan pada: {{ $pesanan->created_at->format('d M Y, H:i') }} WIB</p>
            </div>
            <div>
                @php
                    $statusClasses = [
                        'menunggu konfirmasi' => 'bg-yellow-500 text-white',
                        'diproses' => 'bg-blue-500 text-white',
                        'dikirim' => 'bg-purple-500 text-white',
                        'selesai' => 'bg-green-500 text-white',
                    ];
                @endphp
                <span class="px-3 py-1.5 text-xs font-bold rounded-lg uppercase tracking-wider {{ $statusClasses[$pesanan->status] ?? 'bg-gray-500 text-white' }}">
                    Status: {{ $pesanan->status }}
                </span>
            </div>
        </div>

        <div class="p-6">
            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 pb-2 border-b border-gray-100">Daftar Produk</h2>
            <div class="divide-y divide-gray-100">
                @foreach($pesanan->detailPesanan as $detail)
                    <div class="py-4 flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <img src="{{ $detail->produk->foto ?? 'https://images.unsplash.com/photo-1560343090-f0409e92791a?w=100&auto=format&fit=crop&q=60' }}" alt="{{ $detail->produk->nama_produk ?? 'Produk' }}" class="w-16 h-16 object-cover rounded-lg border border-gray-100">
                            <div>
                                <h3 class="font-semibold text-gray-900 text-base">{{ $detail->produk->nama_produk ?? 'Produk' }}</h3>
                                <p class="text-xs text-gray-500">Harga Satuan: Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-500">Jumlah: {{ $detail->jumlah }} item</p>
                            </div>
                        </div>
                        <span class="font-bold text-gray-900 text-base">Rp {{ number_format($detail->harga_satuan * $detail->jumlah, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200 flex justify-between items-center">
                <span class="text-base font-semibold text-gray-700">Total Harga</span>
                <span class="text-2xl font-extrabold text-orange-500">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection