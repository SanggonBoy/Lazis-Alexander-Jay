<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\Fidyah;
use App\Models\Pembayaransedekah;
use App\Models\PembayaranZakat;
use App\Models\Wakaf;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Order::select('kode_transaksi')->selectRaw('count(*) as total')->groupBy('kode_transaksi')->havingRaw('total > 1')->get();

        if ($result->isNotEmpty()) {
            connectify('error', 'Transaksi', 'Ada transaksi yang terduplikat');
        } else {
            connectify('success', 'Transaksi', 'Tidak ditemukan transaksi terduplikat');
        }

        return view('layouts/transaksi/view', [
            'transaksi' => Order::all(),
            'duplikat' => $result,
        ]);
    }

    public function search(Request $request)
    {
        $checking = $request->input('duplicate');

        $order = Order::where('kode_transaksi', 'like', "%{$checking}%")->get();

        $result = Order::select('kode_transaksi')->selectRaw('count(*) as total')->groupBy('kode_transaksi')->havingRaw('total > 1')->get();

        if ($result->isNotEmpty()) {
            connectify('error', 'Transaksi', 'Ada transaksi yang terduplikat');
        } else {
            connectify('success', 'Transaksi', 'Tidak ditemukan transaksi terduplikat');
        }

        return view('layouts/transaksi/search', [
            'duplikat' => $result,
            'transaksi' => $order,
        ]);
    }

    public function copyToClipboard(Request $request)
    {
        $data = $request->input('data');

        return response()->json(['data' => $data], 200);
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;

        $idsArray = explode(',', $ids);

        $data = Order::whereIn('id', $idsArray)->pluck('kode_transaksi')->toArray();

        Order::whereIn('id', $idsArray)->delete();

        PembayaranZakat::whereIn('kode_transaksi', $data)->delete();
        Pembayaransedekah::whereIn('kode_transaksi', $data)->delete();
        Wakaf::whereIn('kode_transaksi', $data)->delete();
        Fidyah::whereIn('kode_transaksi', $data)->delete();

        return response()->json(['status' => true, 'message' => 'Data telah berhasil dihapus.']);
    }

    public function filter(Request $request)
    {
        $filter = Order::where('kategori', $request->filter)->get();

        $result = Order::select('kode_transaksi')->selectRaw('count(*) as total')->groupBy('kode_transaksi')->havingRaw('total > 1')->get();

        if ($result->isNotEmpty()) {
            connectify('error', 'Transaksi', 'Ada transaksi yang terduplikat');
        } else {
            connectify('success', 'Transaksi', 'Tidak ditemukan transaksi terduplikat');
        }

        if ($request->filter == 'Semua') {
            return redirect('/checking-transaction');
        } else {
            return view('layouts/transaksi/filter', [
                'transaksi' => $filter,
                'duplikat' => $result,
            ]);
        }
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
    public function store(StoreTransaksiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaksi = Order::findOrFail($id);
        $transaksi->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect('/checking-transaction')->with('success', 'Data Transaksi berhasil dihapus.');
    }
}
