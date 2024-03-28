<?php

namespace App\Http\Controllers;

use App\Models\Amil;
use App\Http\Requests\StoreAmilRequest;
use App\Http\Requests\UpdateAmilRequest;

use Illuminate\Foundation\Http\FormRequest;

class AmilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $amil = amil::all();
        return view(
            'amil.index',
            [
                'amil' => $amil
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Tampilkan view untuk membuat amil baru
        return view(
            'amil/create',
            [
                'kode_amil' => Amil::getKodeAmil()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreAmilRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAmilRequest $request)
    {
        // Validasi data yang diterima dari request
        $validated = $request->validate([
            'kode_amil' => 'required',
            'nama_amil' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        // Simpan data amil baru ke database
        Amil::create($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('amil.index')
            ->with('success', 'Amil berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Amil $amil)
    {
        // // Ambil data amil berdasarkan ID
        // $amil = Amil::findOrFail($id);

        // // Tampilkan view untuk menampilkan detail amil
        // return view('amil.show', compact('amil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Amil $amil)
    {
        return view('amil.edit', compact('amil'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateAmilRequest  $request
     * @param  \App\Models\Coa  $coa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAmilRequest $request, Amil $amil)
    {
        $validated = $request->validate([
            'kode_amil' => 'required',
            'nama_amil' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        $amil->update($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('amil.index')
            ->with('success', 'Data Amil berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Amil  $amil
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Hapus data amil berdasarkan ID
        $amil = Amil::findOrFail($id);
        $amil->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('amil.index')
            ->with('success', 'Data Amil berhasil dihapus.');
    }
}
