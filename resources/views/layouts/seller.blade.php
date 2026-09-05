<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seller Dashboard - {{ auth()->user()->toko->nama_toko ?? 'Toko' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900 min-h-screen flex flex-col">
    <!-- Seller Header -->
    <header class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-6">
                <a href="{{ route('seller.dashboard') }}" class="font-bold text-lg text-gray-900 flex items-center space-x-2">
                    <span class="bg-orange-500 text-white px-2 py-1 rounded text-xs font-bold">SELLER</span>
                    <span class="text-orange-500 font-black">{{ auth()->user()->toko->nama_toko ?? 'Toko Saya' }}</span>
                </a>
                <nav class="hidden md:flex space-x-6 text-sm font-medium">
                    <a href="{{ route('seller.dashboard') }}" class="{{ request()->routeIs('seller.dashboard') ? 'text-orange-500 border-b-2 border-orange-500 pb-5 pt-5 font-semibold' : 'text-gray-600 hover:text-gray-900' }}">Dashboard</a>
                    <a href="{{ route('seller.produk.index') }}" class="{{ request()->routeIs('seller.produk.*') ? 'text-orange-500 border-b-2 border-orange-500 pb-5 pt-5 font-semibold' : 'text-gray-600 hover:text-gray-900' }}">Produk Toko</a>
                    <a href="{{ route('seller.pesanan.index') }}" class="{{ request()->routeIs('seller.pesanan.*') ? 'text-orange-500 border-b-2 border-orange-500 pb-5 pt-5 font-semibold' : 'text-gray-600 hover:text-gray-900' }}">Pesanan Masuk</a>
                </nav>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('landing') }}" class="text-xs font-medium text-gray-500 hover:text-orange-500">Lihat Toko Publik</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-xs bg-gray-100 hover:bg-red-50 text-red-600 px-3 py-1.5 rounded-lg border border-gray-200 transition font-medium">Keluar</button>
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
        &copy; {{ date('Y') }} Seller Center - Pasar Digital Nusantara
    </footer>
</body>
</html>