<x-guest-layout>
    <div class="mb-6 text-center">
        <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 text-xs font-semibold rounded-full mb-2">Akun Penjual</span>
        <h2 class="text-2xl font-bold text-gray-900">Pendaftaran Toko Baru</h2>
        <p class="text-sm text-gray-600 mt-1">Lengkapi data akun dan informasi toko Anda</p>
    </div>

    <form method="POST" action="{{ route('register.toko') }}" class="space-y-4">
        @csrf

        <div class="border-b border-gray-200 pb-3 mb-3">
            <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Informasi Akun Penjual</h3>
        </div>

        <div>
            <x-input-label for="name" value="Nama Pemilik Toko" />
            <x-text-input id="name" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" value="Email Penjual" />
            <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <x-input-label for="password" value="Kata Sandi" />
                <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" value="Konfirmasi Kata Sandi" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="border-b border-gray-200 pb-3 pt-3 mb-3">
            <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Informasi Profil Toko</h3>
        </div>

        <div>
            <x-input-label for="nama_toko" value="Nama Toko" />
            <x-text-input id="nama_toko" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" type="text" name="nama_toko" :value="old('nama_toko')" required placeholder="Contoh: Toko Berkah Nusantara" />
            <x-input-error :messages="$errors->get('nama_toko')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="deskripsi" value="Deskripsi Singkat Toko" />
            <textarea id="deskripsi" name="deskripsi" rows="3" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm" placeholder="Jelaskan produk utama yang dijual di toko Anda...">{{ old('deskripsi') }}</textarea>
            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-2.5 px-4 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition duration-200">
                Daftarkan Toko Sekarang
            </button>
        </div>

        <div class="text-center mt-6 pt-4 border-t border-gray-100">
            <p class="text-sm text-gray-600">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="text-orange-500 font-semibold hover:underline">Masuk di Sini</a>
            </p>
        </div>
    </form>
</x-guest-layout>
