<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;

Route::get('/', function () {
    return redirect('/produk'); 
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


Route::get('/produk', [ShopController::class, 'index']);

Route::post('/keranjang/tambah/{id_barang}', [ShopController::class, 'tambahKeranjang'])->middleware('auth');
Route::get('/keranjang', [ShopController::class, 'keranjang'])->middleware('auth');
Route::post('/keranjang/update/{id_barang}', [ShopController::class, 'updateKeranjang'])->middleware('auth');
Route::post('/keranjang/hapus/{id_barang}', [ShopController::class, 'hapusKeranjang'])->middleware('auth');
Route::post('/checkout', [ShopController::class, 'checkout'])->middleware('auth');
Route::get('/riwayat', [ShopController::class, 'riwayat'])->middleware('auth');
