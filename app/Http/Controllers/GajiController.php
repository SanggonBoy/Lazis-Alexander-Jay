<?php

// GajiController.php
namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Amil;
use App\Models\Absensi;
use App\Models\Penyerahan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class GajiController extends Controller
{
    public function index()
    {
        $periode = Carbon::now()->isoFormat('MMMM YYYY');
        $gaji = Gaji::with('amil')
            ->whereMonth('periode', Carbon::now()->month)
            ->get();

        $bulan = Carbon::now()->month;
        $bulanPeriode = [
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
        ];

        $dataGaji = [];

        foreach ($gaji as $g) {
            $bulanGaji = Carbon::parse($g->periode)->month;
            $tahunGaji = Carbon::parse($g->periode)->year;
            $dataGaji[] = [
                'bulan' => $bulanPeriode[$bulanGaji],
                'tahun' => $tahunGaji,
                'data' => $g,
            ];
        }

        $periodeGaji = array_map(function ($item) {
            return "{$item['bulan']} {$item['tahun']}";
        }, $dataGaji);

        return view('gaji.view', [
            'gaji' => $gaji,
            'periode' => "{$bulanPeriode[$bulan]} " . Carbon::now()->isoFormat('YYYY'),
            'periode_gaji' => $periodeGaji,
        ]);
    }

    public function dateFilter(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $bulanRequest = Carbon::parse($tanggal)->month;
        $tahunRequest = Carbon::parse($tanggal)->year;

        $gaji = Gaji::with('amil')->whereMonth('periode', $bulanRequest)->whereYear('periode', $tahunRequest)->get();

        $bulanPeriode = [
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
        ];

        $dataGaji = [];
        foreach ($gaji as $g) {
            $bulanGaji = Carbon::parse($g->periode)->month;
            $tahunGaji = Carbon::parse($g->periode)->year;
            $dataGaji[] = [
                'bulan' => $bulanPeriode[$bulanGaji],
                'tahun' => $tahunGaji,
                'data' => $g,
            ];
        }

        $periodeGaji = array_map(function ($item) {
            return "{$item['bulan']} {$item['tahun']}";
        }, $dataGaji);

        return view('gaji.dateFilter', [
            'gaji' => $gaji,
            'periode' => "{$bulanPeriode[$bulanRequest]} {$tahunRequest}",
            'periode_gaji' => $periodeGaji,
        ]);
    }

    public function create()
    {
        $periode = Carbon::now()->isoFormat('MMMM YYYY');
        $gaji = Gaji::whereMonth('periode', Carbon::now()->month)->get();

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

        $amils = Amil::whereNotIn('id', $gaji->pluck('kode_amil'))->get();
        return view('gaji/create', [
            'amils' => $amils,
            'periode' => "$bulanIndonesia " . Carbon::now()->isoFormat('YYYY'),
        ]);
    }

    public function alpa($id)
    {
        
        $jumlahAlpa = Absensi::where('kode_amil', $id)->whereMonth('tanggal', Carbon::now()->month)
        ->where('kehadiran', 'ALPA')
        ->whereYear('tanggal', Carbon::now()->year)
        ->count('kehadiran');

        return response()->json(['jumlah_alpa' => $jumlahAlpa]);
    }

    public function store(Request $request)
    {
        $amil = Amil::find($request->kode_amil);
        if (!$amil) {
            return redirect('/gaji')->with('swal', [
                'title' => 'Penggajian Karyawan',
                'message' => 'Nama Karyawan tidak ditemukan!',
                'status' => 'error',
            ]);
        }

        $request->validate([
            'kode_amil' => 'required|exists:amil,id',
            'jumlah_alpa' => 'required|min:0',
            'bonus' => 'required|min:0',
            'tunjangan' => 'required|min:0',
            'transport' => 'required|min:0',
            'makan' => 'required|min:0',
            'lembur' => 'required|min:0',
        ]);

        $transport = str_replace('.', '', $request->transport);
        $makan = str_replace('.', '', $request->makan);
        $lembur = str_replace('.', '', $request->lembur);
        $bonus = str_replace('.', '', $request->bonus);
        $tunjangan = str_replace('.', '', $request->tunjangan);

        $amil = Amil::find($request->kode_amil);

        $jumlah_alpa = $request->jumlah_alpa;
        $potongan_gaji = $jumlah_alpa * 50000;
        $total_gaji = 5000000;

        Gaji::create([
            'kode_transaksi' => rand(),
            'kode_amil' => $amil->id,
            'nama_amil' => $amil->nama_amil,
            'email' => $amil->email,
            'periode' => Carbon::now()->format('Y/m/d'),
            'total_gaji' => $total_gaji - $potongan_gaji,
            'jumlah_alpa' => $jumlah_alpa,
            'bonus' => $bonus,
            'tunjangan' => $tunjangan,
            'transport' => $transport,
            'makan' => $makan,
            'lembur' => $lembur,
        ]);

        session()->flash('swal', [
            'title' => 'Penggajian Karyawan',
            'message' => 'Penggajian telah berhasil dilakukan!',
            'status' => 'success',
        ]);

        return redirect('/gaji');
    }

    public function show(Gaji $gaji)
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

        return view('gaji/gaji-checking', [
            'gaji' => $gaji,
            'periode' => "$bulanIndonesia " . Carbon::now()->isoFormat('YYYY'),
            'tanggal' => Carbon::now()->isoFormat('DD') . " $bulanIndonesia " . Carbon::now()->isoFormat('YYYY'),
        ]);
    }

    public function cetak($id)
    {
        $gaji = Gaji::with('amil')->where('kode_amil', $id)->first();
        if ($gaji) {
            if (!$gaji->tanggal_dicetak) {
                $gaji->tanggal_dicetak = Carbon::now();
                $gaji->save();
            }

            session()->flash('swal', [
                'title' => 'Penggajian Karyawan',
                'message' => 'Penggajian Telah Berhasil Dicetak!',
                'status' => 'success',
            ]);

            return redirect('/gaji-pdf/' . $gaji->kode_amil);
        }

        session()->flash('swal', [
            'title' => 'Penggajian Karyawan',
            'message' => 'Penggajian Gagal Dicetak!',
            'status' => 'danger',
        ]);

        return redirect('/gaji');
    }

    public function edit(Gaji $gaji)
    {
        $periode = Carbon::now()->isoFormat('MMMM YYYY');
        $gajiModel = Gaji::whereMonth('periode', Carbon::now()->month)->get();

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

        $amils = Amil::whereNotIn('kode_amil', $gajiModel->pluck('kode_amil'))->get();
        return view('gaji/edit', [
            'amils' => $amils,
            'gaji' => $gaji,
            'periode' => "$bulanIndonesia " . Carbon::now()->isoFormat('YYYY'),
            'alpa' => Absensi::where('kode_amil', $gaji->kode_amil)->whereMonth('tanggal', Carbon::now()->month)
            ->where('kehadiran', 'ALPA')
            ->whereYear('tanggal', Carbon::now()->year)
            ->count('kehadiran')
        ]);
    }

    public function update(Request $request, Gaji $gaji)
    {
        $request->validate([
            'kode_amil' => 'required|numeric|max:255',
            'jumlah_alpa' => 'required|integer|min:0',
            'transport' => 'required|numeric|min:0',
            'makan' => 'required|numeric|min:0',
            'lembur' => 'required|numeric|min:0',
            'bonus' => 'required|numeric|min:0',
            'tunjangan' => 'required|numeric|min:0',
        ]);

        $gaji->update([
            'kode_amil' => $request->input('kode_amil'),
            'jumlah_alpa' => $request->input('jumlah_alpa'),
            'transport' => $request->input('transport'),
            'makan' => $request->input('makan'),
            'lembur' => $request->input('lembur'),
            'bonus' => $request->input('bonus'),
            'tunjangan' => $request->input('tunjangan'),
        ]);

        session()->flash('swal', [
            'title' => 'Edit Data',
            'message' => 'Data telah berhasil diubah!',
            'status' => 'success',
        ]);

        return redirect('/gaji');
    }

    public function destroy($id)
    {
        $gaji = Gaji::findOrFail($id);
        $gaji->delete();
        return redirect('/gaji')->with('success', 'Data Berhasil Dihapus.');
    }
}
