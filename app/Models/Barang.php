<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PHPUnit\Framework\MockObject\Stub\ReturnStub;
use Cviebrock\EloquentSluggable\Sluggable;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $guarded = ['id_barang'];

    protected $with = ['kategori'];

    public function kategori()
    {
        return $this->belongsTo(Kategori_barang::class, 'kode_kategori');
    }
}
