<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Login;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Http\Request;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Encoder\Encoder;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class qrlogin extends Controller
{
    public function qrlogin(User $user)
    {
        return view('auth/qr', [
            'user' => User::class,
        ]);
    }

    public function qrvalidasi(Request $request)
    {
        $qr_token['qr_token'] = $request->input('result');

        $user = User::where('qr_token', $qr_token)->get();
        foreach ($user as $users) {
            if ($users) {
                Auth::login($users);
                $request->session()->regenerate();
                return redirect()->intended('/godFrey');
            }
        }
        return redirect('/joinUs')->with('loginError', 'Login Failed!');
    }

    public function qrdownload()
    {
        $file_path = $file_name = 'nama_file.txt'; // Ganti dengan nama file yang diinginkan

        return response()->download($file_path, $file_name);
    }

    public function downloadQrCode()
    {
    }
}
