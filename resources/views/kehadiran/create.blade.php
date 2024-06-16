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
                    <h5 class="card-title fw-semibold mb-4">Data Absen Amil</h5>

                    <!-- Display Error jika ada error -->
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <!-- Akhir Display Error -->

                    <!-- Awal Dari Input Form -->
                    @if ($data->isEmpty())
                    <p class="d-block text-center text-info border rounded border-info mb-5 mt-5 fw-semibold text-lg">Data Kehadiran Karyawan Telah Terinput Semua.</p>
                    <a href="/kehadiran" class="btn btn-warning fw-semibold text-lg d-block mt-5 rounded">Kembali.</a>
                    @else
                    <form action="/kehadiran" method="post">
                        @csrf
                        <table class="table">
                            <thead>
                                <th>
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
                                            <td><input type="hidden" name="kode_amil[{{ $m->id }}]"
                                                    value="{{ $m->id }}">{{ $m->kode_amil }}</td>
                                            <td><input type="hidden" name="nama_amil[{{ $m->id }}]"
                                                    value="{{ $m->nama_amil }}">{{ $m->nama_amil }}</td>
                                            <td><input type="hidden" name="email[{{ $m->id }}]"
                                                    value="{{ $m->email }}">{{ $m->email }}</td>
                                            <td>
                                                <input type="radio" name="kehadiran[{{ $m->id }}]" checked
                                                    value="ALPA">
                                                Alpa
                                                <input type="radio" name="kehadiran[{{ $m->id }}]" value="SAKIT">
                                                Sakit
                                                <input type="radio" name="kehadiran[{{ $m->id }}]" value="HADIR">
                                                Hadir
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- untuk tombol simpan -->
                            <input class="col-sm-1 btn btn-outline-success btn-sm" type="submit" value="Simpan">
                            
                            <!-- untuk tombol batal simpan -->
                            <a class="col-sm-1 btn btn-outline-dark btn-sm" href="/kehadiran" role="button">Batal</a>
                        </form>
                        @endif


                    <!-- Akhir Dari Input Form -->

                </div>
            </div>
        </div>

        </div>
    @endcan
@endsection
