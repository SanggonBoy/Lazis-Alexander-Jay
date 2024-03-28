@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')
    <h1>Ubah Data</h1>
    <form action="/barang/{{ $barang->id }}" method="post">
        @method('patch')
        @csrf
        <label for="">Nama Barang</label><br>
        <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required><br><br>
        <label for="">Nama Kategori</label><br>
        <select name="kode_kategori" id="" required>
            <option>Pilih Kategori</option>
            @foreach ($kategori as $k)
                <option value="{{ $k->id }}">{{ $k->kategori }}</option>
            @endforeach
        </select><br><br>
        <input type="submit" value="Tambah">
    </form>
@endsection
