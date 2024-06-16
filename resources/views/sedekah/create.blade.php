@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Pembayaran Sedekah dan Infaq</h5>

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
            <form action="{{ route('pembayaransedekah.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="nama_pembayar" class="form-label">Nama Pembayar</label>
                    <input type="text" class="form-control" id="nama_pembayar" name="nama_pembayar" value="{{ auth()->user()->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="nominal" class="form-label">Nominal</label>
                    <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Masukkan Nominal" oninput="formatNominal(this)">
                </div>

                <div class="mb-3">
                    <label for="badan" class="form-label">Badan Amal</label>
                    <select class="form-control" id="badan" name="badan">
                        <option value="" selected disabled>Pilih Nama Badan Amal</option>
                        <option value="Sedekah Palestina">Sedekah Palestina</option>
                        <option value="Sedekah Anak Yatim">Sedekah Anak Yatim</option>
                        <option value="Infaq Pendidikan">Infaq Pendidikan</option>
                        <option value="Infaq Ekonomi">Infaq Ekonomi</option>
                        <option value="Infaq Kesehatan">Infaq Kesehatan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                    <input type="date" class="form-control" id="tanggal_pembayaran" name="tanggal_pembayaran">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                </div>
                <!-- untuk tombol simpan -->
                <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Simpan">

                <!-- untuk tombol batal simpan -->
                <a class="col-sm-1 btn btn-dark btn-sm" href="{{ url('/sedekah') }}" role="button">Batal</a>
            </form>
            <!-- Akhir Dari Input Form -->
        </div>
    </div>
</div>

<script>
    function formatNominal(input) {
        // Remove any characters that are not digits
        let value = input.value.replace(/\D/g, '');
        
        // Format the number with commas
        let formattedValue = new Intl.NumberFormat('id-ID').format(value);
        
        // Set the input value to the formatted value
        input.value = formattedValue;
    }
</script>

@endsection
