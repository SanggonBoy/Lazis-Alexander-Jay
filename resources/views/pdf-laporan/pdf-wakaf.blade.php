@extends('layouts/pdf/main')

@section('content')
    <div class="card">
        <div class="card-body mx-4">
            <div class="container">
                <p class="my-5 mx-5" style="font-size: 30px;">Nota Pembayaran LAZIS</p>
                <div class="row">
                    <ul class="list-unstyled">
                        <li class="text-black">{{ $m->full_name }}</li>
                        <li class="text-muted mt-1"><span class="text-black">Invoice</span> #{{ $m->kode_transaksi }}</li>
                        <li class="text-black mt-1">Status Pembayaran: {{ $m->status_pembayaran }}</li>
                        <li class="text-black mt-1">{{ $m->tanggal_pembayaran }}</li>
                    </ul>
                    <hr>
                    <div class="col-xl-10">
                        <p>Jenis Pembayaran: </p>
                        <hr>
                        <p>{{ $m->jenis_transaksi }} | Anda Telah Mewakafkan Harta Anda Sebesar Rp.{{number_format($m->nominal, 2, ',', '.')}},-</p>
                    </div>
                    <div class="col-xl-2">
                        <p class="float-end">Rp. {{ number_format($m->nominal, 2, ',', '.') }}</p>
                        </p>
                    </div>
                    <hr style="border: 2px solid black;">
                    <div class="row text-black">
                        <div class="col-xl-12">
                            <p class="float-end fw-bold">Total: Rp. {{ number_format($m->nominal, 2, ',', '.') }}
                            </p>
                        </div>
                        <hr style="border: 2px solid black;">
                    </div>
                    <div class="text-center" style="margin-top: 90px;">
                        <p>Terimakasih atas {{ $m->jenis_transaksi }} Anda. Salam Hormat &copy;LAZIS</p>
                    </div>

                    <div class="text-center" style="margin-top: 90px; color:red">
                        <p>@if($m->status_pembayaran == 'pending') Hubungin Admin Jika Status Pembayaran Pada Nota/Invoice adalah Pending.@endif</p>
                    </div>

                </div>
            </div>
        </div>
    @endsection
