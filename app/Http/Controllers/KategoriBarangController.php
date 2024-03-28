<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori_barang;
use App\Http\Requests\StoreKategori_barangRequest;
use App\Http\Requests\UpdateKategori_barangRequest;

class KategoriBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kategoriBarang/view', [
            'kategori' => Kategori_barang::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategoriBarang/tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = $request->validate([
            'kode_kategori' => 'required|unique:kategori_barang',
            'kategori' => 'required|unique:kategori_barang'
        ]);

        Kategori_barang::create($rules);

        return redirect('/kategori/create');
    }   

    /**
     * Display the specified resource.
     */
    public function show(Kategori_barang $kategori_barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori_barang $kategori_barang)
    {
        // return view('/kategoriBarang/edit', [
        //     'kategori' => $kategori_barang
        // ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategori_barangRequest $request, Kategori_barang $kategori_barang)
    {
        // $rules = $request->validate([
        //     'kode_kategori' => 'required|unique:kategori_barang',
        //     'kategori' => 'required|unique:kategori_barang'
        // ]);

        // $kgr = 'KGR-'.$rules['kode_kategori'];

        // $validated = [
        //     'kode_kategori' => $kgr,
        //     'kategori'=> $rules['kategori']
        // ];

        // return dd($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori_barang $kategori_barang)
    {
        // Kategori_barang::destroy($kategori_barang->id);
        // return redirect('/kategori');
    }
}
