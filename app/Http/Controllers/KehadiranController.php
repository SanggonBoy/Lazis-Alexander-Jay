<?php

namespace App\Http\Controllers;

use App\Models\kehadiran;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use App\Http\Requests\StorekehadiranRequest;
use App\Http\Requests\UpdatekehadiranRequest;
use App\Models\Absensi;
use App\Models\Amil;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class KehadiranController extends Controller
{
    public function index()
    {
        $sekarang = Carbon::now()->format('Y-m-d');
        $kehadiran = Absensi::with('amil')->whereDate('tanggal', $sekarang)->paginate(10);

        return view('kehadiran/index', [
            'data' => $kehadiran,
            'qrAbsen' => Str::random(60),
        ]);
    }

    public function createQRCode(Request $request)
    {
        $created = Carbon::now();

        kehadiran::create([
            'qr_code' => $request->qr_token,
            'dibuat' => $created,
        ]);
    }

    public function scanQRCode(Request $request)
    {
        return view('kehadiran/absenQr');
    }

    public function AttendanceCheck(Request $request)
    {
        $inputcode = $request->input('result');

        $attendance = kehadiran::where('qr_code', $inputcode)->where('created_at', '>', Carbon::now()->subMinutes(15))->first();

        if ($attendance) {
            $karyawan = Auth::user();

            if ($karyawan) {
                if ($karyawan->status !== 'amil') {
                    return response()->json(['valid' => false, 'message' => 'Hanya Karyawan Yang Dapat Melakukan Scan QrCode.']);
                }

                $status = ['kehadiran' => 'HADIR'];
                Absensi::where('email', $karyawan->email)
                    ->whereDate('tanggal', Carbon::now())
                    ->update($status);

                return response()->json(['valid' => true]);
            } else {
                return response()->json(['valid' => false, 'message' => 'Karyawan Tidak Ditemukan.']);
            }
        } else {
            return response()->json(['valid' => false, 'message' => 'QR Code Tidak Valid atau Sudah Kadaluwarsa.']);
        }
    }

    public function dateFilter(Request $request)
    {
        $tanggal = Absensi::whereDate('tanggal', $request->tanggal)->get();

        return view('/kehadiran/index', [
            'data' => $tanggal,
            'qrAbsen' => Str::random(60),
        ]);
    }
    public function create()
    {
        $kehadiran = Absensi::whereDate('tanggal', Carbon::now())->get();

        return view('kehadiran/create', [
            'data' => Amil::whereNotIn('id', $kehadiran->pluck('kode_amil'))->get(),
        ]);
    }
    public function store(Request $request)
    {
        $tanggal = Carbon::now()->format('Y-m-d');

        foreach ($request->kode_amil as $id => $kode_amil) {
            $cekAbsensi = Absensi::whereDate('tanggal', $tanggal)->where('kode_amil', $kode_amil)->first();

            if ($cekAbsensi) {
                return back()->with('error', 'Data kehadiran untuk hari ini sudah ada ');
            } else {
                $amil = Amil::find($id);
                if ($amil) {
                    Absensi::create([
                        'kode_amil' => $kode_amil,
                        'name' => $request->nama_amil[$id],
                        'email' => $request->email[$id],
                        'kehadiran' => $request->kehadiran[$id],
                        'tanggal' => $tanggal,
                    ]);
                }
            }
        }

        session()->flash('swal', [
            'title' => 'Tambah Data',
            'message' => 'Data telah berhasil ditambah!',
            'status' => 'success',
        ]);

        return redirect('/kehadiran');
    }

    /**
     * Display the specified resource.
     */
    public function show(kehadiran $kehadiran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kehadiran $kehadiran)
    {
        // $sekarang = Carbon::now()->format('Y-m-d');
        // $kehadiran = Absensi::whereDate('tanggal', $sekarang)->get();

        // return view('kehadiran/edit', [
        //     'data' => $kehadiran
        // ]);
    }
    public function editAbsen(kehadiran $kehadiran)
    {
        $sekarang = Carbon::now()->format('Y-m-d');
        $kehadiran = Absensi::with('amil')->whereDate('tanggal', $sekarang)->get();

        return view('kehadiran/ubah', [
            'data' => $kehadiran,
        ]);
    }
    public function update(Request $request, kehadiran $kehadiran, Absensi $absensi)
    {
        // foreach ($request->kode as $kode_amil) {
        //     $amil = Absensi::where('kode_amil', $kode_amil)->whereDate('tanggal', Carbon::now()->format('Y-m-d'))->first();
        //     if ($amil) {
        //         $absensi->kode = $request->kode_amil[$kode_amil];
        //         $absensi->name = $request->nama_amil[$kode_amil];
        //         $absensi->email = $request->email[$kode_amil];
        //         $absensi->kehadiran = $request->kehadiran[$kode_amil];
        //         $absensi->tanggal = Carbon::now();
        //         $absensi->save();
        //     }
        // }
    }
    public function ubahAbsen(Request $request, Kehadiran $kehadiran)
    {
        foreach ($request->kode as $kode_amil => $kode_value) {
            // Find the existing attendance record
            $amil = Absensi::where('kode_amil', $kode_amil)
                ->whereDate('tanggal', Carbon::now()->format('Y-m-d'))
                ->first();
    
            if ($amil) {
                $amil->kode_amil = $kode_value;
                $amil->name = $request->name[$kode_amil] ?? $amil->name;
                $amil->email = $request->email[$kode_amil] ?? $amil->email;
                $amil->kehadiran = $request->kehadiran[$kode_amil] ?? $amil->kehadiran;
                $amil->tanggal = Carbon::now();
                $amil->save();
            }
        }
    
        session()->flash('swal', [
            'title' => 'Ubah Data',
            'message' => 'Data telah berhasil diubah!',
            'status' => 'success',
        ]);
    
        return redirect('/kehadiran');
    }
    public function destroy(kehadiran $kehadiran)
    {
        //
    }
}
