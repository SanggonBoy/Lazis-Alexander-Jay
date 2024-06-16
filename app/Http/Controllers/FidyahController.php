<?php

namespace App\Http\Controllers;

use App\Models\Fidyah;
use App\Models\Order;
use App\Http\Requests\StoreFidyahRequest;
use App\Http\Requests\UpdateFidyahRequest;
use Illuminate\Http\Request;

class FidyahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fidyah = Fidyah::all();
        return view('fidyah.view', compact('fidyah'));
    }

    public function Fidyah(Request $request, Fidyah $fitrah)
    {
        $re = rand();
        $validated = $request->validate([
            'kode_transaksi' => 'required',
            'email' => 'required',
            'full_name' => 'required',
            'jenis_transaksi' => 'required',
            'tanggal_pembayaran' => 'required',
            'status_pembayaran' => 'required',
            'jumlah' => 'required',
            'nominal' => 'required'
        ]);
        $validated['jumlah'] = str_replace('.', '', $request['jumlah']);
        $validated['nominal'] = str_replace('.', '', $request['nominal']);
        $validated['kategori'] = "Fidyah";

        $order = Fidyah::create($validated);
        Order::create($validated);
        $cek = Fidyah::all();

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $order->kode_transaksi,
                'gross_amount' => str_replace('.', '', $request['nominal']),
            ],
            'customer_details' => [
                'first_name' => $order->full_name,
                'email' => $order->email,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('/transaksi/viewFidyah', [
            'snapToken' => $snapToken,
            'order' => $order,
        ]);
    }

    public function callback(Request $request, Fidyah $order)
    {
        $serverKey = config('midtrans.server_key');

        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed === $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $update = [
                    'status_pembayaran' => 'berhasil',
                ];
                Fidyah::where('kode_transaksi', $request->order_id)->update($update);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fidyah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pembayar' => 'required',
            'jumlah_hari' => 'required|integer',
            'nominal'=>'required',
            'tanggal_pembayaran'=>'required|date',
            'email'=>'required|email',
        ]);
        $validatedData['nominal'] = str_replace('.', '', $validatedData['nominal']);
    
        Fidyah::create($validatedData);
    
        return redirect('/transaksi')->with('success', 'Pembayaran berhasil disimpan');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Fidyah $fidyah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fidyah $fidyah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFidyahRequest $request, Fidyah $fidyah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fidyah = Fidyah::findOrFail($id);
        $fidyah->delete();
        return redirect('/transaksi')->with('success', 'Pembayaran Fidyah Berhasil dihapus');
    }
}
