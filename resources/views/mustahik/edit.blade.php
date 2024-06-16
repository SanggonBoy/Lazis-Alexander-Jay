@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit Data Mustahik</h5>

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

                <form action="/mustahik/{{ $a->id }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="kode_mustahik">Kode Mustahik</label>
                        <input class="form-control btn btn-primary form-control-solid" id="kode_mustahik"
                            name="kode_mustahik" type="text" value="{{ $a->kode_mustahik }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="nama_mustahik" class="form-label">Nama Mustahik</label>
                        <input class="form-control form-control-solid" id="nama_mustahik" name="nama_mustahik"
                            type="text" placeholder="Nama Mustahik"
                            value="{{ old('nama_mustahik', $a->nama_mustahik) }}">
                    </div>

                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No Telp</label>
                        <input class="form-control form-control-solid" id="no_telp" name="no_telp" type="number"
                            placeholder="No Telp" value="{{ old('no_telp', $a->no_telp) }}">
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control form-control-solid" id="alamat" name="alamat" type="text" placeholder="Alamat"
                            value="{{ old('alamat', $a->alamat) }}">{{ old('alamat', $a->alamat) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                            @if (old('jenis_kelamin', $a->jenis_kelamin) == 'Laki-Laki')
                                <option value="Laki-Laki" selected>Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            @else
                                <option value="Perempuan" selected>Perempuan</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                            @endif
                        </select>
                    </div>
                    <br>
                    <!-- untuk tombol simpan -->
                    <input class="col-sm-1 btn btn-outline-success btn-sm" type="submit" value="Ubah">

                    <!-- untuk tombol batal simpan -->
                    <a class="col-sm-1 btn btn-outline-dark  btn-sm" href="/mustahik" role="button">Batal</a>

                </form>
            </div>
        </div>
    </div>


@endsection
