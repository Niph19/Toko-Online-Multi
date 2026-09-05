@extends('layouts.seller')

@section('content')
<h1 class="text-2xl font-bold text-gray-900 mb-6">Pesanan Masuk Toko</h1>

<div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                <th class="p-4">ID / Tanggal</th>
                <th class="p-4">Pembeli</th>
                <th class="p-4">Total Pembayaran</th>
                <th class="p-4">Status Pesanan</th>
                <th class="p-4 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm">
            @forelse($pesanans as $pesanan)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4">
                        <div class="font-bold text-gray-900">#{{ $pesanan->id }}</div>
                        <div class="text-xs text-gray-400">{{ $pesanan->created_at->format('d M Y, H:i') }}</div>
                    </td>
                    <td class="p-4 font-medium text-gray-800">{{ $pesanan->user->name ?? 'Pembeli' }}</td>
                    <td class="p-4 font-bold text-orange-500">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                    <td class="p-4">
                        @php
                            $badge = [
                                'menunggu konfirmasi' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                'diproses' => 'bg-blue-100 text-blue-800 border-blue-200',
                                'dikirim' => 'bg-purple-100 text-purple-800 border-purple-200',
                                'selesai' => 'bg-green-100 text-green-800 border-green-200',
                            ];
                        @endphp
                        <span class="px-2.5 py-0.5 text-xs font-bold rounded-full border capitalize {{ $badge[$pesanan->status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $pesanan->status }}
                        </span>
                    </td>
                    <td class="p-4 text-right">
                        <a href="{{ route('seller.pesanan.show', $pesanan->id) }}" class="text-xs font-semibold bg-orange-500 hover:bg-orange-600 text-white px-3 py-1.5 rounded-lg transition shadow-sm inline-block">
                            Detail & Update Status &rarr;
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-400 italic">Belum ada pesanan masuk untuk toko Anda.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection