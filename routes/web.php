<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return redirect()->route('produk.index');
});

Route::resource('produk', ProdukController::class)
    ->except(['show']);
    
Route::resource('transaksi', TransaksiController::class)
    ->only(['index', 'create', 'store']);
    
