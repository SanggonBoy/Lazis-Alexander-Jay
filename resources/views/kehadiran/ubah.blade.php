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
                    <h5 class="card-title fw-semibold mb-4">Edit Data Absen Amil</h5>

                    <!-- Display Error jika ada error -->
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <!-- Akhir Display Error -->

                    <!-- Awal Dari Input Form -->
                    <form action="/ubahAbsen" method="post">
                        @method('put')
                        @csrf
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kode Amil</th>
                                    <th scope="col">Nama Amil</th>
                                    <th scope="col">Email Amil</th>
                                    <th colspan="2">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $m)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            <input type="hidden" name="kode[{{ $m->kode_amil }}]" value="{{ $m->kode_amil }}">
                                            {{ $m->amil->kode_amil }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="name[{{ $m->kode_amil }}]" value="{{ $m->name }}">
                                            {{ $m->name }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="email[{{ $m->kode_amil }}]" value="{{ $m->email }}">
                                            {{ $m->email }}
                                        </td>
                                        <td>
                                            <input type="radio" name="kehadiran[{{ $m->kode_amil }}]" value="ALPA"
                                                id="alpa-{{ $m->kode_amil }}"> Alpa
                                            <input type="radio" name="kehadiran[{{ $m->kode_amil }}]" value="SAKIT"
                                                id="sakit-{{ $m->kode_amil }}"> Sakit
                                            <input type="radio" name="kehadiran[{{ $m->kode_amil }}]" value="HADIR"
                                                id="hadir-{{ $m->kode_amil }}"> Hadir
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <!-- untuk tombol simpan -->
                        <input class="col-sm-1 btn btn-outline-success btn-sm" type="submit" value="Edit">

                        <!-- untuk tombol batal simpan -->
                        <a class="col-sm-1 btn btn-outline-dark  btn-sm" href="/kehadiran" role="button">Batal</a>
                    </form>
                    <!-- Akhir Dari Input Form -->

                </div>
            </div>
        </div>

        </div>

        <script>
            @foreach ($data as $m)
                var kehadiran = '{{ $m->kehadiran }}';
                switch (kehadiran) {
                    case 'ALPA':
                        document.getElementById('alpa-{{ $m->kode_amil }}').checked = true;
                        break;
                    case 'SAKIT':
                        document.getElementById('sakit-{{ $m->kode_amil }}').checked = true;
                        break;
                    case 'HADIR':
                        document.getElementById('hadir-{{ $m->kode_amil }}').checked = true;
                        break;
                }
            @endforeach
        </script>
    @endcan
@endsection
