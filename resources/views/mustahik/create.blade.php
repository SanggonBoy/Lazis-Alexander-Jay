@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')
    @can('karyawan')
        <h1 class="display-4">Anda tidak memiliki akses kesini!</h1>
    @endcan
    @can('amil')
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Data Mustahik</h5>

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
                    <form action="/mustahik" method="post" id="mustahikForm">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_mustahik" class="form-label">Nama Mustahik</label>
                            <input class="form-control form-control-solid" id="nama_mustahik" name="nama_mustahik"
                                type="text" placeholder="Nama Mustahik">
                        </div>

                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No Telp</label>
                            <input class="form-control form-control-solid" id="no_telp" name="no_telp" type="number"
                                placeholder="No. Telpon">
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input list="alamat-list" class="form-control form-control-solid" id="alamat" name="alamat"
                                type="text" placeholder="Alamat">
                            <datalist id="alamat-list"></datalist>
                        </div>

                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <br>
                        <!-- untuk tombol simpan -->
                        <input class="col-sm-1 btn btn-outline-success btn-sm" type="submit" value="Simpan">

                        <!-- untuk tombol batal simpan -->
                        <a class="col-sm-1 btn btn-outline-dark  btn-sm" href="/mustahik" role="button">Batal</a>
                    </form>
                    <!-- Akhir Dari Input Form -->

                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'info',
                    title: 'Perhatian',
                    text: 'Silakan input alamat berdasarkan data yang muncul untuk mempermudah pencarian.',
                    confirmButtonText: 'Mengerti'
                });

                $('#alamat').on('input', function() {
                    let keyword = $(this).val();
                    if (keyword.length > 2) {
                        $.ajax({
                            url: '{{ route('api.cari-alamat') }}',
                            type: 'GET',
                            data: {
                                keyword: keyword
                            },
                            success: function(data) {
                                let datalist = $('#alamat-list');
                                datalist.empty();
                                if (data.result && data.result.length > 0) {
                                    data.result.forEach(function(item) {
                                        let address =
                                            `${item.desakel}, ${item.kecamatan}, ${item.kabkota}, ${item.provinsi}, ${item.negara}`;
                                        datalist.append('<option value="' + address + '">');
                                    });
                                }
                            }
                        });
                    }
                });
            });
        </script>
    @endcan
@endsection
