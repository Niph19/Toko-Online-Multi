@extends('layouts.admin')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Kelola Toko</h1>
    <div class="flex gap-2 text-sm">
        <a href="{{ route('admin.toko.index') }}" class="px-3 py-2 rounded-md {{ !$status ? 'bg-gray-900 text-white' : 'bg-white text-gray-600' }}">Semua</a>
        <a href="{{ route('admin.toko.index', ['status' => 'menunggu']) }}" class="px-3 py-2 rounded-md {{ $status === 'menunggu' ? 'bg-orange-500 text-white' : 'bg-white text-gray-600' }}">Menunggu</a>
        <a href="{{ route('admin.toko.index', ['status' => 'aktif']) }}" class="px-3 py-2 rounded-md {{ $status === 'aktif' ? 'bg-green-600 text-white' : 'bg-white text-gray-600' }}">Aktif</a>
        <a href="{{ route('admin.toko.index', ['status' => 'nonaktif']) }}" class="px-3 py-2 rounded-md {{ $status === 'nonaktif' ? 'bg-red-600 text-white' : 'bg-white text-gray-600' }}">Nonaktif</a>
    </div>
</div>

<div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-x-auto">
    <table class="w-full text-sm text-left">
        <thead class="bg-gray-50 border-b border-gray-200 text-gray-600">
            <tr><th class="px-5 py-3">Toko</th><th class="px-5 py-3">Pemilik</th><th class="px-5 py-3">Status</th><th class="px-5 py-3 text-right">Aksi</th></tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($tokos as $toko)
                <tr>
                    <td class="px-5 py-4"><div class="font-semibold text-gray-900">{{ $toko->nama_toko }}</div><div class="text-xs text-gray-500">{{ $toko->deskripsi }}</div></td>
                    <td class="px-5 py-4">{{ $toko->user->name ?? '-' }}<div class="text-xs text-gray-500">{{ $toko->user->email ?? '-' }}</div></td>
                    <td class="px-5 py-4"><span class="px-2 py-1 rounded-full text-xs font-semibold {{ $toko->status === 'aktif' ? 'bg-green-100 text-green-700' : ($toko->status === 'menunggu' ? 'bg-orange-100 text-orange-700' : 'bg-red-100 text-red-700') }}">{{ ucfirst($toko->status) }}</span></td>
                    <td class="px-5 py-4 text-right">
                        @if($toko->status !== 'aktif')
                            <form action="{{ route('admin.toko.approve', $toko->id) }}" method="POST" class="inline">@csrf @method('PUT')<button class="text-green-600 hover:underline mr-3">Aktifkan</button></form>
                        @endif
                        @if($toko->status !== 'nonaktif')
                            <form action="{{ route('admin.toko.reject', $toko->id) }}" method="POST" class="inline">@csrf @method('PUT')<button class="text-red-600 hover:underline">Nonaktifkan</button></form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-5 py-10 text-center text-gray-500">Belum ada toko.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection