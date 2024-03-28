@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')
    <h2 style="text-align: center;">Tabel Mustahik</h2>
    <hr>

    <a class="badge text-bg-primary mb-5 mt-2 p-2" href="/mustahik/create">Tambah Mustahik</a>

    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th style="border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;">No</th>
                <th style="border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;">ID Mustahik</th>
                <th style="border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;">Nama Mustahik</th>
                <th style="border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;">No Telpon</th>
                <th style="border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;">Alamat</th>
                <th style="border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;">Jenis Kelamin</th>
                <th style='border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px; collspan: "2";'>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php $count = 1;
            ?>
            @foreach ($mustahik as $a)
                <tr>
                    <td style="border: 1px solid #dddddd; padding: 8px;">{{ $count++ }}</td>
                    <td style="border: 1px solid #dddddd; padding: 8px;">MTHK-{{ $a->kode_mustahik }}</td>
                    <td style="border: 1px solid #dddddd; padding: 8px;">{{ $a->nama_mustahik }}</td>
                    <td style="border: 1px solid #dddddd; padding: 8px;">0{{ $a->no_telp }}</td>
                    <td style="border: 1px solid #dddddd; padding: 8px;">{{ $a->alamat }}</td>
                    <td style="border: 1px solid #dddddd; padding: 8px;">{{ $a->jenis_kelamin }}</td>
                    <td style="border: 1px solid #dddddd; padding: 8px;">
                        <a class="badge text-bg-success" href="/mustahik/{{ $a->id }}/edit">
                            Edit
                        </a></td>
                    <td style="border: 1px solid #dddddd; padding: 8px;">
                        <form action="/mustahik/{{ $a->id }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="badge text-bg-danger border-0">Hapus</button>
                        </form>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
