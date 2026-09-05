@extends('layouts.seller')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('seller.pesanan.index') }}" class="text-xs font-medium text-gray-500 hover:text-gray-800">&larr; Kembali ke Pesanan Masuk</a>
        <span class="text-xs text-gray-400">Pesanan #{{ $pesanan->id }}</span>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm mb-6">
        <div class="p-6 border-b border-gray-200 flex flex-wrap justify-between items-center gap-4">
            <div>
                <h1 class="text-xl font-bold text-gray-900">Pesanan dari {{ $pesanan->user->name }}</h1>
                <p class="text-xs text-gray-400 mt-0.5">Email Pembeli: {{ $pesanan->user->email }} | Waktu: {{ $pesanan->created_at->format('d M Y, H:i') }}</p>
            </div>

            <!-- Form Update Status -->
            <form action="{{ route('seller.pesanan.updateStatus', $pesanan->id) }}" method="POST" class="flex items-center space-x-2">
                @csrf
                @method('PUT')
                <select name="status" class="text-xs font-semibold rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500">
                    <option value="menunggu konfirmasi" {{ $pesanan->status === 'menunggu konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                    <option value="diproses" {{ $pesanan->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="dikirim" {{ $pesanan->status === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="selesai" {{ $pesanan->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                <button type="submit" class="bg-gray-900 hover:bg-orange-500 text-white text-xs font-semibold px-3 py-2 rounded-lg transition">
                    Update Status
                </button>
            </form>
        </div>

        <div class="p-6">
            <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Item Produk</h2>
            <div class="divide-y divide-gray-100">
                @foreach($pesanan->detailPesanan as $detail)
                    <div class="py-3 flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <img src="{{ $detail->produk->foto ?? 'https://images.unsplash.com/photo-1560343090-f0409e92791a?w=100&auto=format&fit=crop&q=60' }}" class="w-12 h-12 object-cover rounded-lg border border-gray-100">
                            <div>
                                <h3 class="font-semibold text-gray-900 text-sm">{{ $detail->produk->nama_produk ?? 'Produk' }}</h3>
                                <p class="text-xs text-gray-500">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }} x {{ $detail->jumlah }} item</p>
                            </div>
                        </div>
                        <span class="font-bold text-gray-900 text-sm">Rp {{ number_format($detail->harga_satuan * $detail->jumlah, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 pt-4 border-t border-gray-200 flex justify-between items-center">
                <span class="font-semibold text-gray-700 text-sm">Total Nilai Pesanan</span>
                <span class="text-xl font-extrabold text-orange-500">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection