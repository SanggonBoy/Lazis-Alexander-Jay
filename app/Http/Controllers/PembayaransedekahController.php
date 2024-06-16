<?php

namespace App\Http\Controllers;

use App\Models\Pembayaransedekah;
use App\Http\Requests\StorePembayaransedekahRequest;
use App\Http\Requests\UpdatePembayaransedekahRequest;
use App\Models\Order;
use Illuminate\Http\Request;
// use App\Models\BadanAmal;

class PembayaransedekahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran_sedekah = Pembayaransedekah::all();
        return view('sedekah.view', compact('pembayaran_sedekah'));
    }

    public function Sedekah(Request $request, Pembayaransedekah $fitrah)
    {
        $re = rand();
        $validated = $request->validate([
            'kode_transaksi' => 'required',
            'email' => 'required',
            'full_name' => 'required',
            'jenis_transaksi' => 'required',
            'tanggal_pembayaran' => 'required',
            'status_pembayaran' => 'required',
            'nominal' => 'required'
        ]);
        $validated['nominal'] = str_replace('.', '', $request['nominal']);
        $validated['jumlah'] = 1;
        $validated['kategori'] = 'Sedekah';

        $order = Pembayaransedekah::create($validated);
        Order::create($validated);
        $cek = Pembayaransedekah::all();

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

        return view('/transaksi/viewSedekah', [
            'snapToken' => $snapToken,
            'order' => $order,
        ]);
    }

    public function callback(Request $request, Pembayaransedekah $order)
    {
        $serverKey = config('midtrans.server_key');

        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed === $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $update = [
                    'status_pembayaran' => 'berhasil',
                ];
                Pembayaransedekah::where('kode_transaksi', $request->order_id)->update($update);
            }
        }
    }

    public function create()
    {
        // $badan = BadanAmal::all();
        return view('sedekah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pembayar' => 'required',
            'nominal' => 'required',
            'badan' => 'required',
            'tanggal_pembayaran' => 'required|date',
            'email' => 'required|email',
        ]);

        // Remove formatting from nominal
        $validatedData['nominal'] = str_replace('.', '', $validatedData['nominal']);

        // Create the record in the database
        \App\Models\PembayaranSedekah::create($validatedData);

        return redirect('/transaksi')->with('success', 'Pembayaran berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaransedekah $pembayaransedekah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaransedekah $pembayaransedekah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePembayaransedekahRequest $request, Pembayaransedekah $pembayaransedekah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pembayaran_sedekah = Pembayaransedekah::findOrFail($id);
        $pembayaran_sedekah->delete();
        return redirect('/transaksi')->with('success', 'Pembayaran Sedekah berhasil dihapus');
    }
}
