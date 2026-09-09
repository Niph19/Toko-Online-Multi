@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Ringkasan Platform</h1>
        <p class="text-sm text-gray-500 mt-1">Pantau toko dan transaksi marketplace.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-5">
    <a href="{{ route('admin.toko.index', ['status' => 'menunggu']) }}" class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:border-orange-400 transition">
        <p class="text-sm text-gray-500">Toko Menunggu</p>
        <p class="text-3xl font-bold text-orange-500 mt-2">{{ $totalTokoMenunggu }}</p>
    </a>
    <a href="{{ route('admin.toko.index', ['status' => 'aktif']) }}" class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:border-orange-400 transition">
        <p class="text-sm text-gray-500">Toko Aktif</p>
        <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalTokoAktif }}</p>
    </a>
</div>
@endsection