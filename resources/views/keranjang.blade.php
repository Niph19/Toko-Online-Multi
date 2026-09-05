@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Keranjang Belanja</h1>

    @if(empty($cart))
        <div class="bg-white rounded-xl p-12 text-center border border-gray-200 shadow-sm">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Keranjang Anda Masih Kosong</h2>
            <p class="text-sm text-gray-500 mb-6">Silakan jelajahi berbagai produk unggulan dari perajin nusantara.</p>
            <a href="{{ route('landing') }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-medium text-sm px-6 py-2.5 rounded-lg shadow transition">
                Mulai Belanja
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Items list grouped by store -->
            <div class="lg:col-span-2 space-y-6">
                @foreach($groupedCart as $tokoId => $group)
                    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                        <!-- Toko Title -->
                        <div class="bg-gray-50 px-6 py-3 border-b border-gray-200 flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span class="font-semibold text-gray-900 text-sm">{{ $group['nama_toko'] }}</span>
                        </div>

                        <!-- Products in this store -->
                        <div class="divide-y divide-gray-100">
                            @foreach($group['items'] as $item)
                                <div class="p-4 sm:p-6 flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ $item['foto'] ?? 'https://images.unsplash.com/photo-1560343090-f0409e92791a?w=100&auto=format&fit=crop&q=60' }}" alt="{{ $item['nama_produk'] }}" class="w-16 h-16 object-cover rounded-lg border border-gray-100">
                                        <div>
                                            <h3 class="font-medium text-gray-900 text-sm">{{ $item['nama_produk'] }}</h3>
                                            <p class="text-xs text-gray-500">Rp {{ number_format($item['harga'], 0, ',', '.') }} x {{ $item['jumlah'] }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="font-bold text-gray-900 text-sm">Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</span>
                                        <form action="{{ route('keranjang.hapus', $item['produk_id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors p-1" title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm sticky top-24">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 pb-3 border-b border-gray-100">Ringkasan Belanja</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Total Item</span>
                            <span>{{ array_sum(array_column($cart, 'jumlah')) }} item</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Jumlah Toko</span>
                            <span>{{ count($groupedCart) }} toko</span>
                        </div>
                        <div class="border-t border-gray-100 pt-3 flex justify-between text-base font-bold text-gray-900">
                            <span>Total Pembayaran</span>
                            <span class="text-orange-500">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-4 rounded-lg shadow transition flex items-center justify-center space-x-2">
                            <span>Lanjut ke Checkout</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection