<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeranjangController;

Route::get('/', [KeranjangController::class, 'index']);
Route::get('/index', [KeranjangController::class, 'index']);
Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah']);
Route::get('/keranjang', [KeranjangController::class, 'keranjang']);
Route::post('/keranjang/update/{id}', [KeranjangController::class, 'update']);
Route::post('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus']);
Route::post('/keranjang/kosongkan', [KeranjangController::class, 'kosongkan']);