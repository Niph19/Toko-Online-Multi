@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Pesanan Saya</h1>

    @if($pesanans->isEmpty())
        <div class="bg-white rounded-xl p-12 text-center border border-gray-200 shadow-sm">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Pesanan</h2>
            <p class="text-sm text-gray-500 mb-6">Anda belum pernah melakukan pemesanan.</p>
            <a href="{{ route('landing') }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-medium text-sm px-6 py-2.5 rounded-lg shadow transition">
                Mulai Belanja
            </a>
        </div>
    @else
        <div class="space-y-6">
            @foreach($pesanans as $pesanan)
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center space-x-3">
                            <span class="font-bold text-gray-900 text-sm">Toko: {{ $pesanan->toko->nama_toko }}</span>
                            <span class="text-xs text-gray-400">|</span>
                            <span class="text-xs text-gray-500">{{ $pesanan->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            @php
                                $statusClasses = [
                                    'menunggu konfirmasi' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                    'diproses' => 'bg-blue-100 text-blue-800 border-blue-200',
                                    'dikirim' => 'bg-purple-100 text-purple-800 border-purple-200',
                                    'selesai' => 'bg-green-100 text-green-800 border-green-200',
                                ];
                            @endphp
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full border capitalize {{ $statusClasses[$pesanan->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $pesanan->status }}
                            </span>
                            <a href="{{ route('pesanan.show', $pesanan->id) }}" class="text-xs font-semibold text-orange-500 hover:underline">
                                Detail Pesanan &rarr;
                            </a>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="divide-y divide-gray-100">
                            @foreach($pesanan->detailPesanan as $detail)
                                <div class="py-3 first:pt-0 last:pb-0 flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ $detail->produk->foto ?? 'https://images.unsplash.com/photo-1560343090-f0409e92791a?w=100&auto=format&fit=crop&q=60' }}" alt="{{ $detail->produk->nama_produk ?? 'Produk' }}" class="w-12 h-12 object-cover rounded-lg border border-gray-100">
                                        <div>
                                            <h4 class="font-medium text-gray-900 text-sm">{{ $detail->produk->nama_produk ?? 'Produk Dihapus' }}</h4>
                                            <p class="text-xs text-gray-500">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }} x {{ $detail->jumlah }}</p>
                                        </div>
                                    </div>
                                    <span class="font-semibold text-gray-900 text-sm">Rp {{ number_format($detail->harga_satuan * $detail->jumlah, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                            <span class="text-sm text-gray-500">Total Transaksi Toko Ini</span>
                            <span class="text-lg font-bold text-orange-500">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection