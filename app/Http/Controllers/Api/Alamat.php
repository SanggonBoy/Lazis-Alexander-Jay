<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class Alamat extends Controller
{
    public function cariAlamat(Request $request)
    {
        $keyword = $request->query('keyword');
        $response = Http::get('https://alamat.thecloudalert.com/api/cari/index/', [
            'keyword' => $keyword
        ]);

        return response()->json($response->json());
    }
}
