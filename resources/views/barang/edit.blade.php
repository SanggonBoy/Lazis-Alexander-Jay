@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit Data Barang</h5>

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

                <form action="/barang/{{ $barang->id }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_barang">Nama Barang</label>
                        <input class="form-control form-control-solid" id="nama_barang" name="nama_barang" type="text"
                            placeholder="Nama Barang" value="{{ old('nama_barang', $barang->nama_barang) }}">
                    </div>

                    <div class="mb-3">
                        <label for="kode_kategori">Kategori Barang</label>
                        <select class="form-select" id="kode_kategori" name="kode_kategori">
                            {{-- @foreach ($kategori as $k)
                                <option value="{{ old('kode_kategori', $k->id) }}" selected>
                                    {{($k->kategori) }}</option>
                            @endforeach --}}
                            <option value="Harta">Harta</option>
                            <option value="Kendaraan">Kendaraan</option>
                        </select>
                    </div>
                    <br>
                    <!-- untuk tombol simpan -->
                    <input class="col-sm-1 btn btn-outline-success btn-sm" type="submit" value="Ubah">

                    <!-- untuk tombol batal simpan -->
                    <a class="col-sm-1 btn btn-outline-dark  btn-sm" href="/barang" role="button">Batal</a>

                </form>
            </div>
        </div>
    </div>


@endsection
