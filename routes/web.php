<?php

use App\Http\Controllers\MenuUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\MenuProdukController;
use App\Http\Controllers\MenuLaporanController;
use App\Http\Controllers\MenuTransaksiController;
 
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/menu-userpelanggan', MenuUser::class);

Route::put('/password-reset/{id}', [MenuUser::class, 'reset_password'] )->name('password-reset');

Route::resource('/password', PasswordController::class);

Route::resource('/menu-produk', MenuProdukController::class);

Route::resource('/menu-transaksi', MenuTransaksiController::class); 

Route::resource('/menu-laporan', MenuLaporanController::class);