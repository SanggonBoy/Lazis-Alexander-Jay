<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'gaji';
    protected $guarded = ['id'];

    public function amil()
    {
        return $this->belongsTo(Amil::class, 'kode_amil', 'id');
    }
}
