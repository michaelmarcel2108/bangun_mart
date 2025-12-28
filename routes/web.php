<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // KHUSUS ADMIN (Akses Produk & Laporan)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('produk', ProdukController::class);
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    });

    // KHUSUS KASIR (Akses Transaksi)
    Route::middleware(['role:kasir'])->group(function () {
        Route::get('/penjualan/create', function () {
            return view('penjualan.index');
        })->name('penjualan.index');
        
        Route::post('/penjualan/store', [PenjualanController::class, 'store'])->name('penjualan.store');
        Route::get('/penjualan/cetak/{id}', [PenjualanController::class, 'cetak'])->name('penjualan.cetak');
    });
});

require __DIR__.'/auth.php';