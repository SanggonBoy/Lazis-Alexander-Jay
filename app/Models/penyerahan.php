<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Penyerahan extends Model
{
    use HasFactory;
    protected $table = 'penyerahan';
    protected $fillable = ['nama_amil', 'nama_mustahik', 'jenis_zakat', 'jumlah', 'tanggal'];

    // Define the relationship with the Amil model
    public function amil()
    {
        return $this->belongsTo(Amil::class, 'nama_amil', 'id');
    }

    // Define the relationship with the Mustahik model
    public function mustahik()
    {
        return $this->belongsTo(Mustahik::class, 'nama_mustahik', 'id');
    }

    public static function getAmil()
    {
        $sql = "SELECT id, nama_amil FROM amil";
        $amil = DB::select($sql);
        return $amil;
    }
    
    public static function getMustahik()
    {
        $sql = "SELECT id, nama_mustahik FROM mustahik";
        $mustahik = DB::select($sql);
        return $mustahik;
    }
}

