@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit Data Amil</h5>

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
                <form action="/amil/{{ $amil->id }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="id_amil" class="form-label">Kode Amil</label>
                        <input class="form-control btn btn-primary form-control-solid" id="id_amil" name="kode_amil"
                            type="text" value="{{old('kode_amil', $amil->kode_amil) }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="id_amil" class="form-label">Nama Amil</label>
                        <input class="form-control form-control-solid" id="id_amil" name="nama_amil" type="text"
                            value="{{ old('nama_amil',$amil->nama_amil) }}">
                    </div>

                    <div class="mb-3">
                        <label for="id_amil" class="form-label">Email Amil</label>
                        <input class="form-control form-control-solid" id="id_amil" name="email" type="email"
                            value="{{ old('email',$amil->email) }}">
                    </div>

                    <div class="mb-3">
                        <label for="id_amil" class="form-label">Password</label>
                        <input class="form-control form-control-solid" id="id_amil" name="password" type="password"
                            value="{{ old('password',$amil->password) }}">
                    </div>

                    <div class="mb-3">
                        <label for="no_telp" class="form-label">Nomor Telepon</label>
                        <input class="form-control form-control-solid" id="no_telp" name="no_telp" type="number"
                            value="{{ old('no_telp',$amil->no_telp) }}">
                    </div>

                    <div class="mb-0">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control form-control-solid" id="alamat" name="alamat" type="text"
                            value="{{ old('alamat',$amil->alamat) }}">{{ old('alamat',$amil->alamat) }}</textarea>
                    </div>
                    <br>

                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                            @if (old('jenis_kelamin', $amil->jenis_kelamin) == 'Laki-Laki')
                                <option value="Laki-Laki" selected>Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            @else
                                <option value="Perempuan" selected>Perempuan</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                            @endif
                        </select>
                    </div>

                    <input type="hidden" name="qr_token" value="{{old('qr_token', $amil->qr_token)}}">
                    <!-- untuk tombol simpan -->

                    <input class="col-sm-1 btn btn-outline-success btn-sm" type="submit" value="Ubah">

                    <!-- untuk tombol batal simpan -->
                    <a class="col-sm-1 btn btn-outline-dark  btn-sm" href="{{ url('/amil') }}" role="button">Batal</a>

                </form>
                <!-- Akhir Dari Input Form -->

            </div>
        </div>
    </div>


@endsection
