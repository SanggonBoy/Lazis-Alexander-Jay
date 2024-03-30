<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Amil;
use App\Models\Kategori_barang;

class PdfController extends Controller
{
    public function barangPdf()
    {
        $pdf = Pdf::loadView('pdf-laporan/pdf-barang', [
            'barang' => Barang::with('kategori')->get(),
        ]);
        return $pdf->download('Laporan Barang.pdf');
    }
    public function kategoriPdf()
    {
        $pdf = Pdf::loadView('pdf-laporan/pdf-kategori', [
            'kategori' => Kategori_barang::all(),
        ]);
        return $pdf->download('Laporan Kategori.pdf');
    }
    public function amilPdf()
    {
        $pdf = Pdf::loadView('pdf-laporan/pdf-amil', [
            'amil' => Amil::all(),
        ]);
        return $pdf->download('Laporan Amil.pdf');
    }
}
