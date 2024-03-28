@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')
    @can('karyawan')<h1 class="display-4">Anda tidak memiliki akses kesini!</h1>@endcan
    @can('admin')
    <h1>Tambah Data</h1>
    <form action="/barang" method="post">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang"
            id="exampleFormControlInput2">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Nama Kategori</label>
            <select class="form-select" name="kode_kategori" aria-label="Default select example">
                <option selected>Pilih Kategori</option>
                @foreach ($kategori as $k)
                <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                @endforeach
            </select>
        </div>
        <input class="btn btn-primary" type="submit" value="Tambah">
    </form>
    @endcan
@endsection
