<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-8">
                <!-- Logo / Title -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('landing') }}" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center text-white font-bold text-lg">P</div>
                        <span class="text-xl font-bold tracking-tight text-gray-900">Pasar Digital <span class="text-orange-500">Nusantara</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:flex items-center">
                    @auth
                        @if(auth()->user()->role === 'buyer')
                            <a href="{{ route('pesanan.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 {{ request()->routeIs('pesanan.*') ? 'text-orange-500 font-semibold border-b-2 border-orange-500' : 'text-gray-600 hover:text-gray-900' }}">
                                Pesanan Saya
                            </a>
                        @elseif(auth()->user()->role === 'seller')
                            <a href="{{ route('seller.dashboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 {{ request()->routeIs('seller.*') ? 'text-orange-500 font-semibold border-b-2 border-orange-500' : 'text-gray-600 hover:text-gray-900' }}">
                                Dashboard Seller
                            </a>
                        @elseif(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 {{ request()->routeIs('admin.*') ? 'text-orange-500 font-semibold border-b-2 border-orange-500' : 'text-gray-600 hover:text-gray-900' }}">
                                Dashboard Admin
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right Navbar: Cart & Profile / Auth Buttons -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                <!-- Cart Button -->
                @php
                    $cartCount = count(session('cart', []));
                @endphp
                <a href="{{ route('keranjang.index') }}" class="relative inline-flex items-center p-2 text-gray-700 hover:text-orange-500 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    @if($cartCount > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white bg-orange-500 rounded-full">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                @auth
                    <!-- Settings Dropdown -->
                    <div class="relative" x-data="{ openDropdown: false }">
                        <button @click="openDropdown = !openDropdown" @click.away="openDropdown = false" class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:border-gray-400 focus:outline-none transition">
                            <span>{{ Auth::user()->name }}</span>
                            <span class="ml-1.5 px-1.5 py-0.5 text-xs rounded bg-gray-100 text-gray-600 capitalize font-mono">{{ Auth::user()->role }}</span>
                            <svg class="ml-2 -mr-0.5 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="openDropdown" x-transition class="absolute right-0 mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-50" style="display: none;">
                            <div class="py-1">
                                <div class="px-4 py-2 text-xs text-gray-500">
                                    Signed in as<br>
                                    <span class="font-medium text-gray-900 truncate block">{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                            <div class="py-1">
                                @if(Auth::user()->role === 'buyer')
                                    <a href="{{ route('pesanan.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-500">Pesanan Saya</a>
                                @elseif(Auth::user()->role === 'seller')
                                    <a href="{{ route('seller.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-500">Dashboard Toko</a>
                                @elseif(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-500">Panel Admin</a>
                                @endif
                            </div>
                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        Keluar / Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-orange-500 px-3 py-2">Masuk</a>
                    <a href="{{ route('register') }}" class="text-sm font-medium bg-orange-500 text-white hover:bg-orange-600 px-4 py-2 rounded-lg transition-colors shadow-sm">Daftar</a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-b border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('landing') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50">Beranda</a>
            <a href="{{ route('keranjang.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50">Keranjang ({{ $cartCount }})</a>
            @auth
                @if(auth()->user()->role === 'buyer')
                    <a href="{{ route('pesanan.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50">Pesanan Saya</a>
                @elseif(auth()->user()->role === 'seller')
                    <a href="{{ route('seller.dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50">Dashboard Seller</a>
                @elseif(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50">Dashboard Admin</a>
                @endif
            @endauth
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4 mb-2">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-red-600 hover:bg-red-50">Keluar</button>
                </form>
            @else
                <div class="space-y-1 px-4 py-2">
                    <a href="{{ route('login') }}" class="block text-gray-700 py-1">Masuk</a>
                    <a href="{{ route('register') }}" class="block text-orange-500 font-semibold py-1">Daftar</a>
                </div>
            @endauth
        </div>
    </div>
</nav>