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
                        <h5 class="card-title fw-semibold mb-4">Pembayaran wakaf</h5>
                        <div class="card">

                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Transaksi Pembayaran wakaf</h6>

                                <!-- <a href="{{ url('/wakaf/create') }}" class="btn btn-primary btn-icon-split btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="ti ti-plus"></i>
                                    </span>
                                    <span class="text">Tambah Transaksi</span>
                                </a> -->
                            </div>

                            <div class="card-body">
                                <!-- Awal Dari Tabel -->
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="thead-white">

                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pewakaf</th>
                                                <th>Jenis Wakaf</th>
                                                <th>Nominal</th>
                                                <th>Tanggal Pembayaran</th>
                                                <th>Email</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($wakaf as $f)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $f->nama_pewakaf }}</td>
                                                <td>{{ $f->jenis_wakaf }}</td>
                                                <td>Rp {{ number_format($f->nominal, 0, ',', '.') }}</td>
                                                <td>{{ $f->tanggal_pembayaran}}</td>
                                                <td>{{ $f->email }}</td>
                                                <td>
                                                    <a href="#" onclick="deleteConfirm(this); return false;" nama_akun="{{ $f->nama_pewakaf }}" data-id="{{ $f->id }}" class="btn btn-danger btn-icon-split btn-sm">
                                                        <span class="icon text-white-50">
                                                            <i class="ti ti-minus"></i>
                                                        </span>
                                                        <span class="text">Hapus</span>
                                                        </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Akhir Dari Tabel -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
                        function deleteConfirm(e) {
                            var tomboldelete = document.getElementById('btn-delete')
                            id = e.getAttribute('data-id');
                            nama_akun = e.getAttribute('nama_akun');

                            // const str = 'Hello' + id + 'World';
                            var url3 = "{{ url('wakaf/destroy/') }}";
                            var url4 = url3.concat("/", id);
                            // console.log(url4);

                            // console.log(id);
                            // var url = "{{ url('coa/destroy/"+id+"') }}";

                            // url = JSON.parse(rul.replace(/"/g,'"'));
                            tomboldelete.setAttribute("href", url4); //akan meload kontroller delete

                            var pesan = "Data dengan Nama Pewakaf <b>"
                            var pesan2 = " </b>akan dihapus"
                            var res = nama_akun;
                            document.getElementById("xid").innerHTML = pesan.concat(res, pesan2);

                            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
                                keyboard: false
                            });

                            myModal.show();

                        }
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
                                    <button class="btn btn-outline-secondary" type="button"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <a id="btn-delete" class="btn btn-outline-danger" href="#">Hapus</a>

                                </div>
                            </div>
                        </div>
                    </div>


@endsection