@extends('layouts.seller')

@section('content')
<div class="bg-white border border-gray-200 rounded-xl p-6 mb-8 shadow-sm flex flex-wrap items-center justify-between gap-4">
    <div>
        <span class="text-xs font-semibold uppercase tracking-wider px-2 py-1 rounded {{ $toko->status === 'aktif' ? 'text-green-600 bg-green-50' : ($toko->status === 'menunggu' ? 'text-orange-600 bg-orange-50' : 'text-red-600 bg-red-50') }}">
            Status Toko: {{ ucfirst($toko->status) }}
        </span>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">{{ $toko->nama_toko }}</h1>
        <p class="text-sm text-gray-500">{{ $toko->deskripsi ?? 'Belum ada deskripsi toko.' }}</p>
    </div>
    @if($toko->status === 'aktif')
        <a href="{{ route('seller.produk.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-4 py-2.5 rounded-lg shadow transition">
            + Tambah Produk Baru
        </a>
    @endif
</div>

@if($toko->status === 'menunggu')
    <div class="bg-orange-50 border-l-4 border-orange-400 rounded-r-lg p-4 mb-8 text-sm text-orange-800">
        Toko Anda sedang menunggu konfirmasi. Anda sudah dapat login, tetapi pengelolaan produk dan pesanan akan tersedia setelah toko diaktifkan.
    </div>
@elseif($toko->status === 'nonaktif')
    <div class="bg-red-50 border-l-4 border-red-400 rounded-r-lg p-4 mb-8 text-sm text-red-800">
        Toko Anda sedang nonaktif. Silakan hubungi dukungan untuk informasi lebih lanjut.
    </div>
@endif

@if($toko->status === 'aktif')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
        <p class="text-xs text-gray-500 font-semibold uppercase">Total Produk</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalProduk }}</p>
        <a href="{{ route('seller.produk.index') }}" class="text-xs text-orange-500 hover:underline mt-2 inline-block">Kelola produk &rarr;</a>
    </div>

    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
        <p class="text-xs text-gray-500 font-semibold uppercase">Pesanan Menunggu Konfirmasi</p>
        <p class="text-3xl font-bold text-orange-500 mt-2">{{ $pesananMenunggu }}</p>
        <a href="{{ route('seller.pesanan.index') }}" class="text-xs text-orange-500 hover:underline mt-2 inline-block">Proses sekarang &rarr;</a>
    </div>

    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
        <p class="text-xs text-gray-500 font-semibold uppercase">Total Semua Pesanan</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalPesanan }}</p>
        <a href="{{ route('seller.pesanan.index') }}" class="text-xs text-gray-500 hover:underline mt-2 inline-block">Lihat riwayat &rarr;</a>
    </div>

    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
        <p class="text-xs text-gray-500 font-semibold uppercase">Total Pendapatan (Selesai)</p>
        <p class="text-2xl font-bold text-green-600 mt-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        <span class="text-xs text-gray-400 mt-2 inline-block">Transaksi sukses</span>
    </div>
</div>
@endif
@endsection