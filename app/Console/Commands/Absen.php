<?php

namespace App\Console\Commands;

use App\Models\Absensi;
use App\Models\Amil;
use Illuminate\Console\Command;
use Carbon\Carbon;

class Absen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Absen:absen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Data Absen Perhari';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tanggal = Carbon::now()->format('Y-m-d');

        $existingData = Absensi::whereDate('tanggal', $tanggal)->count();
        if ($existingData > 0) {
            $this->info('Data absen untuk hari ini telah dibuat. Tidak dapat membuat data lagi.');
            return;
        }

        $karyawans = Amil::all();

        foreach ($karyawans as $karyawan) {
            $absence = new Absensi();
            $absence->kode = $karyawan->kode_amil;
            $absence->name = $karyawan->nama_amil;
            $absence->email = $karyawan->email;
            $absence->tanggal = Carbon::now();
            $absence->kehadiran = 'ALPA';
            $absence->save();
        }

        $this->info('Data Absen Terbuat');
    }
}
