@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold text-gray-900 mb-6">Transaksi Platform</h1>
<div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-x-auto">
    <table class="w-full text-sm text-left">
        <thead class="bg-gray-50 border-b border-gray-200 text-gray-600"><tr><th class="px-5 py-3">ID</th><th class="px-5 py-3">Pembeli</th><th class="px-5 py-3">Toko</th><th class="px-5 py-3">Total</th><th class="px-5 py-3">Status</th><th class="px-5 py-3">Tanggal</th></tr></thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($pesanans as $pesanan)
                <tr><td class="px-5 py-4 font-semibold">#{{ $pesanan->id }}</td><td class="px-5 py-4">{{ $pesanan->user->name ?? '-' }}</td><td class="px-5 py-4">{{ $pesanan->toko->nama_toko ?? '-' }}</td><td class="px-5 py-4">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td><td class="px-5 py-4">{{ ucfirst($pesanan->status) }}</td><td class="px-5 py-4 text-gray-500">{{ $pesanan->created_at->format('d M Y H:i') }}</td></tr>
            @empty
                <tr><td colspan="6" class="px-5 py-10 text-center text-gray-500">Belum ada transaksi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection