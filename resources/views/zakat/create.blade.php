@extends('layouts.dashboard.main')
<!-- @extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer') -->

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Pembayaran Zakat</h5>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('pembayaranzakat.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_muzakki">Nama Muzakki</label>
                    <select class="form-control form-control-solid" id="nama_muzakki" name="nama_muzakki">
                        <option value="" selected disabled>Pilih Nama Muzakki</option>
                        @foreach ($muzakkis as $muzakki)
                        <option value="{{ $muzakki->id }}">{{ $muzakki->nama_muzakki }}</option>
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

                <div id="fitrahInput" style="display: none;">
                    <div class="mb-3">
                        <label for="banyak_orang">Banyaknya Orang</label>
                        <select class="form-control form-control-solid" id="banyak_orang" name="banyak_orang">
                            <option value="" selected disabled>Pilih Banyaknya Orang</option>
                            @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nominal">Nominal</label>
                        <input type="text" class="form-control form-control-solid" id="nominal_fitrah" name="nominal" readonly>
                    </div>
                </div>

                <div id="malInput" style="display: none;">
                    <div class="mb-3">
                        <label for="harta_dimiliki">Harta yang Dimiliki</label>
                        <input type="text" class="form-control form-control-solid" id="harta_dimiliki" name="harta_dimiliki">
                    </div>
                    <div class="mb-3">
                        <label for="nominal">Nominal</label>
                        <input type="text" class="form-control form-control-solid" id="nominal_mal" name="nominal" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
                    <input type="date" class="form-control form-control-solid" id="tanggal_pembayaran" name="tanggal_pembayaran">
                </div>
                <div class="mb-3">
                    <label for="bukti_pembayaran">Bukti Pembayaran</label>
                    <input type="file" accept="image/*" class="form-control form-control-solid" id="bukti_pembayaran" name="bukti_pembayaran">
                </div>

                <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Simpan">
                <a class="col-sm-1 btn btn-dark btn-sm" href="{{ url('/zakat') }}" role="button">Batal</a>
            </form>

            <script>
                document.getElementById('jenis_zakat').addEventListener('change', function() {
                    var fitrahInput = document.getElementById('fitrahInput');
                    var malInput = document.getElementById('malInput');
                    var selectedValue = this.value;

                    if (selectedValue === 'Zakat Fitrah') {
                        fitrahInput.style.display = 'block';
                        malInput.style.display = 'none';
                    } else if (selectedValue === 'Zakat Mal') {
                        fitrahInput.style.display = 'none';
                        malInput.style.display = 'block';
                    }
                });

                document.getElementById('banyak_orang').addEventListener('change', function() {
                    var nominalInput = document.getElementById('nominal_fitrah');
                    var banyakOrang = parseInt(this.value);
                    var nominal = banyakOrang * 45000;
                    nominalInput.value = new Intl.NumberFormat('id-ID').format(nominal);
                });

                document.getElementById('harta_dimiliki').addEventListener('input', function() {
                    var nominalInput = document.getElementById('nominal_mal');
                    var hartaDimiliki = parseFloat(this.value.replace(/\D/g, ''));
                    var nominal = hartaDimiliki * 0.025;
                    nominalInput.value = new Intl.NumberFormat('id-ID').format(nominal);
                });

                function formatNumberInput(input) {
                    input.addEventListener('input', function() {
                        var value = this.value.replace(/\D/g, '');
                        this.value = new Intl.NumberFormat('id-ID').format(value);
                    });
                }

                formatNumberInput(document.getElementById('harta_dimiliki'));
            </script>
        </div>
    </div>
</div>

@endsection
