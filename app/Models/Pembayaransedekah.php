<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
// use App\Models\BadanAmal;


class Pembayaransedekah extends Model
{
    use HasFactory;
    protected $table = 'pembayaran_sedekah';

    protected $guarded = ['id'];

    public static function getPemberi(){
        $user = auth()->user();
        $namaPembayar = $user->nama;
        $email = $user->email;
        return [
            'nama_pemberi' => $namaPembayar,
            'email' => $email
        ];
    }

    // public static function getBadanAmal(){
    //     $sql = "SELECT * FROM badan_amal";
    //     $badanAmal = DB::selectOne($sql);
    //     return $badanAmal;
    // }

    // public static function getBadanAmalId($id){
    //     $sql = "SELECT * FROM badan_amal WHERE id = $id";
    //     $badanAmal = DB::selectOne($sql);
    //     return $badanAmal;
    // }

    // public function badan_amal()
    // {
    //     return $this->belongsTo(BadanAmal::class, 'badan_amal');
    // }
    
    
}
