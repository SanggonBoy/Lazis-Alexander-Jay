<?php

namespace App\Http\Controllers;
use App\Charts\OrderCharts;
use App\Models\Fidyah;
use App\Models\Order;
use App\Models\Pembayaransedekah;
use App\Models\PembayaranZakat;
use App\Models\User;
use App\Models\Wakaf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function index(OrderCharts $order)
    {
        $rekapPerbulanMal = PembayaranZakat::selectRaw('MONTH(tanggal_pembayaran) as bulan, YEAR(tanggal_pembayaran) as tahun, sum(nominal) as total')->where('jenis_transaksi', 'Zakat Mal')->where('status_pembayaran', 'berhasil')->groupBy('bulan', 'tahun')->get();

        $rekapPerbulanFitrah = PembayaranZakat::selectRaw('MONTH(tanggal_pembayaran) as bulan, YEAR(tanggal_pembayaran) as tahun, sum(nominal) as total')->where('jenis_transaksi', 'Zakat Fitrah')->where('status_pembayaran', 'berhasil')->groupBy('bulan', 'tahun')->get();

        $rekapPerbulanFidyah = Fidyah::selectRaw('MONTH(tanggal_pembayaran) as bulan, YEAR(tanggal_pembayaran) as tahun, sum(nominal) as total')->where('status_pembayaran', 'berhasil')->groupBy('bulan', 'tahun')->get();

        $rekapPerbulanWakaf = Wakaf::selectRaw('MONTH(tanggal_pembayaran) as bulan, YEAR(tanggal_pembayaran) as tahun, sum(nominal) as total')->where('status_pembayaran', 'berhasil')->groupBy('bulan', 'tahun')->get();

        $rekapPerbulanSedekah = Pembayaransedekah::selectRaw('MONTH(tanggal_pembayaran) as bulan, YEAR(tanggal_pembayaran) as tahun, sum(nominal) as total')->where('status_pembayaran', 'berhasil')->groupBy('bulan', 'tahun')->get();

        $result = Order::select('kode_transaksi', DB::raw('count(*) as total'))->groupBy('kode_transaksi')->havingRaw('total > 1')->get();

        if ($result->isNotEmpty()) {
            connectify('error', 'Transaksi', 'Ada transaksi yang terduplikat');
        } else {
            connectify('success', 'Transaksi', 'Tidak ditemukan transaksi terduplikat');
        }
        return view('dashboard.home', [
            'order' => $order->build(),
            'mal' => $rekapPerbulanMal,
            'fitrah' => $rekapPerbulanFitrah,
            'sedekah' => $rekapPerbulanSedekah,
            'wakaf' => $rekapPerbulanWakaf,
            'fidyah' => $rekapPerbulanFidyah,
        ]);
    }
}
