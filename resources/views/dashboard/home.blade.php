@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card" id="dataTahunanTransaksi">
                <div class="card-body bg bg-dark rounded fw-bold">
                    {!! $order->container() !!}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="card" id="dataBulananMal">
                        <div
                            class="card-body border border-info bg-dark bg-opacity-100 border border-info rounded text-light fw-bold">
                            <h5 class="card-title fw-bold text-light">Rp.
                                {{ number_format($mal->isEmpty() ? 0 : $mal[0]->total, 2) }},-</h5>
                            <p class="card-title text-light text-lg">Data Zakat Mal Total Volume Transaksi</p>
                            <p class="card-text text-info">Data Bulanan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card" id="dataBulananFitrah">
                        <div
                            class="card-body border border-info bg-dark bg-opacity-100 border border-info rounded text-light fw-bold">
                            <h5 class="card-title fw-bold text-light">Rp.
                                {{ number_format($fitrah->isEmpty() ? 0 : $fitrah[0]->total, 2) }},-</h5>
                            <p class="card-title text-light text-lg">Data Zakat Fitrah Total Volume Transaksi</p>
                            <p class="card-text text-info">Data Bulanan.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="card" id="dataBulananSedekah">
                        <div
                            class="card-body border border-info bg-dark bg-opacity-100 border border-info rounded text-light fw-bold">
                            <h5 class="card-title fw-bold text-light">Rp.
                                {{ number_format($sedekah->isEmpty() ? 0 : $sedekah[0]->total, 2) }},-</h5>
                            <p class="card-title text-light text-lg">Data Sedekah Total Volume Transaksi</p>
                            <p class="card-text text-info">Data Bulanan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card" id="dataBulananWakaf">
                        <div
                            class="card-body border border-info bg-dark bg-opacity-100 border border-info rounded text-light fw-bold">
                            <h5 class="card-title fw-bold text-light">Rp.
                                {{ number_format($wakaf->isEmpty() ? 0 : $wakaf[0]->total, 2) }},-</h5>
                            <p class="card-title text-light text-lg">Data Wakaf Total Volume Transaksi</p>
                            <p class="card-text text-info">Data Bulanan.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 alig mb-3 mb-sm-0">
                    <div class="card" id="dataBulananFidyah">
                        <div
                            class="card-body border border-info bg-dark bg-opacity-100 border border-info rounded text-light fw-bold">
                            <h5 class="card-title fw-bold text-light">Rp.
                                {{ number_format($fidyah->isEmpty() ? 0 : $fidyah[0]->total, 2) }},-</h5>
                            <p class="card-title text-light text-lg">Data FIdyah Total Volume Transaksi</p>
                            <p class="card-text text-info">Data Bulanan.</p>
                        </div>
                    </div>
                </div>
            </div>
            <script src="{{ $order->cdn() }}"></script>

            {{ $order->script() }}
        @endsection
