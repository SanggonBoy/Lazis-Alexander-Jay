<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Barang;

class PdfController extends Controller
{
    public function generatePdf()
    {
        // $pdf = Pdf::loadView('barang/view', [
        //     'barang' => Barang::with('kategori')->get()
        // ]);
        // return $pdf->download('data-barang.pdf');
        return view('barang.pdf-barang', [
            'barang' => Barang::with('kategori')->get()
        ]);
    }
}