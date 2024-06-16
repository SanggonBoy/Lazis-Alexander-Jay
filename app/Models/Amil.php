<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Amil extends Model
{
    use HasFactory;

    protected $table = 'amil';

    protected $guarded = ['id'];

    protected $with = ['absensi', 'gaji'];

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'kode_amil', 'id');
    }

    public function gaji()
    {
        return $this->hasMany(Gaji::class, 'kode_amil', 'id');
    }
}
