@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold text-gray-900 mb-6">Ringkasan Platform Admin</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
        <p class="text-xs text-gray-500 font-semibold uppercase">Toko Menunggu Persetujuan</p>
        <p class="text-3xl font-bold text-orange-500 mt-2">{{ $totalTokoMenunggu }}</p>
        <a href="{{ route('admin.toko.index', ['status' => 'menunggu']) }}" class="text-xs text-orange-600 hover:underline mt-2 inline-block">Lihat antrean &rarr;</a>
    </div>

    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
        <p class="text-xs text-gray-500 font-semibold uppercase">Toko Aktif</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalTokoAktif }}</p>
        <a href="{{ route('admin.toko.index', ['status' => 'aktif']) }}" class="text-xs text-gray-500 hover:underline mt-2 inline-block">Lihat daftar toko &rarr;</a>
    </div>

    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
        <p class="text-xs text-gray-500 font-semibold uppercase">Total Pesanan</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalPesanan }}</p>
        <a href="{{ route('admin.pesanan.index') }}" class="text-xs text-gray-500 hover:underline mt-2 inline-block">Lihat semua pesanan &rarr;</a>
    </div>

    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
        <p class="text-xs text-gray-500 font-semibold uppercase">Total Nilai Transaksi</p>
        <p class="text-2xl font-bold text-green-600 mt-2">Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</p>
        <span class="text-xs text-gray-400 mt-2 inline-block">Akumulasi platform</span>
    </div>
</div>
@endsection