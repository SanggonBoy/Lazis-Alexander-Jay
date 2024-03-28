@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Data Coa</h5>

            <!-- Display Error jika ada error -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- Akhir Display Error -->

                <!-- Awal Dari Input Form -->
                <form action="/amil/{{$amil->id}}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3"><label for="id_amil">Kode Amil</label>
                <input class="form-control form-control-solid" id="id_amil" name="kode_amil" type="text" value="{{$amil->kode_amil}}" readonly></div>

                <div class="mb-3"><label for="id_amil">Nama Amil</label>
                <input class="form-control form-control-solid" id="id_amil" name="nama_amil" type="text" value="{{$amil->nama_amil}}" readonly></div>

                <div class="mb-3"><label for="no_telp">Nomor Telepon</label>
                <input class="form-control form-control-solid" id="no_telp" name="no_telp" type="text" value="{{$amil->no_telp}}"></div>

                <div class="mb-0"><label for="alamat">Alamat</label>
                <input class="form-control form-control-solid" id="alamat" name="alamat" type="textarea" value="{{$amil->alamat}}"></div>
                <br>

                <div class="mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                            <option value="Laki-Laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <!-- untuk tombol simpan -->
                    
                    <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Ubah">

                    <!-- untuk tombol batal simpan -->
                    <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/amil') }}" role="button">Batal</a>
                    
                </form>
                <!-- Akhir Dari Input Form -->
            
          </div>
        </div>
      </div>
    
        
@endsection
