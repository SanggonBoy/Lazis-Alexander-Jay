<?php

namespace App\Http\Controllers;

use App\Models\Amil;
use App\Models\User;
use App\Http\Requests\StoreAmilRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateAmilRequest;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AmilController extends Controller
{
    public function index()
    {
        return view('amil/index', [
            'amil' => Amil::all(),
        ]);
    }
    public function create()
    {
        return view('amil/create', [
            'amil' => Amil::all(),
            'qr_token' => Str::random(60),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users,email',
            'nama_amil' => 'required',
            'password' => 'required|min:8',
            'no_telp' => 'required|max:13|min:11',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'qr_token' => 'required',
        ]);

        $name = $validated['nama_amil'];
        $firstName = explode(' ', $name)[0];
        $lastName = explode(' ', $name)[1] ?? $firstName;

        $initial = strtoupper(substr($firstName, 0, 2));
        $initial .= strtoupper(substr($lastName, 0, 1));

        $initial = $initial . '-' . rand();

        $validated = [
            'kode_amil' => $initial,
            'email' => $validated['email'],
            'nama_amil' => $validated['nama_amil'],
            'password' => $validated['password'],
            'no_telp' => $validated['no_telp'],
            'alamat' => $validated['alamat'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'qr_token' => $validated['qr_token'],
            'status' => 'amil',
        ];

        Amil::create($validated);

        $validatedData = [
            'name' => $validated['nama_amil'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'status' => $validated['status'],
        ];
        $validatedData['qr_token'] = $request->qr_token;

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('amil.index')->with('success', 'Amil berhasil ditambahkan.');
    }

    public function show(Amil $amil)
    {
        // // Ambil data amil berdasarkan ID
        // $amil = Amil::findOrFail($id);

        // // Tampilkan view untuk menampilkan detail amil
        // return view('amil.show', compact('amil'));
    }

    public function edit(Amil $amil)
    {
        return view('amil.edit', [
            'amil' => $amil,
            'qr_token' => Str::random(60),
        ]);
    }

    public function update(Request $request, Amil $amil)
    {
        $user = User::where('email', $amil->email)->first();

        $rules = [
            'kode_amil' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nama_amil' => 'required',
            'password' => 'required|min:8',
            'no_telp' => 'required|max:13|min:11',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
        ];

        $validated = $request->validate($rules);

        $validated['status'] = 'amil';
        $validated['qr_token'] = $request->qr_token;

        $name = $validated['nama_amil'];
        $firstName = explode(' ', $name)[0];
        $initial = strtoupper(substr($firstName, 0, 2));

        $lastName = explode(' ', $name)[1] ?? '';
        $initial .= strtoupper(substr($lastName, 0, 1));

        $initial = $initial . '-' . rand();

        if ($amil->nama_amil !== $validated['nama_amil']) {
            $validated['kode_amil'] = $initial;
        }

        Amil::where('id', $amil->id)->update($validated);

        $user->update([
            'name' => $validated['nama_amil'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'status' => $validated['status'],
            'qr_token' => $request->qr_token,
        ]);

        $amil->absensi()->update([
            'name' => $validated['nama_amil'],
            'email' => $validated['email'],
            'kode_amil' => $amil->id
        ]);

        $amil->gaji()->update([
            'kode_amil' => $amil->id,
            'nama_amil' => $validated['nama_amil'],
            'email' => $validated['email'],
        ]);

        return redirect('/amil')->with('success', 'Data Amil berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $amil = Amil::findOrFail($id);
        $amil->delete();

        $user = User::where('email', $amil->email)->first();
        User::where('email', $user->email)->delete();

        $amil->absensi()->delete();

        $amil->gaji()->delete();

        return redirect('/amil')->with('success', 'Data Amil berhasil dihapus.');
    }
}
