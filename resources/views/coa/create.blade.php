@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Data Coa</h5>

            <!-- Display Error jika ada error -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Akhir Display Error -->

            <!-- Awal Dari Input Form -->
            <form action="{{ route('coa.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="kode_akun">Kode Akun</label>
                    <input class="form-control form-control-solid" id="kode_akun" name="kode_akun" type="number" placeholder="Kode Akun" maxlength="3">
                    <small class="text-danger">Kode Akun harus terdiri dari maksimum 3 digit angka</small>
                </div>
                
                <div class="mb-3">
                    <label for="nama_akun">Nama Akun</label>
                    <input class="form-control form-control-solid" id="nama_akun" name="nama_akun" type="text" placeholder="Nama Akun">
                </div>
                
                <div class="mb-3">
                    <label for="header_akun">Header Akun</label>
                    <select class="form-select" id="header_akun" name="header_akun">
                        <option value="1">1 - Harta</option>
                        <option value="2">2 - Kewajiban</option>
                        <option value="3">3 - Modal</option>
                        <option value="4">4 - Pendapatan</option>
                        <option value="5">5 - Beban</option>
                    </select>
                </div>
                
                <br>
                <!-- untuk tombol simpan -->
                <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Simpan">

                <!-- untuk tombol batal simpan -->
                <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/coa') }}" role="button">Batal</a>
            </form>
            <!-- Akhir Dari Input Form -->
        
        </div>
    </div>
</div>

@endsection
