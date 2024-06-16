<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Http\Requests\StorePengaduanRequest;
use App\Http\Requests\UpdatePengaduanRequest;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pengaduan/view", [
            'pengaduan' => Pengaduan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'subjek' => 'required',
            'pesan' => 'required',
        ]);
        Pengaduan::create($validated);

        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePengaduanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengaduanRequest $request, Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->delete();
        return redirect('/pengaduan-list');
    }
}
