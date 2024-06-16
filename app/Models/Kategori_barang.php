<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori_barang extends Model
{
    use HasFactory;

    protected $table = 'kategori_barang';

    protected $guarded = ['id'];

    // public function barang()
    // {
    //     return $this->hasMany(Barang::class);
    // }
}
