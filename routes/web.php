<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\AdminTokoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\SellerPesananController;
use App\Http\Controllers\SellerProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/keranjang', function () {
    return view('keranjang');
});

Route::middleware(['auth', 'role:buyer'])->group(function () {
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');
});

Route::middleware(['auth', 'role:seller', 'store.active'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');
    Route::resource('produk', SellerProdukController::class);
    Route::get('/pesanan', [SellerPesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{id}', [SellerPesananController::class, 'show'])->name('pesanan.show');
    Route::put('/pesanan/{id}/status', [SellerPesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/toko', [AdminTokoController::class, 'index'])->name('toko.index');
    Route::put('/toko/{id}/approve', [AdminTokoController::class, 'approve'])->name('toko.approve');
    Route::put('/toko/{id}/reject', [AdminTokoController::class, 'reject'])->name('toko.reject');
    Route::get('/pesanan', [AdminPesananController::class, 'index'])->name('pesanan.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
