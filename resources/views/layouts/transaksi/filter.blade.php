@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="card-title fw-semibold mb-4">Data Transaksi</h5>
                            <div class="card">
                                <form action="/filter-transactions" method="POST">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-filter"></i></span>
                                        <select name="filter" class="form-select" aria-label="Default select example">
                                            <option disabled selected>Pilih Kategori</option>
                                            <option value="Semua" {{ request()->input('filter') == 'Semua' ? 'selected' : '' }}>Semua Kategori</option>
                                            <option value="Fidyah" {{ request()->input('filter') == 'Fidyah' ? 'selected' : '' }}>Fidyah</option>
                                            <option value="Sedekah" {{ request()->input('filter') == 'Sedekah' ? 'selected' : '' }}>Sedekah</option>
                                            <option value="Zakat Mal" {{ request()->input('filter') == 'Zakat Mal' ? 'selected' : '' }}>Zakat Mal</option>
                                            <option value="Zakat Fitrah" {{ request()->input('filter') == 'Zakat Fitrah' ? 'selected' : '' }}>Zakat Fitrah</option>
                                            <option value="Wakaf" {{ request()->input('filter') == 'Wakaf' ? 'selected' : '' }}>Wakaf</option>
                                        </select>
                                        <button type="submit" class="btn btn-outline-primary">Filter</button>
                                    </div>
                                </form>
                                <form action="/search-duplicate-transactions" method="POST">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                                        <input type="text" name="duplicate" class="form-control"
                                            placeholder="Kode Kategori" aria-label="Username"
                                            aria-describedby="basic-addon1">
                                        <button type="submit" class="btn btn-outline-primary">Cari</button>
                                    </div>
                                </form>
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Master Data Transaksi</h6>

                                    <!-- Tombol Tambah Data -->
                                    @can('admin')
                                        <button class="btn btn-primary btn-xs removeAll mb-3">Remove All Selected Data</button>
                                        <button data-bs-toggle="modal" data-bs-target="#checking-duplicate"
                                            class="btn btn-primary btn-icon-split btn-sm">
                                            <span class="icon text-white-200 me-1">
                                                <i class="fa fa-refresh"></i>
                                            </span>
                                            <span class="text">Cek Transaksi Terduplikat</span>
                                        </button>
                                        <div class="modal fade" id="checking-duplicate" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Daftar Transaksi
                                                            yang Terduplikat</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="dataTable" width="100%"
                                                                cellspacing="0">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Kode Transaksi</th>
                                                                        <th>Salin</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($duplikat as $m)
                                                                        <tr>
                                                                            <td>{{ $loop->iteration }}</td>
                                                                            <td>
                                                                                <textarea class="copy-data">{{ $m->kode_transaksi }}</textarea>
                                                                            </td>
                                                                            <td>
                                                                                <button class="copy-button"
                                                                                    onclick="copyToClipboard(this)">Copy</button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endcan
                                    <!-- Akhir Tombol Tambah Data -->

                                </div>

                                <div class="card-body">
                                    <!-- Awal Dari Tabel -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th><input type="checkbox" id="checkboxesMain"></th>
                                                    <th>No</th>
                                                    <th>Kode Transaksi</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Email</th>
                                                    <th>Nominal</th>
                                                    <th>Jenis Transaksi</th>
                                                    <th>Status Pembayaran</th>
                                                    @can('admin')
                                                        <th colspan="2">Action</th>
                                                    @endcan
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transaksi as $m)
                                                    <tr>
                                                        <td><input type="checkbox" class="checkbox"
                                                                data-id="{{ $m->id }}"></td>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $m->kode_transaksi }}</td>
                                                        <td>{{ $m->full_name }}</td>
                                                        <td>{{ $m->email }}</td>
                                                        <td>Rp. {{ number_format($m->nominal, 0, ',', '.') }},-</td>
                                                        <td>{{ $m->jenis_transaksi }}</td>
                                                        <td
                                                            class="{{ $m->status_pembayaran === 'berhasil' ? 'badge text-bg-success m-3' : 'badge text-bg-danger m-3' }}">
                                                            {{ $m->status_pembayaran }}</td>
                                                        @can('admin')
                                                            <td>
                                                                <a href="/transaksi/{{ $m->id }}/edit"
                                                                    class="btn btn-success btn-icon-split btn-sm">
                                                                    <span class="icon text-white-50">
                                                                        <i class="ti ti-check"></i>
                                                                    </span>
                                                                    <span class="text">Ubah</span>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="/transaksi/{{ $m->id }}"
                                                                    onclick="deleteConfirm(this); return false;"
                                                                    data-id="{{ $m->id }}"
                                                                    class="btn btn-danger btn-icon-split btn-sm">
                                                                    <span class="icon text-white-50">
                                                                        <i class="ti ti-minus"></i>
                                                                    </span>
                                                                    <span class="text">Hapus</span>
                                                                </a>
                                                            </td>
                                                        @endcan
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function deleteConfirm(e) {
                            var tomboldelete = document.getElementById('btn-delete')
                            id = e.getAttribute('data-id');

                            var url3 = "{{ url('transaksi/destroy/') }}";
                            var url4 = url3.concat("/", id);

                            tomboldelete.setAttribute("href", url4);

                            var pesan = "Data dengan ID <b>"
                            var pesan2 = " </b>akan dihapus"
                            var res = id;
                            document.getElementById("xid").innerHTML = pesan.concat(res, pesan2);

                            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
                                keyboard: false
                            });

                            myModal.show();

                        }
                    </script>

                    <script>
                        document.getElementById('copy-button').addEventListener('click', function() {
                            var data = document.getElementById('copy-data').value;
                            navigator.clipboard.writeText(data).then(function() {
                                console.log('Copying to Clipboard: ', data);
                            }, function(err) {
                                console.error('Failed to Copy: ', err);
                            });
                        });

                        function copyToClipboard(button) {
                            var data = $(button).closest('tr').find('.copy-data').val();
                            navigator.clipboard.writeText(data).then(function() {
                                console.log('Copying to Clipboard: ', data);
                            }, function(err) {
                                console.error('Failed to Copy: ', err);
                            });
                        }
                    </script>

                    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $('#checkboxesMain').on('click', function(e) {
                                if ($(this).is(':checked', true)) {
                                    $(".checkbox").prop('checked', true);
                                } else {
                                    $(".checkbox").prop('checked', false);
                                }
                            });
                            $('.checkbox').on('click', function() {
                                if ($('.checkbox:checked').length == $('.checkbox').length) {
                                    $('#checkboxesMain').prop('checked', true);
                                } else {
                                    $('#checkboxesMain').prop('checked', false);
                                }
                            });
                            $('.removeAll').on('click', function(e) {
                                var userIdArr = [];
                                $(".checkbox:checked").each(function() {
                                    userIdArr.push($(this).attr('data-id'));
                                });
                                if (userIdArr.length <= 0) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Pilih minimal satu data',
                                        text: 'Anda belum memilih data apapun',
                                        timer: 3000
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Apakah anda yakin?',
                                        html: 'Ingin menghapus data yang terpilih?, <span class="fw-bold text-danger">Sisakan SATU DATA ketika mengoreksi transaksi yang terduplikat</span>',
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonText: 'Hapus',
                                        cancelButtonText: 'Batal'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            var stuId = userIdArr.join(",");
                                            $.ajax({
                                                url: "{{ url('delete-all') }}",
                                                type: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                                        'content')
                                                },
                                                data: {
                                                    _method: 'POST',
                                                    ids: stuId
                                                },
                                                success: function(response) {
                                                    if (response.status == true) {
                                                        Swal.fire('Berhasil!',
                                                            'Data telah berhasil dihapus.', 'uccess'
                                                            );
                                                        window.location.href =
                                                            "{{ url('/checking-transaction') }}"; // Arahkan ke rute setelah penghapusan berhasil
                                                    } else {
                                                        Swal.fire('Error!', 'Error occurred.', 'error');
                                                    }
                                                },
                                                error: function(err) {
                                                    console.error(err);
                                                    Swal.fire('Error!', 'Terdapat Kesalahan.', 'error');
                                                }
                                            });
                                        }
                                    });
                                }
                            });
                        });
                    </script>

                    <!-- Logout Delete Confirmation-->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                        x
                                    </button>
                                </div>
                                <div class="modal-body" id="xid"></div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endsection
