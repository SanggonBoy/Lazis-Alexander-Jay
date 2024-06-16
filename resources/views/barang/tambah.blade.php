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
                    <h5 class="card-title fw-semibold mb-4">Data Barang</h5>

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
                    <form action="/barang" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" id="exampleFormControlInput2">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput2" class="form-label">Nama Kategori</label>
                            <select class="form-select" name="kode_kategori" aria-label="Default select example">
                                <option selected>Pilih Kategori</option>
                                {{-- @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                                @endforeach --}}
                                <option value="Harta">Harta</option>
                                <option value="Kendaraan">Kendaraan</option>
                            </select>
                        </div>
                        <input class="btn btn-outline-primary" type="submit" value="Tambah">
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection
