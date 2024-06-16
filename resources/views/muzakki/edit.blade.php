@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit Data Muzakki</h5>

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

                <form action="/muzakki/{{ $muzakki->id }}" method="post">
                    @csrf
                    @method('PUT')
                    {{-- <div class="mb-3">
                        <label for="kode_muzakki" class="form-label">Kode Muzakki</label>
                        <input class="form-control btn btn-primary form-control-solid" id="kode_muzakki" name="kode_muzakki"
                            type="text" value="{{ $muzakki->kode_muzakki }}" readonly>
                    </div> --}}

                    <div class="mb-3">
                        <label for="nama_muzakki" class="form-label">Nama Muzakki</label>
                        <input class="form-control form-control-solid" id="nama_muzakki" name="name" type="text"
                            placeholder="Nama Muzakki" value="{{ old('nama_muzakki', $muzakki->name) }}">
                    </div>

                    <div class="mb-3">
                        <label for="nama_muzakki" class="form-label">Email</label>
                        <input class="form-control form-control-solid" id="nama_muzakki" name="email" type="email"
                            placeholder="Nama Muzakki" value="{{ old('email', $muzakki->email) }}">
                    </div>

                    <div class="mb-3">
                        <label for="nama_muzakki" class="form-label">Password</label>
                        <input class="form-control form-control-solid" id="nama_muzakki" name="password" type="password"
                            placeholder="Nama Muzakki" value="{{ old('password', $muzakki->password) }}">
                    </div>

                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No. Telpon</label>
                        <input class="form-control form-control-solid" id="no_telp" name="no_telp" type="number"
                            placeholder="No Tekp" value="{{ old('no_telp', $muzakki->no_telp) }}">
                    </div>


                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                            @if (old('jenis_kelamin', $muzakki->jenis_kelamin) == 'Laki-Laki')
                                <option value="Laki-Laki" selected>Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            @else
                                <option value="Perempuan" selected>Perempuan</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                            @endif
                        </select>
                    </div>

                    <input type="hidden" name="status" value="{{$muzakki->status}}">
                    <input type="hidden" name="qr_token" value="{{$muzakki->qr_token}}">
                    <br>
                    <!-- untuk tombol simpan -->
                    <input class="col-sm-1 btn btn-outline-success btn-sm" type="submit" value="Ubah">

                    <!-- untuk tombol batal simpan -->
                    <a class="col-sm-1 btn btn-outline-dark  btn-sm" href="/muzakki" role="button">Batal</a>

                </form>
            </div>
        </div>
    </div>


@endsection
