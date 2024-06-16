<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Muzakki; 
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use PharIo\Manifest\Email;// Import model Muzakki

class MuzakkiController extends Controller
{
    public function index()
    {
        // Tampilkan view dengan data muzakki
        return view('muzakki.index', [
            'muzakki' => Muzakki::all()
        ]);
    }
    public function create()
    {
        // Tampilkan view untuk membuat muzakki baru
        return view('muzakki.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $isi = $request->validate([
            'kode_muzakki' => 'required',
            'nama_muzakki' => 'required',
            'no_telp' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        // Simpan data muzakki baru ke database
        Muzakki::create($isi);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('muzakki.index')
            ->with('success', 'Anggota Muzakki baru berhasil ditambahkan.');
    }
    public function show($id)
    {
        // // Ambil data muzakki berdasarkan ID
        // $muzakki = Muzakki::findOrFail($id);

        // // Tampilkan view untuk menampilkan detail muzakki
        // return view('muzakki.show', compact('muzakki'));
    }
    public function edit(Muzakki $muzakki)
    {
        return view('muzakki/edit', [
            'muzakki' => $muzakki
        ]);
    }

    public function update(Request $request, Muzakki $muzakki)
    {
        $user = User::where('email', $muzakki->email)->first();

        $rules = [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'name' => 'required',
            'password' => 'required|min:8',
            'no_telp' => 'required|min:11|max:13',
            'jenis_kelamin' => 'required',
        ];

        $validated = $request->validate($rules);

        $validated['status'] = 'muzakki';
        $validated['qr_token'] = $request->qr_token;

        Muzakki::where('id', $muzakki->id)->update($validated);

        
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'status' => $validated['status'],
            'qr_token' => $request->qr_token,
        ]);

        return redirect()->route('muzakki.index')
            ->with('success', 'Data Muzakki berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $muzakki = Muzakki::findOrFail($id);
        $muzakki->delete();

        $user = User::where('email', $muzakki->email)->first();
        User::where('email', $user->email)->delete();

        return redirect('/muzakki')->with('success', 'Data Muzakki berhasil dihapus.');
    }
}