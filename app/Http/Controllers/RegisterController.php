<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Register;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreRegisterRequest;
use App\Http\Requests\UpdateRegisterRequest;
use App\Models\Muzakki;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:255',
            'status' => 'required',
            'qr_token' => 'required',
            'no_telp' => 'required|max:13',
            'jenis_kelamin' => 'required'
        ]);

        $data = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'status' => $validatedData['status'],
            'qr_token' => $validatedData['qr_token'],
            'no_telp' => $validatedData['no_telp'],
            'jenis_kelamin' => $validatedData['jenis_kelamin']
        ];

        Muzakki::create($data);

        $dataUser = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'status' => $validatedData['status'],
            'qr_token' => $validatedData['qr_token']
        ];

        $dataUser['password'] = Hash::make($dataUser['password']);

        User::create($dataUser);

        return redirect('/')->with('success', 'Register is Successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegisterRequest $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Register $register)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Register $register)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegisterRequest $request, Register $register)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Register $register)
    {
        //
    }
}
