<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Add this line to import DB facade

class Coa extends Model
{
    use HasFactory;

    protected $table = 'coa';

    protected $fillable = ['kode_akun','nama_akun','header_akun'];

    public static function getKodeCoa(){
        $coa = DB::table('coa')->get();
        return $coa;
    }
}
