@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Penyerahan Zakat</h5>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('penyerahan.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_amil">Nama amil</label>
                        <select class="form-control form-control-solid" id="nama_amil" name="nama_amil">
                            <option value="" selected disabled>Pilih Nama amil</option>
                            @foreach ($amil as $a)
                                <option value="{{ $a->id }}">{{ $a->nama_amil }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_mustahik">Nama Mustahik</label>
                        <select class="form-control form-control-solid" id="nama_mustahik" name="nama_mustahik">
                            <option value="" selected disabled>Pilih Nama Mustahik</option>
                            @foreach ($mustahik as $m)
                                <option value="{{ $m->id }}">{{ $m->nama_mustahik }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_zakat">Jenis Zakat</label>
                        <select class="form-control form-control-solid" id="jenis_zakat" name="jenis_zakat" required>
                            <option value="" selected disabled>Pilih Jenis Zakat</option>
                            <option value="Zakat Fitrah">Zakat Fitrah</option>
                            <option value="Zakat Mal">Zakat Mal</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah">Nominal</label>
                        <input type="text" class="form-control form-control-solid" id="jumlah" name="jumlah"
                            placeholder="Masukkan Nominal">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
                        <input type="date" class="form-control form-control-solid" id="tanggal_pembayaran"
                            name="tanggal_pembayaran">
                    </div>
                    <input class="col-sm-1 btn btn-outline-success btn-sm" type="submit" value="Simpan">
                    <a class="col-sm-1 btn btn-outline-dark btn-sm" href="{{ url('/penyerahan') }}" role="button">Batal</a>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('jumlah').addEventListener('input', function(e) {
            var value = e.target.value;
            value = value.replace(/,/g, ''); // Remove any existing commas
            value = Number(value).toLocaleString('en'); // Format the number
            e.target.value = value;
        });
    </script>

@endsection
