<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Muzakki extends Model
{
    
    use HasFactory;
    protected $table = 'muzakki';
    // list kolom yang bisa diisi
    protected $guarded = ['id'];
}
