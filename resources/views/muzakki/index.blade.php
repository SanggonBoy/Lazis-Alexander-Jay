@extends('layouts.dashboard.main')

@section('content')
    @extends('layouts.dashboard.sidebar')
    @extends('layouts.dashboard.header')
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    
@endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">List of Muzakki</div>
                    @can('admin')<a href="muzakki/create">Tambah Data</a>@endcan

                    <div class="card-body">
                        <table class="table">   
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nomor Telepon</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($muzakki as $m)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $m->nama_muzakki}}</td>
                                        <td>{{ $m->no_telp }}</td>
                                        <td>{{ $m->jenis_kelamin }}</td>
                                        <td>{{ $m->tanggal_lahir }}</td>
                                        <td>
                                            <a href="/muzakki/{{$m->id}}/edit" onclick="return confirm('Apakah Anda yakin ingin mengedit data ini?')">Ubah</a>
                                            <form action="/muzakki/{{$m->id}}" method="POST" style="display: inline;">
                                            <form action="/muzakki/{{$m->id}}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                         </form>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @extends('layouts.dashboard.footer')
@endsection