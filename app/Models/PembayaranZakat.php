<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class PembayaranZakat extends Model
{
    use HasFactory;
    protected $table = 'pembayaran_zakat';
    protected $guarded = ['id'];
    
    public static function getMuzakki(){
        $sql = "SELECT * FROM muzakki";
        $muzakki = DB::selectOne($sql);
        return $muzakki;
    }
    public static function getMuzakkiId($id) {
        $sql = "SELECT * FROM muzakki WHERE id = $id";
        $muzakki = DB::selectOne($sql);
        return $muzakki;
    }
    public function muzakki()
    {
        return $this->belongsTo(Muzakki::class, 'nama_muzakki'); // Assuming 'nama_muzakki' is the foreign key
    }

}
