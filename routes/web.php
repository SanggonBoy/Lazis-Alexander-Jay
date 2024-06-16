<?php

use GuzzleHttp\Middleware;
use App\Http\Controllers\Guest;
use App\Http\Controllers\qrlogin;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AmilController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MuzakkiController;
use App\Http\Controllers\MustahikController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\PembayaranZakatController;
use App\Http\Controllers\PembayaransedekahController;
use App\Http\Controllers\PenyerahanController;
use App\Http\Controllers\GajiController; // Correct namespace
use App\Http\Controllers\FidyahController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\WakafController;

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
Route::post('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'destroy']);

// GeneratePdf
Route::get('/barang-pdf', [PdfController::class, 'barangPdf'])->middleware('status');
Route::get('/amil-pdf', [PdfController::class, 'amilPdf'])->middleware('status');
Route::get('/kategori-pdf', [PdfController::class, 'kategoriPdf'])->middleware('status');
Route::post('/qr-pdf', [PdfController::class, 'qrPdf']);
Route::post('/QrAbsen', [PdfController::class, 'qrAbsen'])->middleware('admin');
Route::get('/gaji-pdf/{id}', [PdfController::class, 'gajiPdf'])->middleware('status');
Route::get('/invoiceZakat/{id}', [PdfController::class, 'invoiceZakat'])->middleware('auth');
Route::get('/invoiceSedekah/{id}', [PdfController::class, 'invoiceSedekah'])->middleware('auth');
Route::get('/invoiceFidyah/{id}', [PdfController::class, 'invoiceFidyah'])->middleware('auth');
Route::get('/invoiceWakaf/{id}', [PdfController::class, 'invoiceWakaf'])->middleware('auth');


// Route Barang
Route::get('/barang', [BarangController::class, 'index'])->middleware('auth');
Route::resource('/barang', BarangController::class)->middleware('auth');
Route::get('/barang/destroy/{id}', [App\Http\Controllers\BarangController::class, 'destroy'])->middleware(['status']);

// Route Kategori
Route::get('/kategori', [KategoriBarangController::class, 'index'])->middleware('auth');
Route::resource('/kategori', KategoriBarangController::class)->middleware('auth');

// Route Amil 
Route::get('/amil', [AmilController::class, 'index'])->middleware('admin');
Route::resource('/amil', AmilController::class)->middleware(['admin']);
Route::get('/amil/destroy/{id}', [App\Http\Controllers\AmilController::class, 'destroy'])->middleware(['admin']);

// Route Coa
Route::resource('/coa', CoaController::class)->middleware(['auth']);
Route::get('/coa/destroy/{id}', [App\Http\Controllers\CoaController::class, 'destroy'])->middleware(['auth']);

// Route Muzakki
Route::get('/muzakkiUser', [MuzakkiController::class, 'index'])->middleware('status');
Route::get('/muzakki/destroy/{id}', [MuzakkiController::class, 'destroy'])->middleware('status');
Route::resource('/muzakki', MuzakkiController::class)->middleware('admin');

// Route Mustahik
Route::get('/mustahik', [MustahikController::class, 'index'])->middleware('status');
Route::resource('/mustahik', MustahikController::class)->middleware('status');
Route::get('/mustahik/destroy/{id}', [MustahikController::class, 'destroy'])->middleware('status');

// Route Transaksi
Route::get('/checking-transaction', [TransaksiController::class, 'index'])->middleware('status');
Route::get('/transaksi', [OrderController::class, 'index'])->middleware('auth');
Route::resource('/transaksi', OrderController::class)->middleware('auth');

// Route Pengaduan
Route::get('/pengaduan-list', [PengaduanController::class, 'index'])->middleware('status');
Route::get('/pengaduan/destroy/{id}', [App\Http\Controllers\PengaduanController::class, 'destroy'])->middleware(['status']);
Route::resource('/pengaduan', PengaduanController::class);

Route::get('/transaksi/destroy/{id}', [TransaksiController::class, 'destroy'])->middleware(['status']);
Route::post('/search-duplicate-transactions', [TransaksiController::class, 'search'])->middleware('status');
Route::post('/filter-transactions', [TransaksiController::class, 'filter'])->middleware('status');
Route::get('/copyToClipboard', [TransaksiController::class, 'copyToClipboard'])->middleware('status');
Route::post('/donasi', [OrderController::class, 'Zakat'])->middleware('auth');
Route::get('/invoice/{id}', [OrderController::class, 'invoice'])->middleware('auth');
Route::post('/delete-all', [TransaksiController::class, 'deleteAll'])->name('deleteAll')->middleware('status');


// Route Pembayaran Zakat
Route::resource('/zakat', PembayaranZakatController::class)->middleware(['auth']);
Route::post('/zakatPay', [PembayaranZakatController::class, 'Zakat'])->middleware('auth');
Route::get('/zakat/destroy/{id}', [App\Http\Controllers\PembayaranZakatController::class, 'destroy'])->middleware(['auth']);

// Route Pembayaran Sedekah
Route::resource('/sedekah', PembayaransedekahController::class)->middleware(['auth']);
Route::resource('pembayaransedekah', PembayaransedekahController::class);
Route::post('/sedekahPay', [App\Http\Controllers\PembayaransedekahController::class, 'Sedekah'])->middleware(['auth']);
Route::get('/sedekah/destroy/{id}', [App\Http\Controllers\PembayaransedekahController::class, 'destroy'])->middleware(['auth']);

// Route Penyerahan
Route::resource('/penyerahan', PenyerahanController::class)->middleware(['status']);
Route::get('/penyerahan/destroy/{id}', [App\Http\Controllers\PenyerahanController::class, 'destroy'])->middleware(['status']);

// Route Penggajian
Route::resource('/gaji', GajiController::class)->middleware(['admin']);
Route::get('/cetak-pdf/{id}', [App\Http\Controllers\GajiController::class, 'cetak'])->middleware(['admin']);
Route::get('/gaji/alpa/{id}', [App\Http\Controllers\GajiController::class, 'alpa'])->middleware(['admin']);
Route::post('/dateFilterGaji', [App\Http\Controllers\GajiController::class, 'dateFilter'])->middleware(['admin']);
Route::get('/gaji/destroy/{id}', [App\Http\Controllers\GajiController::class, 'destroy'])->middleware(['admin']);

// Route QrLogin
Route::get('/QrLogin', [qrlogin::class, 'qrlogin'])->middleware('guest');
Route::post('/QrValidasi', [qrlogin::class, 'qrvalidasi']);
Route::get('/QrDownload', [qrlogin::class, 'qrdownload'])->middleware('auth');

// Route Pembayaran Fidyah
Route::resource('/fidyah', FidyahController::class)->middleware(['auth']);
Route::post('/fidyahPay', [App\Http\Controllers\FidyahController::class, 'Fidyah'])->middleware(['auth']);
Route::get('/fidyah/destroy/{id}', [App\Http\Controllers\FidyahController::class, 'destroy'])->middleware(['auth']);

// Route Pembayaran Fidyah
Route::resource('/wakaf', WakafController::class)->middleware(['auth']);
Route::post('/wakafPay', [App\Http\Controllers\WakafController::class, 'Wakaf'])->middleware(['auth']);
Route::get('/wakaf/destroy/{id}', [App\Http\Controllers\WakafController::class, 'destroy'])->middleware(['auth']);

//Route Kehadiran
Route::resource('/kehadiran', KehadiranController::class)->middleware('admin');
Route::post('/CreateQrAbsen', [KehadiranController::class, 'createQRCode'])->middleware('admin');
Route::get('/AttendanceQrAbsen', [KehadiranController::class, 'scanQRCode'])->middleware('status');
Route::get('/editAbsen', [KehadiranController::class, 'editAbsen'])->middleware('admin');
Route::put('/ubahAbsen', [KehadiranController::class, 'ubahAbsen'])->middleware('admin');
Route::post('/AttendanceCheck', [KehadiranController::class, 'AttendanceCheck'])->middleware('status');
Route::post('/dateFilter', [KehadiranController::class, 'dateFilter'])->middleware('admin');