<?php

use GuzzleHttp\Middleware;
use App\Http\Controllers\Guest;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AmilController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MuzakkiController;
use App\Http\Controllers\MustahikController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KategoriBarangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Guest::class, 'index']);

// Route Dashboard
Route::get('/godFrey', [Dashboard::class, 'index'])->middleware('auth');

// Route Login
Route::get('/joinUs', [LoginController::class, 'index'])->middleware('guest')->name('login');
// Route::get('/login', [LoginController::class, 'index']);
Route::post('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'destroy']);

//GeneratePdf
Route::get('/barang-pdf', [PdfController::class, 'barangPdf'])->middleware('status');
Route::get('/amil-pdf', [PdfController::class, 'amilPdf'])->middleware('status');
Route::get('/kategori-pdf', [PdfController::class, 'kategoriPdf'])->middleware('status');

// Route Barang
Route::get('/barang', [BarangController::class, 'index'])->middleware('auth');
Route::resource('/barang', BarangController::class)->middleware('auth');
Route::get('/barang/destroy/{id}', [App\Http\Controllers\BarangController::class, 'destroy'])->middleware(['auth']);


// Route Kategori
Route::get('/kategori', [KategoriBarangController::class, 'index'])->middleware('auth');
Route::resource('/kategori', KategoriBarangController::class)->middleware('auth');

// Route amil 
Route::resource('/amil', AmilController::class)->middleware(['auth']);
Route::get('/amil/destroy/{id}', [App\Http\Controllers\AmilController::class, 'destroy'])->middleware(['auth']);

// Route Coa
Route::resource('/coa', CoaController::class)->middleware(['auth']);
Route::get('/coa/destroy/{id}', [App\Http\Controllers\CoaController::class, 'destroy'])->middleware(['auth']);

// Route Muzakki
Route::get('/muzakki', [MuzakkiController::class, 'index'])->middleware('auth');
Route::resource('/muzakki', MuzakkiController::class)->middleware('auth');

// Route Mustahik
Route::get('/mustahik', [MustahikController::class, 'index'])->middleware('auth');
Route::resource('/mustahik', MustahikController::class)->middleware('auth');

// Route Transaksi
Route::get('/transaksi', [TransaksiController::class, 'index'])->middleware('auth');
Route::resource('/transaksi', TransaksiController::class)->middleware('auth');