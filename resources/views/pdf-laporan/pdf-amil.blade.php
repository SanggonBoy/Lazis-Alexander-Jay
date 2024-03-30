@extends('layouts/pdf/main')

@section('content')
    <h2 style="text-align: center;">Tabel Amil</h2>
    <hr>

    @can('admin')
        {{-- <a class="badge text-bg-primary mb-5 mt-2 p-2" href="/barang/create">Tambah Barang</a> --}}
    @endcan

    <table class="table" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Amil</th>
                <th>Nama</th>
                <th>Nomor Telepon</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php $count = 1;
            ?>
            @foreach ($amil as $m)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $m->kode_amil }}</td>
                    <td>{{ $m->nama_amil }}</td>
                    <td>0{{ $m->no_telp }}</td>
                    <td>{{ $m->alamat }}</td>
                    <td>{{ $m->jenis_kelamin }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
