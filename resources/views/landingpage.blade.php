@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-gray-900 text-white py-16 px-4 sm:px-6 lg:px-8 mb-12">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <div>
            <span class="text-orange-500 font-semibold uppercase tracking-wider text-sm">Platform Multi-Seller UMKM</span>
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight mt-2 mb-4 leading-tight">
                Dukung Produk Lokal <br><span class="text-orange-500">Pasar Digital Nusantara</span>
            </h1>
            <p class="text-gray-300 text-base sm:text-lg mb-8 max-w-xl">
                Temukan aneka karya kerajinan, tenun, dan produk olahan unggulan langsung dari perajin dan pelaku usaha mikro di seluruh wilayah nusantara.
            </p>
            <div class="flex space-x-4">
                <a href="#produk-toko" class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-6 py-3 rounded-lg shadow transition">
                    Jelajahi Produk
                </a>
                @guest
                    <a href="{{ route('register.toko') }}" class="bg-gray-800 hover:bg-gray-700 text-white font-medium px-6 py-3 rounded-lg border border-gray-700 transition">
                        Buka Toko Gratis
                    </a>
                @endguest
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <img src="https://images.unsplash.com/photo-1590874103328-eac38a683ce7?w=600&auto=format&fit=crop&q=80" alt="Produk Bambu" class="rounded-xl shadow-lg h-48 w-full object-cover">
            <img src="https://images.unsplash.com/photo-1606744888344-493238951221?w=600&auto=format&fit=crop&q=80" alt="Tenun Ikat" class="rounded-xl shadow-lg h-48 w-full object-cover">
            <img src="https://images.unsplash.com/photo-1513519245088-0e12902e5a38?w=600&auto=format&fit=crop&q=80" alt="Ukiran Kayu" class="rounded-xl shadow-lg h-48 w-full object-cover col-span-2">
        </div>
    </div>
</div>

<!-- Main Section: Products Grouped by Store -->
<div id="produk-toko" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @if($tokos->isEmpty())
        <div class="bg-white rounded-xl p-12 text-center border border-gray-200 shadow-sm">
            <p class="text-gray-500 text-lg">Belum ada toko atau produk yang tersedia saat ini.</p>
        </div>
    @else
        @foreach($tokos as $toko)
            <div class="mb-12">
                <!-- Store Header -->
                <div class="flex items-center space-x-3 mb-6 pb-3 border-b border-gray-200">
                    <div class="w-10 h-10 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center font-bold text-lg">
                        {{ strtoupper(substr($toko->nama_toko, 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">{{ $toko->nama_toko }}</h2>
                        <p class="text-xs text-gray-500">{{ $toko->deskripsi ?? 'Toko terverifikasi Pasar Digital Nusantara' }}</p>
                    </div>
                </div>

                <!-- Product Grid -->
                @if($toko->produk->isEmpty())
                    <p class="text-sm text-gray-400 italic">Toko ini belum menambahkan produk.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($toko->produk as $produk)
                            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                                <div>
                                    <div class="h-48 bg-gray-100 overflow-hidden relative">
                                        <img src="{{ $produk->foto ?? 'https://images.unsplash.com/photo-1560343090-f0409e92791a?w=500&auto=format&fit=crop&q=60' }}" alt="{{ $produk->nama_produk }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-semibold text-gray-900 text-base mb-1 truncate">{{ $produk->nama_produk }}</h3>
                                        <p class="text-xs text-gray-500 mb-3 line-clamp-2">{{ $produk->deskripsi }}</p>
                                        <div class="flex items-center justify-between">
                                            <span class="text-base font-bold text-orange-500">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                            <span class="text-xs text-gray-400">Stok: {{ $produk->stok }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 pt-0">
                                    <form action="{{ route('keranjang.tambah') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                        <button type="submit" class="w-full bg-gray-900 hover:bg-orange-500 text-white font-medium text-sm py-2 px-4 rounded-lg transition-colors flex items-center justify-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            <span>Tambah ke Keranjang</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    @endif
</div>
@endsection