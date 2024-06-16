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
                            <h5 class="card-title fw-semibold mb-4">Kehadiran Hari Ini</h5>
                            <div class="card">
                                <button id="tutorCetakKehadiran" class="btn btn-primary mb-3 d-block">
                                    <i class="fa fa-question-circle me-1" aria-hidden="true"></i>Info
                                </button>
                                @if (session()->has('absen'))
                                    <script>
                                        Swal.fire({
                                            title: '{{ session('absen') }}',
                                            html: '<p>Berhasil.</p>',
                                            icon: 'success',
                                            confirmButtonText: 'OK'
                                        });
                                    </script>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                                    <!-- Tombol Tambah Data -->
                                    @can('admin')
                                        <a id="absenManual" href="{{ url('/kehadiran/create') }}"
                                            class="btn btn-primary btn-icon-split btn-md">
                                            <span class="icon text-white-50">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </span>
                                            <span class="text">Absen Manual</span>
                                        </a>

                                        <a id="absenEdit" href="/editAbsen" class="btn btn-primary btn-icon-split btn-md">
                                            <span class="icon text-white-50">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </span>
                                            <span class="text">Edit Absen</span>
                                        </a>

                                        <a id="qrAbsen" onclick="qrAbsen()" class="btn btn-primary btn-icon-split btn-md">
                                            <i class="fa fa-qrcode me-1" aria-hidden="true"></i>Buat QrCode Absen
                                        </a>
                                        <form action="/QrAbsen" method="POST" id="formAbsen">
                                            @csrf
                                            <input type="hidden" name="qr_token" value="{{ $qrAbsen }}" id="qr_token">
                                        </form>

                                        <form action="/dateFilter" method="post">
                                            @csrf
                                            <div id="dateFilterAbsen">
                                                <input type="date" class="btn btn-icon-split btn-md" name="tanggal">
                                                <input type="submit" value="Cari">
                                            </div>
                                        </form>

                                        {{-- <a href="{{ url('/kehadiran/QrCode') }}" class="btn btn-primary btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                                <i class="fa fa-qrcode"></i>
                                            </span>
                                            <span class="text">Buat QRCOde Absen</span>
                                        </a> --}}
                                    @endcan

                                </div>


                                <div class="card-body">
                                    <!-- Awal Dari Tabel -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="thead-white" id="dataCetakKehadiran">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Amil</th>
                                                    <th>Email</th>
                                                    <th>Nama Amil</th>
                                                    <th>Kehadiran</th>
                                                    <th>Tanggal</th>
                                                    {{-- @can('admin')
                                                        <th colspan="2">Action</th>
                                                    @endcan --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $m)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $m->amil->kode_amil }}</td>
                                                        <td>{{ $m->email }}</td>
                                                        <td>{{ $m->name }}</td>
                                                        <td>{{ $m->kehadiran }}</td>
                                                        <td>{{ date('d/m/Y', strtotime($m->tanggal)) }}</td>
                                                        {{-- @can('admin')
                                                            <td>
                                                                <a href="/amil/{{ $m->id }}/edit"
                                                                    class="btn btn-success btn-icon-split btn-sm">
                                                                    <span class="icon text-white-50">
                                                                        <i class="ti ti-check"></i>
                                                                    </span>
                                                                    <span class="text">Ubah</span>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="#" onclick="deleteConfirm(this); return false;"
                                                                    nama_akun="{{ $m->nama_amil }}"
                                                                    data-id="{{ $m->id }}"
                                                                    class="btn btn-danger btn-icon-split btn-sm">
                                                                    <span class="icon text-white-50">
                                                                        <i class="ti ti-minus"></i>
                                                                    </span>
                                                                    <span class="text">Hapus</span>
                                                                    </form>
                                                            </td>
                                                        @endcan --}}
                                                    </tr>
                                                @endforeach
                                                <div class="d-flex justify-content-center">
                                                    {{ $data->links() }} <!-- Link pagination -->
                                                </div>
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
                    </script>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>

                    @if (session()->has('swal'))
                        <script>
                            Swal.fire({
                                title: "{{ session('swal.title') }}",
                                html: "{{ session('swal.message') }}",
                                icon: "{{ session('swal.status') }}",
                                confirmButtonText: 'Mengerti'
                            });
                        </script>
                    @endif

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
