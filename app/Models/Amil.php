<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Add this line to import DB facade

class Amil extends Model
{
    use HasFactory;

    protected $table = 'amil';

    protected $fillable = ['kode_amil','nama_amil','no_telp','alamat','jenis_kelamin'];

    public static function getKodeAmil(){
        $amil = DB::table('amil')->get();
        return $amil;
    }
}
