<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/menu-produk', [App\Http\Controllers\MenuProdukController::class, 'index'])->name('menu-produk');

Route::get('/menu-transaksi', [App\Http\Controllers\MenuTransaksiController::class, 'index'])->name('menu-transaksi');

Route::get('/menu-laporan', [App\Http\Controllers\MenuLaporanController::class, 'index'])->name('menu-laporan');

