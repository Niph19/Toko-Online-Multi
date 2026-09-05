<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Pasar Digital Nusantara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900 min-h-screen flex flex-col">
    <!-- Admin Header -->
    <header class="bg-gray-900 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-6">
                <a href="{{ route('admin.dashboard') }}" class="font-bold text-lg text-white flex items-center space-x-2">
                    <span class="bg-orange-500 text-white px-2 py-1 rounded font-black text-sm">ADMIN</span>
                    <span>Pasar Digital Nusantara</span>
                </a>
                <nav class="hidden md:flex space-x-4 text-sm font-medium">
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'text-orange-500 font-semibold' : 'text-gray-300 hover:text-white' }}">Dashboard</a>
                    <a href="{{ route('admin.toko.index') }}" class="{{ request()->routeIs('admin.toko.*') ? 'text-orange-500 font-semibold' : 'text-gray-300 hover:text-white' }}">Kelola Toko</a>
                    <a href="{{ route('admin.pesanan.index') }}" class="{{ request()->routeIs('admin.pesanan.*') ? 'text-orange-500 font-semibold' : 'text-gray-300 hover:text-white' }}">Transaksi Platform</a>
                </nav>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-xs text-gray-400">Halo, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-xs bg-gray-800 hover:bg-red-600 text-white px-3 py-1.5 rounded transition">Keluar</button>
                </form>
            </div>
        </div>
    </header>

    @if (session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm text-sm text-green-700 font-medium">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-grow w-full">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-200 py-4 text-center text-xs text-gray-500">
        &copy; {{ date('Y') }} Admin Pasar Digital Nusantara
    </footer>
</body>
</html>