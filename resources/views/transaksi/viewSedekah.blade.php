@extends('layouts.transaksi.midtransSedekah')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                    <div class="col-xl-9">
                        <p style="color: #191717;font-size: 20px;">Invoice >> <strong>ID:
                                #{{ $order->kode_transaksi }}</strong></p>
                    </div>
                    <hr>
                </div>

                <div class="container">
                    <div class="col-md-12">
                        <div class="text-center">
                            <i class="fab fa-mdb fa-4x ms-0" style="color:#1F4172 ;"></i>
                            <p class="pt-0">LAZIS.COM</p>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-xl-8">
                            <ul class="list-unstyled">
                                <li class="text-muted">To: <span style="color:#1F4172 ;">{{ $order->full_name }}</span></li>
                                {{-- <li class="text-muted">Street, City</li>
              <li class="text-muted">State, Country</li>
              <li class="text-muted"><i class="fas fa-phone"></i> 123-456-789</li> --}}
                            </ul>
                        </div>
                        <div class="col-xl-4">
                            <p class="text-muted">Invoice</p>
                            <ul class="list-unstyled">
                                <li class="text-muted"><i class="fas fa-circle" style="color:#1F4172 ;"></i> <span
                                        class="fw-bold">ID:</span>#{{ $order->kode_transaksi }}</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#1F4172 ;"></i> <span
                                        class="fw-bold">Creation Date: </span>{{ $order->created_at }}</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#1F4172 ;"></i> <span
                                        class="me-1 fw-bold">Status:</span><span
                                        class="badge bg-warning text-black fw-bold">
                                        Unpaid</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row my-2 mx-1 justify-content-center">
                        <table class="table table-striped table-borderless">
                            <thead style="background-color:#1F4172 ;" class="text-white">
                                <tr>
                                    <th scope="col">Jenis Pembayaran</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $order->jenis_transaksi }}</td>
                                    <td>Rp. {{ number_format($order->nominal, 2, ',', '.') }}</td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="row">
                        <div class="col-xl-8">
                            <p class="ms-3 text-danger">*setelah melakukan pembayaran nota akan otomatis dicetak.</p>
                            <p class="ms-3 text-danger">*tekan kembali tombol "BAYAR SEKARANG" jika sudah melakukan
                                pembayaran.</p>

                        </div>
                        <div class="col-xl-3">
                            {{-- <ul class="list-unstyled">
              <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>$1110</li>
              <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(15%)</span>$111</li>
            </ul> --}}
                            <p class="text-black float-start"><span class="text-black me-3"> Total Keseluruhan</span>
                                <span style="font-size: 25px;">Rp. {{ number_format($order->nominal, 2, ',', '.') }}</span>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-10">
                            <p>Terimakasi atas kepercayaan Anda. Yth. {{ $order->full_name }}</p>
                            <p>Hormat Kami &copy; Syamsul U'lum</p>
                        </div>
                        <div class="col-xl-2">
                            <button id="pay-button" class="btn btn-primary text-decoration-none text-capitalize"
                                style="background-color:#1F4172 ;">Bayar Sekarang!</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
