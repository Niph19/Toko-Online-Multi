@extends('layouts.admin')

@section('content')
<div class="flex flex-wrap justify-between items-center mb-6 gap-4">
    <h1 class="text-2xl font-bold text-gray-900">Manajemen Toko UMKM</h1>

    <!-- Filter Status -->
    <div class="flex space-x-2 bg-white p-1 rounded-lg border border-gray-200 shadow-sm text-xs">
        <a href="{{ route('admin.toko.index') }}" class="px-3 py-1.5 rounded-md font-medium {{ !$status ? 'bg-gray-900 text-white' : 'text-gray-600 hover:text-gray-900' }}">Semua</a>
        <a href="{{ route('admin.toko.index', ['status' => 'menunggu']) }}" class="px-3 py-1.5 rounded-md font-medium {{ $status === 'menunggu' ? 'bg-orange-500 text-white' : 'text-gray-600 hover:text-gray-900' }}">Menunggu</a>
        <a href="{{ route('admin.toko.index', ['status' => 'aktif']) }}" class="px-3 py-1.5 rounded-md font-medium {{ $status === 'aktif' ? 'bg-green-600 text-white' : 'text-gray-600 hover:text-gray-900' }}">Aktif</a>
        <a href="{{ route('admin.toko.index', ['status' => 'nonaktif']) }}" class="px-3 py-1.5 rounded-md font-medium {{ $status === 'nonaktif' ? 'bg-red-600 text-white' : 'text-gray-600 hover:text-gray-900' }}">Nonaktif</a>
    </div>
</div>

<div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                <th class="p-4">Nama Toko</th>
                <th class="p-4">Pemilik (User)</th>
                <th class="p-4">Deskripsi</th>
                <th class="p-4">Status</th>
                <th class="p-4 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm">
            @forelse($tokos as $toko)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 font-semibold text-gray-900">{{ $toko->nama_toko }}</td>
                    <td class="p-4">
                        <div class="font-medium text-gray-800">{{ $toko->user->name ?? 'User Tidak Ditemukan' }}</div>
                        <div class="text-xs text-gray-400">{{ $toko->user->email ?? '' }}</div>
                    </td>
                    <td class="p-4 text-gray-500 max-w-xs truncate">{{ $toko->deskripsi ?? '-' }}</td>
                    <td class="p-4">
                        @php
                            $badge = [
                                'menunggu' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                'aktif' => 'bg-green-100 text-green-800 border-green-200',
                                'nonaktif' => 'bg-red-100 text-red-800 border-red-200',
                            ];
                        @endphp
                        <span class="px-2.5 py-0.5 text-xs font-bold rounded-full border capitalize {{ $badge[$toko->status] }}">
                            {{ $toko->status }}
                        </span>
                    </td>
                    <td class="p-4 text-right space-x-2">
                        @if($toko->status !== 'aktif')
                            <form action="{{ route('admin.toko.approve', $toko->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-xs font-medium px-3 py-1.5 rounded-lg transition shadow-sm">
                                    Setujui / Aktifkan
                                </button>
                            </form>
                        @endif

                        @if($toko->status !== 'nonaktif')
                            <form action="{{ route('admin.toko.reject', $toko->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="bg-gray-200 hover:bg-red-500 hover:text-white text-gray-700 text-xs font-medium px-3 py-1.5 rounded-lg transition">
                                    Nonaktifkan
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-400 italic">Tidak ada toko yang ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection