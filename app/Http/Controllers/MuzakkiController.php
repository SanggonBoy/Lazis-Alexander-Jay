<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Muzakki; // Import model Muzakki

class MuzakkiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Tampilkan view dengan data muzakki
        return view('muzakki.index', [
            'muzakki' => Muzakki::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Tampilkan view untuk membuat muzakki baru
        return view('muzakki.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // // Ambil data muzakki berdasarkan ID
        // $muzakki = Muzakki::findOrFail($id);

        // // Tampilkan view untuk menampilkan detail muzakki
        // return view('muzakki.show', compact('muzakki'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Muzakki $muzakki)
    {
        return view('muzakki/edit', [
            'muzakki' => $muzakki
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Muzakki $muzakki)
    {
        $isi = $request->validate([
            'kode_muzakki' => 'required',
            'nama_muzakki' => 'required',
            'no_telp' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        Muzakki::where('id', $muzakki->id)
        ->update($isi);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('muzakki.index')
            ->with('success', 'Data Muzakki berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Hapus data muzakki berdasarkan ID
        $muzakki = Muzakki::findOrFail($id);
        $muzakki->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('muzakki.index')
            ->with('success', 'Data Muzakki berhasil dihapus.');
    }
}