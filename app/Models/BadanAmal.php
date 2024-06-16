<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BadanAmal extends Model
{
    use HasFactory;

    protected $table = 'badan_amal';

    protected $fillable = [
        'nama_badan'
    ];

    public static function getBadanAmal(){
        $badanAmal = DB::table('badan_amal')->get();
        return $badanAmal;
    }

}
