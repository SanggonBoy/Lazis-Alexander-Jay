<?php

namespace App\Http\Controllers;

use App\Models\Wakaf;
use App\Models\Order;
use App\Http\Requests\StoreWakafRequest;
use App\Http\Requests\UpdateWakafRequest;
use Illuminate\Http\Request;

class WakafController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wakaf = Wakaf::all();
        return view('wakaf.view', compact('wakaf'));

    }

    public function Wakaf(Request $request, Wakaf $fitrah)
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
        $validated['kategori'] = 'Wakaf';

        $order = Wakaf::create($validated);
        Order::create($validated);
        $cek = Wakaf::all();

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

        return view('/transaksi/viewWakaf', [
            'snapToken' => $snapToken,
            'order' => $order,
        ]);
    }

    public function callback(Request $request, Wakaf $order)
    {
        $serverKey = config('midtrans.server_key');

        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed === $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $update = [
                    'status_pembayaran' => 'berhasil',
                ];
                Wakaf::where('kode_transaksi', $request->order_id)->update($update);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('wakaf.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pewakaf' => 'required',
            'jenis_wakaf' => 'required',
            'nominal'=>'required',
            'tanggal_pembayaran'=>'required|date',
            'email'=>'required|email',
        ]);
        $validatedData['nominal'] = str_replace('.', '', $validatedData['nominal']);
    
        Wakaf::create($validatedData);
    
        return redirect('/transaksi')->with('success', 'Pembayaran berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Wakaf $wakaf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wakaf $wakaf)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWakafRequest $request, Wakaf $wakaf)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $wakaf = wakaf::findOrFail($id);
        $wakaf->delete();
        return redirect('/transaksi')->with('success', 'Pembayaran wakaf Berhasil dihapus');

    }
}
