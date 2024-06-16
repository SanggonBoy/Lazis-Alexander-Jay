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
                            <h5 class="card-title fw-semibold mb-4">Amil</h5>
                            <div class="card">
                                <button id="tutorAmil" class="btn btn-primary mb-3 d-block">
                                    <i class="fa fa-question-circle me-1" aria-hidden="true"></i>Info
                                </button>
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Master Data Amil</h6>

                                    <!-- Tombol Tambah Data -->
                                    @can('admin')
                                        <a id="tambahAmil" href="{{ url('/amil/create') }}" class="btn btn-primary btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                                <i class="ti ti-plus"></i>
                                            </span>
                                            <span class="text">Tambah Data</span>
                                        </a>
                                    @endcan
                                    <!-- Akghir Tombol Tambah Data -->

                                </div>


                                <div class="card-body">
                                    <!-- Awal Dari Tabel -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead id="dataAmil" class="thead-white">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Amil</th>
                                                    <th>Nama Amil</th>
                                                    <th>Email</th>
                                                    <th>Nomor Telepon</th>
                                                    <th>Alamat</th>
                                                    <th>Jenis Kelamin</th>
                                                    @can('admin')
                                                        <th colspan="2" class="m-1">Action</th>
                                                    @endcan
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($amil as $m)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $m->kode_amil }}</td>
                                                        <td>{{ $m->nama_amil }}</td>
                                                        <td>{{ $m->email }}</td>
                                                        <td>{{ $m->no_telp }}</td>
                                                        <td>{{ $m->alamat }}</td>
                                                        <td>{{ $m->jenis_kelamin }}</td>
                                                        @can('admin')
                                                            <td>
                                                                <a id="editAmil" href="/amil/{{ $m->id }}/edit"
                                                                    class="btn m-1 btn-success btn-icon-split btn-sm mr-1">
                                                                    <span class="icon text-white-50">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </span>
                                                                </a>
                                                                {{-- <a href="#" onclick="deleteConfirm(this); return false;"
                                                                    nama_akun="{{ $m->nama_amil }}"
                                                                    data-id="{{ $m->id }}"
                                                                    class="btn btn-danger btn-icon-split btn-sm">
                                                                    <span class="icon text-white-50">
                                                                        <i class="ti ti-minus"></i>
                                                                    </span>
                                                                    <span class="text">Hapus</span>
                                                                    </form> --}}
                                                                <a id="hapusAmil" href="/amil/destroy/{{ $m->id }}"
                                                                    data-id="{{ $m->kode_amil }}"
                                                                    data-name="{{ $m->nama_amil }}"
                                                                    class="btn m-1 btn-danger btn-icon-split btn-sm btn-hapus">
                                                                    <span class="icon text-white-50">
                                                                        <i class="fa fa-trash"></i>
                                                                    </span></a>
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

                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('.btn-hapus').on('click', function(e) {
                                e.preventDefault();

                                let id = $(this).data('id');
                                let name = $(this).data('name');

                                let url = $(this).attr('href');

                                Swal.fire({
                                    title: 'Konfirmasi Hapus Data',
                                    html: `Penghapusan Data Dapat Dilakukan Apabila Karyawan <span class="text-info fw-semibold">${name}</span> Dengan Kode <span class="text-info fw-semibold">${id}</span> Telah Dikeluarkan.`,
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Ya, Hapus',
                                    cancelButtonText: 'Tidak'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = url;
                                    }
                                });
                            });
                        });
                    </script>

                    {{-- <script>
                        function deleteConfirm(e) {
                            var tomboldelete = document.getElementById('btn-delete')
                            id = e.getAttribute('data-id');
                            nama_akun = e.getAttribute('nama_akun');

                            // const str = 'Hello' + id + 'World';
                            var url3 = "{{ url('amil/destroy/') }}";
                            var url4 = url3.concat("/", id);
                            // console.log(url4);

                            // console.log(id);
                            // var url = "{{ url('coa/destroy/"+id+"') }}";

                            // url = JSON.parse(rul.replace(/"/g,'"'));
                            tomboldelete.setAttribute("href", url4); //akan meload kontroller delete

                            var pesan = "Data dengan Nama Amil <b>"
                            var pesan2 = " </b>akan dihapus"
                            var res = nama_akun;
                            document.getElementById("xid").innerHTML = pesan.concat(res, pesan2);

                            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
                                keyboard: false
                            });

                            myModal.show();

                        }
                    </script> --}}

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
