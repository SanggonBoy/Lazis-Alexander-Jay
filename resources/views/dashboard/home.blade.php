@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')
<div class="card">
    <h2>Laporan Barang</h2>
    <p>Per/Bulan</p>
    <div class="pulse"></div>
    <div class="chart-area">
        <div class="grid"></div>
    </div>
</div>
@endsection
