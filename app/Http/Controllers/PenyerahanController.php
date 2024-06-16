<?php

namespace App\Http\Controllers;

use App\Models\penyerahan;
use App\Http\Requests\StorepenyerahanRequest;
use App\Http\Requests\UpdatepenyerahanRequest;
use Illuminate\Http\Request;

class PenyerahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load 'amil' and 'mustahik' relationships and sort by 'tanggal' in ascending order
        $penyerahan = Penyerahan::with('amil', 'mustahik')->orderBy('tanggal', 'asc')->get();
        return view('penyerahan.view', compact('penyerahan'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $amil = penyerahan::getAmil();
        $mustahik = penyerahan::getMustahik();
        return view('penyerahan.create', compact('amil', 'mustahik'));
        // $jenis_zakat = penyerahan::getJenisZakat();
        // return view('penyerahan.create', compact('amil', 'mustahik', 'jenis_zakat'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Remove commas from the 'jumlah' field
        $request['jumlah'] = str_replace(',', '', $request->input('jumlah'));

        $validatedData = $request->validate([
            'nama_amil' => 'required',
            'nama_mustahik' => 'required',
            'jenis_zakat' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal_pembayaran' => 'required|date'
        ]);

        // Map the form field to the correct database field
        $validatedData['tanggal'] = $validatedData['tanggal_pembayaran'];
        unset($validatedData['tanggal_pembayaran']);

        penyerahan::create($validatedData);

        return redirect('/transaksi')->with('success', 'Data Berhasil Ditambahkan.');
    }




    /**
     * Display the specified resource.
     */
    public function show(penyerahan $penyerahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(penyerahan $penyerahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepenyerahanRequest $request, penyerahan $penyerahan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penyerahan = Penyerahan::findOrFail($id);
        $penyerahan->delete();
        return redirect('/transaksi')->with('success', 'Data Berhasil Dihapus.');
    }
}
