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
                    <h5 class="card-title fw-semibold mb-4">Data Muzakki</h5>

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
                    <form action="{{ route('muzakki.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="kode_muzakki" class="form-label">Kode Muzaki</label>
                            <input class="form-control form-control-solid" id="kode_muzakki" name="kode_muzakki" type="text"
                                placeholder="kode Muzakki">
                        </div>
                        <div class="mb-3">
                            <label for="nama_muzakki" class="form-label">Nama Muzakki</label>
                            <input class="form-control form-control-solid" id="nama_muzakki" name="nama_muzakki" type="text"
                                placeholder="Nama Muzakki">
                        </div>

                        <div class="mb-3">
                            <label for="no_telp" class="form-label">Nomor Telepon</label>
                            <input class="form-control form-control-solid" id="no_telp" name="no_telp" type="number"
                                placeholder="Nomor Telepon">
                        </div>

                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input class="form-control form-control-solid" id="tanggal_lahir" name="tanggal_lahir"
                                type="date">
                        </div>

                        <br>
                        <!-- untuk tombol simpan -->
                        <input class="col-sm-1 btn btn-outline-success btn-sm" type="submit" value="Simpan">

                        <!-- untuk tombol batal simpan -->
                        <a class="col-sm-1 btn btn-outline-dark  btn-sm" href="{{ url('/muzakki') }}" role="button">Batal</a>
                    </form>
                    <!-- Akhir Dari Input Form -->

                </div>
            </div>
        </div>

        </div>
    @endcan
@endsection
