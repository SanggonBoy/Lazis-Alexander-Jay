<?php

namespace App\Http\Controllers;

use App\Models\Mustahik;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMustahikRequest;
use App\Http\Requests\UpdateMustahikRequest;

class MustahikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mustahik/view', [
            'mustahik' => Mustahik::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mustahik/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = $request->validate([
            'nama_mustahik' => 'required|max:255',
            'no_telp' => 'required|min:11|max:13',
            'alamat' => 'required|max:255',
            'jenis_kelamin' => 'required',
        ]);

        $name = $rules['nama_mustahik'];
        $firstName = explode(' ', $name)[0];
        $lastName = explode(' ', $name)[1] ?? $firstName;

        $initial = strtoupper(substr($firstName, 0, 2));
        $initial .= strtoupper(substr($lastName, 0, 1));

        $initial = $initial . '-' . rand();

        $rules = [
            'kode_mustahik' => $initial,
            'nama_mustahik' => $rules['nama_mustahik'],
            'no_telp' => $rules['no_telp'],
            'alamat' => $rules['alamat'],
            'jenis_kelamin' => $rules['jenis_kelamin'],
        ];

        // $kd = 'MTHK-' . $rules['id_mustahik'];

        // if ($kd === 'unique:mustahik,id_mustahik')
        // {
        //     $validate = [
        //         'id_mustahik' => $kd,
        //         'nama_mustahik' => $rules['nama_mustahik'],
        //         'no_telp' => $rules['no_telp'],
        //         'alamat' => $rules['alamat'],
        //         'jenis_kelamin' => $rules['jenis_kelamin']
        //     ];

        //     Mustahik::create($validate);

        //     return redirect('/mustahik/create');
        // }
        Mustahik::create($rules);

        return redirect('/mustahik');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mustahik $mustahik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mustahik $mustahik)
    {
        return view('/mustahik/edit', [
            'a' => $mustahik,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mustahik $mustahik)
    {
        $rules = $request->validate([
            'kode_mustahik' => 'required|max:255',
            'nama_mustahik' => 'required|max:255',
            'no_telp' => 'required|max:13',
            'alamat' => 'required|max:255',
            'jenis_kelamin' => 'required',
        ]);

        if ($request->kode_mustahik != $mustahik->kode_mustahik) {
            $rules['kode_mustahik'] = 'unique';
        }

        Mustahik::where('id', $mustahik->id)->update($rules);

        return redirect('/mustahik');
        // return dd($rules);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Mustahik::destroy($id);
        return redirect('/mustahik');
    }
}
