<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class Berita extends Controller
{
    public function berita(Request $request)
    {
        $keyword = $request->query('keyword');
        $response = Http::get('https://newsapi.org/v2/everything?q=ramadhan&language=id&form=2021-04-29&sortBy=popularity&apikey=f4f2f983b57a42a98db394d9ae54e4b6');

        return response()->json($response->json());
    }
}
