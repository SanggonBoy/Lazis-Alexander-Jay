<?php

namespace App\Http\Controllers;

use App\Models\Fidyah;
use App\Models\Order;
use App\Models\Muzakki;
use App\Models\PembayaranZakat;
use App\Http\Controllers\PdfController;
use App\Models\Wakaf;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Pembayaransedekah;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('transaksi.home', [
            'muzakkis' => Muzakki::all(),
        ]);
    }

    public function Zakat(Request $request, PembayaranZakat $fitrah)
    {
        $re = rand();
        if ($request->kode_transaksi !== $fitrah->kode_transaksi) {
            $regenerate = [
                'kode_transaksi' => $request['kode_transaksi'],
                'email' => $request['email'],
                'full_name' => $request['full_name'],
                'status_pembayaran' => $request['status_pembayaran'],
                'jumlah' => str_replace('.', '', $request['jumlahFitrah']),
                'nominal' => str_replace('.', '', $request['nominalFitrah']),
                'jenis_transaksi' => $request['jenis_transaksi'],
                'tanggal_pembayaran' => $request['tanggal_pembayaran'],
            ];

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
                    'gross_amount' => str_replace('.', '', $request['nominalFitrah']),
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
        return view('/transaksi/view', [
            'snapToken' => $snapToken,
            'order' => $order,
        ]);
    }

    public function callback(Request $request)
    {
        $fidyah = Fidyah::where('kode_transaksi', $request->order_id)->first();
        $zakat = PembayaranZakat::where('kode_transaksi', $request->order_id)->first();
        $sedekah = Pembayaransedekah::where('kode_transaksi', $request->order_id)->first();
        $wakaf = Wakaf::where('kode_transaksi', $request->order_id)->first();


        $serverKey = config('midtrans.server_key');

        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed === $request->signature_key) {
            if ($request->transaction_status == 'capture' || 'settlement') {
                
                if ($fidyah && $fidyah->kategori == 'Fidyah') {
                    $update = [
                        'status_pembayaran' => 'berhasil',
                    ];
                    Order::where('kode_transaksi', $request->order_id)->update($update);
                    Fidyah::where('kode_transaksi', $request->order_id)->update($update);
                } 
                if ($zakat && $zakat->kategori == 'Zakat Mal') {
                    $update = [
                        'status_pembayaran' => 'berhasil',
                    ];
                    Order::where('kode_transaksi', $request->order_id)->update($update);
                    PembayaranZakat::where('kode_transaksi', $request->order_id)->update($update);
                } 
                if ($zakat && $zakat->kategori == 'Zakat Fitrah') {
                    $update = [
                        'status_pembayaran' => 'berhasil',
                    ];
                    Order::where('kode_transaksi', $request->order_id)->update($update);
                    PembayaranZakat::where('kode_transaksi', $request->order_id)->update($update);
                } 
                if ($sedekah && $sedekah->kategori == 'Sedekah') {
                    $update = [
                        'status_pembayaran' => 'berhasil',
                    ];
                    Order::where('kode_transaksi', $request->order_id)->update($update);
                    Pembayaransedekah::where('kode_transaksi', $request->order_id)->update($update);
                } 
                if ($wakaf && $wakaf->kategori == 'Wakaf') {
                    $update = [
                        'status_pembayaran' => 'berhasil',
                    ];
                    Order::where('kode_transaksi', $request->order_id)->update($update);
                    Wakaf::where('kode_transaksi', $request->order_id)->update($update);
                }
            }
        }
    }
    public function invoice($kode_transaksi)
    {
        $order = PembayaranZakat::find($kode_transaksi);

        return view('pdf-laporan/pdf-invoice', [
            'm' => $order,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
