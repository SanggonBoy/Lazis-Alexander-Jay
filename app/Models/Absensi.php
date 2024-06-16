<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $guarded = ['id'];

    public function amil()
    {
        return $this->belongsTo(Amil::class, 'kode_amil', 'id');
    }
}
