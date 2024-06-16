<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\UpdateLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.combine', [
            'qr_token' => Str::random(60)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($validated) && (auth()->user()->status !== 'admin' && auth()->user()->status !== 'amil') ) {
            $request->session()->regenerate();
 
            return redirect()->intended('/godFrey');
        }
 
        return back()->with('loginError', 'Login Failed!');
    }

    public function qrlogin()
    {
        return view('auth/qr', [
            'user' => User::first()
        ]);
    }

    public function qrvalidasi(Request $request)
    {
        return response()->json(['message' => 'Data berhasil diproses']);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoginRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoginRequest $request, Login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect('/');
    }
}
