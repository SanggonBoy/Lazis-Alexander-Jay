@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')
    <h2 style="text-align: center;">Tabel Kategori</h2>
    <hr>

    @can('admin')<a class="badge text-bg-primary mb-5 mt-2 p-2" href="/kategori/create">Tambah Kategori</a>@endcan

    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th style="border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;">No</th>
                <th style="border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;">Kode Kategori</th>
                <th style="border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;">Nama Kategori</th>
                {{-- <th style='border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px; collspan: "2";'>Opsi</th> --}}
            </tr>
        </thead>
        <tbody>
            <?php $count = 1;
            ?>
            @foreach ($kategori as $k)
                <tr>
                    <td style="border: 1px solid #dddddd; padding: 8px;">{{ $count++ }}</td>
                    <td style="border: 1px solid #dddddd; padding: 8px;">KGR-{{ $k->kode_kategori }}</td>
                    <td style="border: 1px solid #dddddd; padding: 8px;">{{ $k->kategori }}</td>
                    <td style="border: 1px solid #dddddd; padding: 8px;"><a class="badge text-bg-warning border-0"
                            href="/kategori/{{ $k->id }}/edit">
                            Edit
                        </a></td>
                    <td style="border: 1px solid #dddddd; padding: 8px;">
                        <form action="/kategori/{{ $k->id }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="badge text-bg-danger border-0">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
