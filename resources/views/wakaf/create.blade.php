@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Transaksi Wakaf</h5>

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
            <form action="{{ route('wakaf.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="nama_pewakaf" class="form-label">Nama Pewakaf</label>
                    <input type="text" class="form-control" id="nama_pewakaf" name="nama_pewakaf" value="{{ auth()->user()->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="jenis_wakaf" class="form-label">Jenis Wakaf</label>
                    <select class="form-control form-control-solid" id="jenis_wakaf" name="jenis_wakaf">
                        <option value="" selected disabled>Pilih Jenis Wakaf</option>
                        <option value="Wakaf Masjid">Wakaf Masjid</option>
                        <option value="Wakaf Al-Qur'an">Wakaf Al-Qur'an</option>
                        <option value="Wakaf Tanah">Wakaf Tanah</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nominal" class="form-label">Nominal</label>
                    <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Masukkan Nominal" oninput="formatNominal(this)">
                    <small class="text-danger">Nominal harus lebih dari 10.000</small>
                    <!-- <small class="form-text text-muted" style="color: red; font-style: italic;">Masukkan jumlah nominal lebih dari 10.000</small> -->
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
                <a class="col-sm-1 btn btn-dark btn-sm" href="{{ url('/wakaf') }}" role="button">Batal</a>
        </div>
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