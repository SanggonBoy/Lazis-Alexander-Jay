@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')
    <h2 style="text-align: center;">Tambah Data</h2>
    <hr>
    <form action="/mustahik" method="post">
        @csrf
        <label for="">Kode Mustahik</label><br>
        <input type="text" name="kode_mustahik" required><br><br>

        <label for="">Nama Mustahik</label><br>
        <input type="text" name="nama_mustahik" required><br><br>

        <label for="">No Telpon</label><br>
        <input type="number" name="no_telp" required><br><br>

        <label for="">Alamat</label><br>
        <textarea type="text" name="alamat" required></textarea><br><br>

        <label for="">Jenis Kelamin</label><br>
        <select name="jenis_kelamin" id="">
            <option value="Laki-Laki">Laki-Laki</option>
            <option value="Perempuan">Perempuan</option>
        </select><br><br>

        <button class="btn btn-primary">Tambah</button>
    </form>
@endsection
