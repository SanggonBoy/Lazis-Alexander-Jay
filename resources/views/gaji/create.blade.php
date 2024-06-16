@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Penggajian Periode {{ $periode }}</h5>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/gaji" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 form-group">
                        <label class="fw-semibold" for="amil_id">Nama Karyawan</label>
                        <select name="kode_amil" id="amil_id" class="form-control" required
                            {{ $amils->isEmpty() ? 'disabled' : '' }}>
                            @if ($amils->isEmpty())
                                <option value="">Semua Data Karyawan Periode {{ $periode }} Telah Dicatat
                                </option>
                            @else
                                <option value="">Pilih Karyawan</option>
                            @endif
                            @foreach ($amils as $amil)
                                <option value="{{ $amil->id }}">{{ $amil->nama_amil }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 form-group">
                        <label class="fw-semibold" for="jumlah_alpa">Jumlah Alpa dalam satu Periode</label>
                        <input type="number" name="jumlah_alpa" value="0" id="jumlah_alpa" class="form-control fw-semibold text-info text-lg"
                            placeholder="Pilih Karyawan Untuk Mengetahui Jumlah Alpa" readonly required>
                    </div>

                    <div class="mb-3 form-group">
                        <label class="fw-semibold" for="transport">Uang Transport</label>
                        <input type="text" class="form-control form-control-solid" id="transport" name="transport"
                            placeholder="Masukkan Nominal" oninput="formatRupiah(this)">
                    </div>

                    <div class="mb-3 form-group">
                        <label class="fw-semibold" for="makan">Uang Makan</label>
                        <input type="text" class="form-control form-control-solid" id="makan" name="makan"
                            placeholder="Masukkan Nominal" oninput="formatRupiah(this)">
                    </div>

                    <div class="mb-3 form-group">
                        <label class="fw-semibold" for="lembur">Uang Lembur</label>
                        <input type="text" class="form-control form-control-solid" id="lembur" name="lembur"
                            placeholder="Masukkan Nominal" oninput="formatRupiah(this)">
                    </div>

                    <div class="mb-3 form-group">
                        <label class="fw-semibold" for="bonus">Bonus</label>
                        <input type="text" class="form-control form-control-solid" id="bonus" name="bonus"
                            placeholder="Masukkan Nominal" oninput="formatRupiah(this)">
                    </div>

                    <div class="mb-3 form-group">
                        <label class="fw-semibold" for="tunjangan">Tunjangan Lainnya</label>
                        <input type="text" class="form-control form-control-solid" id="tunjangan" name="tunjangan"
                            placeholder="Masukkan Nominal" oninput="formatRupiah(this)">
                    </div>

                    <input class="col-sm-1 btn btn-outline-success btn-sm" type="submit" value="Simpan">
                    <a class="col-sm-1 btn btn-outline-dark btn-sm" href="{{ url('/gaji') }}" role="button">Batal</a>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const amilDropdown = document.getElementById('amil_id');
            const jumlahAlpaInput = document.getElementById('jumlah_alpa');

            amilDropdown.addEventListener('change', function() {
                const amilId = this.value;

                if (amilId) {
                    fetch(`/gaji/alpa/${amilId}`)
                        .then(response => response.json())
                        .then(data => {
                            jumlahAlpaInput.value = data.jumlah_alpa;
                        })
                        .catch(error => console.error('Gagal Mendapatkan Data Alpa Karyawan:', error));
                } else {
                    jumlahAlpaInput.value = '';
                }
            });

            function formatNumberInput(input) {
                input.addEventListener('input', function() {
                    var value = this.value.replace(/\D/g, '');
                    this.value = new Intl.NumberFormat('id-ID').format(value);
                });
            }

            const rupiah = document.querySelectorAll(
                'input[name="transport"], input[name="makan"], input[name="lembur"], input[name="bonus"], input[name="tunjangan"]'
            );

            rupiah.forEach(input => {
                formatNumberInput(input);
            });
        });
    </script>

@endsection
