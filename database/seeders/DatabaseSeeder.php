<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Toko;
use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Pasar Digital',
            'email' => 'admin@pasardigital.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Buyer
        User::create([
            'name' => 'Budi Pembeli',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'buyer',
        ]);

        // Seller 1 (Toko Aktif)
        $seller1 = User::create([
            'name' => 'Siti Kriya',
            'email' => 'siti@kriya.id',
            'password' => Hash::make('password'),
            'role' => 'seller',
        ]);

        $toko1 = Toko::create([
            'user_id' => $seller1->id,
            'nama_toko' => 'Kriya Nusantara',
            'deskripsi' => 'Kerajinan tangan khas nusantara berbahan bambu dan kayu pilihan.',
            'status' => 'aktif',
        ]);

        Produk::create([
            'toko_id' => $toko1->id,
            'nama_produk' => 'Tas Anyaman Bambu',
            'deskripsi' => 'Tas anyaman bambu handmade berkualitas tinggi dan ramah lingkungan.',
            'harga' => 85000,
            'stok' => 15,
            'foto' => 'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?w=500&auto=format&fit=crop&q=60',
        ]);

        Produk::create([
            'toko_id' => $toko1->id,
            'nama_produk' => 'Ukiran Kayu Jati',
            'deskripsi' => 'Hiasan dinding ukiran kayu jati motif batik Jawa.',
            'harga' => 150000,
            'stok' => 8,
            'foto' => 'https://images.unsplash.com/photo-1513519245088-0e12902e5a38?w=500&auto=format&fit=crop&q=60',
        ]);

        // Seller 2 (Toko Aktif)
        $seller2 = User::create([
            'name' => 'Rudi Tenun',
            'email' => 'rudi@tenun.id',
            'password' => Hash::make('password'),
            'role' => 'seller',
        ]);

        $toko2 = Toko::create([
            'user_id' => $seller2->id,
            'nama_toko' => 'Tenun Ikat Garut',
            'deskripsi' => 'Kain tenun asli buatan perajin lokal dengan bahan serat alami.',
            'status' => 'aktif',
        ]);

        Produk::create([
            'toko_id' => $toko2->id,
            'nama_produk' => 'Kain Tenun Jepara',
            'deskripsi' => 'Kain tenun ikat tradisional dengan pewarna alami.',
            'harga' => 220000,
            'stok' => 10,
            'foto' => 'https://images.unsplash.com/photo-1606744888344-493238951221?w=500&auto=format&fit=crop&q=60',
        ]);

        // Seller 3 (Toko Menunggu Approval)
        $seller3 = User::create([
            'name' => 'Ahmad Batik',
            'email' => 'ahmad@batik.id',
            'password' => Hash::make('password'),
            'role' => 'seller',
        ]);

        Toko::create([
            'user_id' => $seller3->id,
            'nama_toko' => 'Batik Solo Barokah',
            'deskripsi' => 'Batik tulis & cap khas Surakarta.',
            'status' => 'menunggu',
        ]);
    }
}