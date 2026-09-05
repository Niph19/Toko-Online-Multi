<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminTokoController;
use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\SellerProdukController;
use App\Http\Controllers\SellerPesananController;

// Public Routes
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/tambah', [CartController::class, 'add'])->name('keranjang.tambah');
Route::delete('/keranjang/{produk_id}', [CartController::class, 'remove'])->name('keranjang.hapus');

// Buyer Routes
Route::middleware(['auth', 'role:buyer'])->group(function () {
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');
});

// Seller Routes
Route::middleware(['auth', 'role:seller', 'store.active'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');

    // Produk CRUD
    Route::get('/produk', [SellerProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [SellerProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [SellerProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}/edit', [SellerProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [SellerProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [SellerProdukController::class, 'destroy'])->name('produk.destroy');

    // Pesanan Seller
    Route::get('/pesanan', [SellerPesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{id}', [SellerPesananController::class, 'show'])->name('pesanan.show');
    Route::put('/pesanan/{id}/status', [SellerPesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/toko', [AdminTokoController::class, 'index'])->name('toko.index');
    Route::put('/toko/{id}/approve', [AdminTokoController::class, 'approve'])->name('toko.approve');
    Route::put('/toko/{id}/reject', [AdminTokoController::class, 'reject'])->name('toko.reject');

    Route::get('/pesanan', [AdminPesananController::class, 'index'])->name('pesanan.index');
});

require __DIR__.'/auth.php';