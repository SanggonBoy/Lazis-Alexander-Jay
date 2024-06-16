<?php

namespace App\Http\Controllers;

use App\Models\PembayaranZakat;
use App\Models\Order;
use App\Models\Muzakki; // Add the missing import statement
use Illuminate\Http\Request; // Add the missing import statement

class PembayaranZakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran_zakat = PembayaranZakat::all();
        return view('zakat.view', compact('pembayaran_zakat'));
    }

    public function Zakat(Request $request, PembayaranZakat $fitrah)
    {
        $re = rand();
        if ($request->jenis_transaksi === 'Zakat Fitrah') {
            if ($request->kode_transaksi !== $fitrah->kode_transaksi) {
                $regenerate = $request->validate([
                    'kode_transaksi' => 'required',
                    'email' => 'required',
                    'full_name' => 'required',
                    'status_pembayaran' => 'required',
                    'jenis_transaksi' => 'required',
                    'tanggal_pembayaran' => 'required',
                ]);
                $regenerate['jumlah'] = str_replace('.', '', $request->jumlahFitrah);
                $regenerate['nominal'] = str_replace('.', '', $request->nominalFitrah);
                $regenerate['kategori'] = 'Zakat Fitrah';

                $order = PembayaranZakat::create($regenerate);
                Order::create($regenerate);
                $cek = PembayaranZakat::all();

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
                        'gross_amount' => $order->nominal,
                    ],
                    'customer_details' => [
                        'first_name' => $order->full_name,
                        'email' => $order->email,
                    ],
                ];

                $snapToken = \Midtrans\Snap::getSnapToken($params);
            } else {
                $regenerate = [
                    'kode_transaksi' => $re,
                    'email' => $request['email'],
                    'full_name' => $request['full_name'],
                    'status_pembayaran' => $request['status_pembayaran'],
                    'jumlah' => $request['jumlah'],
                    'nominal' => $request['nominal'],
                    'jenis_transaksi' => $request['jenis_transaksi'],
                    'tanggal_pembayaran' => $request['tanggal_pembayaran'],
                ];
                $isi = $request->all();
                $order = PembayaranZakat::create($regenerate);
                $cek = PembayaranZakat::all();

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
                        'gross_amount' => $order->nominal,
                    ],
                    'customer_details' => [
                        'first_name' => $order->full_name,
                        'email' => $order->email,
                    ],
                ];

                $snapToken = \Midtrans\Snap::getSnapToken($params);
            }
        } elseif ($request->jenis_transaksi === 'Zakat Mal') {
            if ($request->kode_transaksi !== $fitrah->kode_transaksi) {
                $regenerate = $request->validate([
                    'kode_transaksi' => 'required',
                    'email' => 'required',
                    'full_name' => 'required',
                    'status_pembayaran' => 'required',
                    'jenis_transaksi' => 'required',
                    'tanggal_pembayaran' => 'required',
                ]);
                $regenerate['jumlah'] = str_replace('.', '', $request->jumlahMal);
                $regenerate['nominal'] = str_replace('.', '', $request->nominalMal);
                $regenerate['kategori'] = 'Zakat Mal';

                $order = PembayaranZakat::create($regenerate);
                Order::create($regenerate);
                $cek = PembayaranZakat::all();

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
                        'gross_amount' => $order->nominal,
                    ],
                    'customer_details' => [
                        'first_name' => $order->full_name,
                        'email' => $order->email,
                    ],
                ];

                $snapToken = \Midtrans\Snap::getSnapToken($params);
            } else {
                $regenerate = [
                    'kode_transaksi' => $re,
                    'email' => $request['email'],
                    'full_name' => $request['full_name'],
                    'status_pembayaran' => $request['status_pembayaran'],
                    'jumlah' => $request['jumlah'],
                    'nominal' => $request['nominal'],
                    'jenis_transaksi' => $request['jenis_transaksi'],
                    'tanggal_pembayaran' => $request['tanggal_pembayaran'],
                ];
                $isi = $request->all();
                $order = PembayaranZakat::create($regenerate);
                $cek = PembayaranZakat::all();

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
                        'gross_amount' => $order->nominal,
                    ],
                    'customer_details' => [
                        'first_name' => $order->full_name,
                        'email' => $order->email,
                    ],
                ];

                $snapToken = \Midtrans\Snap::getSnapToken($params);
            }
        }
        return view('/transaksi/viewZakat', [
            'snapToken' => $snapToken,
            'order' => $order,
        ]);
    }

    public function callback(Request $request, PembayaranZakat $order)
    {
        $serverKey = config('midtrans.server_key');

        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed === $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $update = [
                    'status_pembayaran' => 'berhasil',
                ];
                PembayaranZakat::where('kode_transaksi', $request->order_id)->update($update);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $muzakkis = Muzakki::all();
        return view('zakat.create', ['muzakkis' => $muzakkis]);
    }

    public function store(Request $request)
    {
        $kode = rand();
        if ($request->jenis_transaksi === 'Zakat Fitrah') {
            $validated = $request->validate([
                'kode_transaksi' => 'required',
                'email' => 'required',
                'full_name' => 'required',
                'jenis_transaksi' => 'required',
                'tanggal_pembayaran' => 'required',
                'status_pembayaran' => 'required',
            ]);
            $validated['jumlah'] = str_replace('.', '', $request->jumlahFitrah);
            $validated['nominal'] = str_replace('.', '', $request->nominalFitrah);
        } elseif ($request->jenis_transaksi === 'Zakat Mal') {
            $validated = $request->validate([
                'kode_transaksi' => 'required',
                'email' => 'required',
                'full_name' => 'required',
                'jenis_transaksi' => 'required',
                'tanggal_pembayaran' => 'required',
                'status_pembayaran' => 'required',
            ]);
            $validated['jumlah'] = str_replace('.', '', $request->jumlahMal);
            $validated['nominal'] = str_replace('.', '', $request->nominalMal);
        }
        PembayaranZakat::create($validated);
        return redirect('/transaksi');
    }

    /**
     * Display the specified resource.
     */
    public function show(PembayaranZakat $pembayaranZakat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PembayaranZakat $pembayaranZakat)
    {
        return view('zakat.edit', compact('pembayaranZakat'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdatePembayaranZakatRequest $request, PembayaranZakat $pembayaranZakat)
    // {

    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pembayaran_zakat = PembayaranZakat::findOrFail($id);
        $pembayaran_zakat->delete();

        return redirect('/transaksi')->with('success', 'Pembayaran Zakat berhasil dihapus');
    }
}
