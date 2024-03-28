@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">List of Muzakki</div>
                    <a href="muzakki/create">Tambah Data</a>

                    <div class="card-body">
                        <table class="table">   
                            <thead>
                                <tr>
                                    <th>#</th>
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
                                            <a href="/muzakki/{{$m->id}}/edit">Edit</a>
                                            <form action="/muzakki/{{$m->id}}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
@endsection
