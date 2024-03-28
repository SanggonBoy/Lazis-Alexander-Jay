@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')
    <h2 style="text-align: center;">Tabel Barang</h2>
    <hr>

    @can('admin') <a class="badge text-bg-primary mb-5 mt-2 p-2" href="/barang/create">Tambah Barang</a> @endcan

    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th style="border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;">No</th>
                <th style="border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;">Kode Barang</th>
                <th style="border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;">Kategori Barang</th>
                <th style="border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;">Nama Barang</th>
                @can('admin')<th style='border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;' colspan="2">Opsi</th>@endcan
            </tr>
        </thead>
        <tbody>
            <?php $count = 1;
            ?>
            @foreach ($barang as $b)
                <tr>
                    <td style="border: 1px solid #dddddd; padding: 8px;">{{ $count++ }}</td>
                    <td style="border: 1px solid #dddddd; padding: 8px;">{{ $b->kategori->kode_kategori }}</td>
                    <td style="border: 1px solid #dddddd; padding: 8px;">{{ $b->kategori->kategori }}</td>
                    <td style="border: 1px solid #dddddd; padding: 8px;">{{ $b->nama_barang }}</td>
                    @can('admin')<td style="border: 1px solid #dddddd; padding: 8px;"><a class="badge text-bg-warning border-0"
                            href="/barang/{{ $b->id }}/edit">
                            Edit
                        </a></td>
                    <td style="border: 1px solid #dddddd; padding: 8px;">
                        <form action="/barang/{{ $b->id }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="badge text-bg-danger border-0">Hapus</button>
                        </form>
                    </td>@endcan
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
