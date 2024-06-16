<?php

namespace App\Http\Controllers;

use App\Models\Wakaf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Amil;
use App\Models\User;
use App\Models\Kategori_barang;
use App\Models\Fidyah;
use App\Models\Gaji;
use App\Models\kehadiran;
use App\Models\Order;
use App\Models\Pembayaransedekah;
use App\Models\PembayaranZakat;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PdfController extends Controller
{
    public function backHome()
    {
        return redirect('/');
    }
    public function barangPdf()
    {
        $pdf = Pdf::loadView('pdf-laporan/pdf-barang', [
            'barang' => Barang::all(),
        ]);
        return $pdf->download('Laporan Barang.pdf');
    }
    public function kategoriPdf()
    {
        $pdf = Pdf::loadView('pdf-laporan/pdf-kategori', [
            'kategori' => Kategori_barang::all(),
        ]);
        return $pdf->download('Laporan Kategori.pdf');
    }
    public function amilPdf()
    {
        $pdf = Pdf::loadView('pdf-laporan/pdf-amil', [
            'amil' => Amil::all(),
        ]);
        return $pdf->download('Laporan Amil.pdf');
    }

    public function qrPdf(Request $request)
    {
        $qr_token = $request->input('qr_token');
        $user = User::where('email', $qr_token)->first();
        $pdf = Pdf::loadView('pdf-laporan/pdf-qr', [
            'qr_token' => $user->qr_token,
        ]);
        return $pdf->download('QrLogin.pdf');
    }
    public function qrAbsen(Request $request)
    {
        $created = Carbon::now();
        $waktu = $created->copy()->addMinutes(15);

        $kehadiran = kehadiran::create([
            'qr_code' => $request->input('qr_token'),
            'dibuat' => Carbon::now(),
        ]);

        $pdf = Pdf::loadView('pdf-laporan/pdf-qrAbsen', [
            'qr_token' => $kehadiran->qr_code,
            'dibuat' => $waktu,
        ]);
        return $pdf->download('QrAbsen.pdf');
    }
    public function gajiPdf($kode_amil)
    {
        $bulan = Carbon::now()->month;
        $bulanIndonesia = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ][$bulan];

        $gaji = Gaji::with('amil')->where('kode_amil', $kode_amil)->first();

        $tanggal = Carbon::now()->isoFormat('DD') . " $bulanIndonesia " . Carbon::now()->isoFormat('YYYY');

        if ($gaji) {
            $pdf = Pdf::loadView('pdf-laporan/pdf-gaji', [
                'gaji' => $gaji,
                'periode' => "$bulanIndonesia " . Carbon::now()->isoFormat('YYYY'),
                'tanggal' => Carbon::now()->isoFormat('DD') . " $bulanIndonesia " . Carbon::now()->isoFormat('YYYY'),
            ]);
            return $pdf->download('Slip Gaji - ' . $gaji->amil->kode_amil . '-' . $gaji->nama_amil . '-' . $tanggal .'.pdf');
        }
    }

    public function invoiceZakat($id)
    {
        $order = PembayaranZakat::find($id);
        $pdf = Pdf::loadView('pdf-laporan/pdf-zakat', [
            'm' => $order,
        ]);
        return $pdf->download('Invoice Transaksi - ' . $order->jenis_transaksi . '-' . $order->kode_transaksi . '.pdf');
    }
    public function invoiceSedekah($id)
    {
        $order = Pembayaransedekah::find($id);
        $pdf = Pdf::loadView('pdf-laporan/pdf-sedekah', [
            'm' => $order,
        ]);
        return $pdf->download('Invoice Transaksi - ' . $order->jenis_transaksi . '-' . $order->kode_transaksi . '.pdf');
    }
    public function invoiceFidyah($id)
    {
        $order = Fidyah::find($id);
        $pdf = Pdf::loadView('pdf-laporan/pdf-fidyah', [
            'm' => $order,
        ]);
        return $pdf->download('Invoice Transaksi - ' . $order->jenis_transaksi . '-' . $order->kode_transaksi . '.pdf');
    }
    public function invoiceWakaf($id)
    {
        $order = Wakaf::find($id);
        $pdf = Pdf::loadView('pdf-laporan/pdf-wakaf', [
            'm' => $order,
        ]);
        return $pdf->download('Invoice Transaksi - ' . $order->jenis_transaksi . '-' . $order->kode_transaksi . '.pdf');
    }
}
