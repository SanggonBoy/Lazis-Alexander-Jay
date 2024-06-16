<?php

use App\Http\Controllers\Api\Alamat;
use App\Http\Controllers\Api\Berita;
use App\Http\Controllers\FidyahController;
use App\Http\Controllers\PembayaranZakatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Models\Order;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|~
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route Donasi
Route::post('/donasi', [OrderController::class, 'donasi']);
Route::post('/midtrans-callback', [OrderController::class, 'callback']);

Route::get('/cari-alamat', [Alamat::class, 'cariAlamat'])->name('api.cari-alamat');

Route::get('/berita', [Berita::class, 'berita']);
