@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')

    @can('karyawan')
        <h1 class="display-4">Anda tidak memiliki akses kesini!</h1>
    @endcan
    @can('admin')
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Data Amil</h5>

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
                    <form action="{{ route('amil.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_amil" class="form-label">Nama Amil</label>
                            <input class="form-control form-control-solid" value="{{ old('nama_amil') }}" id="nama_amil"
                                name="nama_amil" type="text" placeholder="Nama amil">
                        </div>

                        <div class="mb-3">
                            <label for="nama_amil" class="form-label">Email Amil</label>
                            <input class="form-control form-control-solid" value="{{ old('email') }}" id="email"
                                name="email" type="email" placeholder="Email">
                        </div>

                        <div class="mb-3">
                            <label for="nama_amil" class="form-label">Password</label>
                            <input class="form-control form-control-solid" value="{{ old('password') }}" id="password"
                                name="password" type="password" placeholder="Password">
                        </div>

                        <div class="mb-3">
                            <label for="no_telp" class="form-label">Nomor Telepon</label>
                            <input class="form-control form-control-solid" id="no_telp" name="no_telp" type="number"
                                placeholder="Nomor Telepon">
                            @error('no_telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input class="form-control form-control-solid" value="{{ old('alamat') }}" id="alamat"
                                name="alamat" type="textarea" placeholder="Alamat">
                        </div>

                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <input type="hidden" name="qr_token" value="{{$qr_token}}">

                        <br>
                        <!-- untuk tombol simpan -->
                        <input class="col-sm-1 btn btn-outline-success btn-sm" type="submit" value="Simpan">

                        <!-- untuk tombol batal simpan -->
                        <a class="col-sm-1 btn btn-outline-dark  btn-sm" href="{{ url('/amil') }}" role="button">Batal</a>
                    </form>
                    <!-- Akhir Dari Input Form -->

                </div>
            </div>
        </div>

        </div>
    @endcan
@endsection
