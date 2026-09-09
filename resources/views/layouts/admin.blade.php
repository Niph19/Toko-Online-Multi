<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - Pasar Digital Nusantara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900 min-h-screen flex flex-col">
    <header class="bg-gray-900 text-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-8">
                <a href="{{ route('admin.dashboard') }}" class="font-bold text-lg">Dashboard Admin</a>
                <nav class="hidden md:flex space-x-6 text-sm font-medium">
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'text-orange-400' : 'text-gray-300 hover:text-white' }}">Ringkasan</a>
                    <a href="{{ route('admin.toko.index') }}" class="{{ request()->routeIs('admin.toko.*') ? 'text-orange-400' : 'text-gray-300 hover:text-white' }}">Kelola Toko</a>
                    <a href="{{ route('admin.pesanan.index') }}" class="{{ request()->routeIs('admin.pesanan.*') ? 'text-orange-400' : 'text-gray-300 hover:text-white' }}">Transaksi</a>
                </nav>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('landing') }}" class="text-xs text-gray-300 hover:text-white">Lihat Toko</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-xs bg-gray-800 hover:bg-red-700 px-3 py-1.5 rounded-lg">Keluar</button>
                </form>
            </div>
        </div>
    </header>

    @if (session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg text-sm text-green-700">{{ session('success') }}</div>
        </div>
    @endif

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-grow w-full">
        @yield('content')
    </main>
</body>
</html>