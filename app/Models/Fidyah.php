<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Fidyah extends Model
{
    use HasFactory;
    protected $table = 'fidyah';
    protected $guarded = ['id'];
}
