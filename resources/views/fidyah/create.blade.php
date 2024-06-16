@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Pembayaran Fidyah</h5>

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
            <form action="{{ route('fidyah.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="nama_pembayar" class="form-label">Nama Pembayar</label>
                    <input type="text" class="form-control" id="nama_pembayar" name="nama_pembayar" value="{{ auth()->user()->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="jumlah_hari">Jumlah Hari</label>
                    <select class="form-control form-control-solid" id="jumlah_hari" name="jumlah_hari" onchange="calculateNominal()">
                        <option value="" selected disabled>Pilih Jumlah Hari</option>
                        @for ($i = 1; $i <= 30; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nominal" class="form-label">Nominal</label>
                    <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Masukkan Nominal" readonly>
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
                <a class="col-sm-1 btn btn-dark btn-sm" href="{{ url('/fidyah') }}" role="button">Batal</a>
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

    function calculateNominal() {
        let jumlahHari = document.getElementById('jumlah_hari').value;
        let nominal = jumlahHari * 60000;

        document.getElementById('nominal').value = new Intl.NumberFormat('id-ID').format(nominal);
    }
</script>

@endsection
