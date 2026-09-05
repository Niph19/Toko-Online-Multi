@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold text-gray-900 mb-6">Monitoring Transaksi Platform</h1>

<div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                <th class="p-4">ID / Tanggal</th>
                <th class="p-4">Pembeli</th>
                <th class="p-4">Toko Tujuan</th>
                <th class="p-4">Total</th>
                <th class="p-4">Status Pesanan</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm">
            @forelse($pesanans as $pesanan)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4">
                        <div class="font-bold text-gray-900">#{{ $pesanan->id }}</div>
                        <div class="text-xs text-gray-400">{{ $pesanan->created_at->format('d/m/Y H:i') }}</div>
                    </td>
                    <td class="p-4">
                        <div class="font-medium text-gray-800">{{ $pesanan->user->name ?? 'Pembeli' }}</div>
                        <div class="text-xs text-gray-400">{{ $pesanan->user->email ?? '' }}</div>
                    </td>
                    <td class="p-4 font-medium text-gray-800">{{ $pesanan->toko->nama_toko ?? 'Toko' }}</td>
                    <td class="p-4 font-bold text-orange-500">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                    <td class="p-4">
                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full border capitalize bg-gray-100 text-gray-800">
                            {{ $pesanan->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-400 italic">Belum ada transaksi tercatat di platform.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection