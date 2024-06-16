<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Login extends Model
{
    use HasFactory;

    protected $table= 'users';
    protected $guarded= ['id'];

    public function attemptQrToken($qrToken) {
        $user = User::where('name', $qrToken)->first();
        if ($user) {
        Auth::login($user);
        return true;
        }
        return false;
        }
}
