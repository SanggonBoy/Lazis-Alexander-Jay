@extends('layouts/pdf/main')

@section('content')
<div class="card">
    <div class="card-body mx-4">
        <div class="container">
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 20px;
                    color: #000;
                }
                .slip-gaji {
                    width: 100%;
                    max-width: 600px;
                    border: 1px solid #000;
                    padding: 20px;
                    margin: auto;
                    background-color: #fff;
                }
                .header {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .header h1 {
                    margin: 0;
                    font-size: 24px;
                    color: #0000FF;
                }
                .header p {
                    margin: 5px 0;
                    font-weight: bold;
                }
                .content table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }
                .content th, .content td {
                    padding: 8px;
                    text-align: left;
                    border: 1px solid #000;
                }
                .content th {
                    background-color: #f2f2f2;
                }
                .totals {
                    font-weight: bold;
                    color: red;
                }
                .footer {
                    margin-top: 20px;
                }
                .footer table {
                    width: 100%;
                }
                .footer td {
                    padding: 5px;
                }
                .approval {
                    margin-top: 40px;
                    display: flex;
                    justify-content: space-between;
                }
                .approval .left {
                    text-align: left;
                }
                .approval .right {
                    text-align: right;
                }
                .approval .right, .approval .left {
                    width: 48%;
                }
                .jarak-diterima-oleh {
                    margin-top: 20px;
                }
            </style>

            <div class="slip-gaji">
                <div class="header">
                    <h1>Slip Gaji Detail</h1>
                    <p>PT. LAZIS & ZAKAT</p>
                    <hr>
                </div>
                <div class="content">
                    <table>
                        <tr>
                            <td>Kode</td>
                            <td>: {{$gaji->amil->kode_amil}}</td>
                            <td>Periode</td>
                            <td>: {{$periode}}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: {{$gaji->nama_amil}}</td>
                            <td>No Reff</td>
                            <td>: {{$gaji->kode_transaksi}}</td>
                        </tr>
                        <tr>
                            <td>Departemen</td>
                            <td>: Pengelolaan</td>
                            <td>Jabatan</td>
                            <td>: Staff</td>
                        </tr>
                    </table>
                    <h3 class="text-info fw-semibold border-bottom border-top border-2 border-dark">Penambah Gaji (A)</h3>
                    <table>
                        <tr>
                            <td>Uang Transport</td>
                            <td>Rp. {{number_format($gaji->transport,2)}},-</td>
                        </tr>
                        <tr>
                            <td>Uang Makan</td>
                            <td>Rp. {{number_format($gaji->makan,2)}},-</td>
                        </tr>
                        <tr>
                            <td>Uang Lembur</td>
                            <td>Rp. {{number_format($gaji->lembur,2)}},-</td>
                        </tr>
                        <tr>
                            <td>Tunjangan Lainnya</td>
                            <td>Rp. {{number_format($gaji->tunjangan,2)}},-</td>
                        </tr>
                        <tr>
                            <td>Bonus</td>
                            <td>Rp. {{number_format($gaji->bonus,2)}},-</td>
                        </tr>
                        <tr class="totals">
                            <td>Total Penambah</td>
                            <td>Rp. {{number_format($gaji->transport + $gaji->makan + $gaji->lembur + $gaji->bonus + $gaji->tunjangan, 2)}},-</td>
                        </tr>
                    </table>
                    <h3 class="text-info fw-semibold border-bottom border-top border-2 border-dark">Pengurang Gaji (B)</h3>
                    <table>
                        <tr>
                            <td>Tidak Hadir Selama {{$gaji->jumlah_alpa}} Hari.</td>
                            <td>Rp. {{number_format($gaji->jumlah_alpa * 50000 ,2)}},-</td>
                        </tr>
                        <tr class="totals">
                            <td>Total Pengurang</td>
                            <td>Rp. {{number_format($gaji->jumlah_alpa * 50000 ,2)}},-</td>
                        </tr>
                    </table>
                </div>
                <div class="footer">
                    <table>
                        <tr>
                            <td>Sistem Pembayaran</td>
                            <td>: Transfer</td>
                        </tr>
                        <tr>
                            <td>Gaji Pokok</td>
                            <td>: Rp. {{number_format($gaji->total_gaji, 2)}},- /Bulan</td>
                        </tr>
                        <tr>
                            <td>(A+B+C)</td>
                            <td>: Rp. {{number_format($gaji->total_gaji + $gaji->transport + $gaji->makan + $gaji->lembur + $gaji->bonus + $gaji->tunjangan - ($gaji->jumlah_alpa * 50000), 2)}},-.</td>
                        </tr>
                        <tr class="fw-semibold border-top border-bottom mb-5 border-2 border-danger">
                            <td>Take Home Pay</td>
                            <td>: Rp. {{number_format($gaji->total_gaji + $gaji->transport + $gaji->makan + $gaji->lembur + $gaji->bonus + $gaji->tunjangan - ($gaji->jumlah_alpa * 50000), 2)}},-.</td>
                        </tr>
                        <tr class="jarak-diterima-oleh">
                            <td>Diterima Oleh</td>
                            <br>
                            <td>: {{$tanggal}}</td>
                        </tr>
                    </table>
                    <div class="approval">
                        <div class="left">
                            <p>Disetujui Oleh:</p>
                            <br><br>
                            <p>{{auth()->user()->name}}</p>
                            <p>Direktur</p>
                        </div>
                        <div class="right">
                            <p>&nbsp;</p>
                            <br><br>
                            <p>{{$gaji->nama_amil}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
