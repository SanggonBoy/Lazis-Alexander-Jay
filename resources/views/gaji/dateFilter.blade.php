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
                            <h5 class="card-title fw-semibold mb-4">Data Gaji Periode {{ $periode }}</h5>
                            <div class="card">
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
                                        <a href="/gaji/create" class="btn btn-primary btn-icon-split btn-md">
                                            <span class="icon text-white-50">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </span>
                                            <span class="text">Input Data Penggajian</span>
                                        </a>

                                        <form action="/dateFilterGaji" method="post">
                                            @csrf
                                            <input type="month" class="btn btn-icon-split btn-md" name="tanggal">
                                            <input type="submit" value="Cari">
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
                                            <thead class="thead-white">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Amil</th>
                                                    <th>Email</th>
                                                    <th>Nama Amil</th>
                                                    <th>Periode</th>
                                                    <th>Jumlah Alpa</th>
                                                    <th>Tanggal Dicetak</th>
                                                    @can('admin')
                                                        <th colspan="2" class="m-1">Action</th>
                                                    @endcan
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($gaji as $m)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $m->amil->kode_amil }}</td>
                                                        <td>{{ $m->email }}</td>
                                                        <td>{{ $m->nama_amil }}</td>
                                                        <td>@foreach($periode_gaji as $p) {{$p}} @endforeach</td>
                                                        <td>{{ $m->jumlah_alpa }}</td>
                                                        <td>
                                                            @if ($m->tanggal_dicetak)
                                                                {{ \Carbon\Carbon::parse($m->tanggal_dicetak)->format('d/m/Y') }}
                                                            @else
                                                                Belum Dicetak
                                                            @endif
                                                        </td>
                                                        @can('admin')
                                                            <td class="d-flex">
                                                                <a href="/gaji/{{ $m->id }}"
                                                                    class="btn m-1 btn-primary btn-icon-split btn-sm mr-1">
                                                                    <span class="icon text-white-50">
                                                                        <i class="fa fa-eye"></i>
                                                                    </span>
                                                                </a>

                                                                @if($m->tanggal_dicetak)

                                                                @else
                                                                <a href="/gaji/{{ $m->id }}/edit"
                                                                    class="btn m-1 btn-success btn-icon-split btn-sm mr-1">
                                                                    <span class="icon text-white-50">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </span>
                                                                </a>

                                                                <a href="/gaji/destroy/{{ $m->id }}"
                                                                    data-id="{{ $m->amil->kode_amil }}"
                                                                    data-name="{{ $m->nama_amil }}"
                                                                    class="btn m-1 btn-danger btn-icon-split btn-sm btn-hapus">
                                                                    <span class="icon text-white-50">
                                                                        <i class="fa fa-trash"></i>
                                                                    </span></a>
                                                                @endif
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
                    
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>
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
                                    html: `Apakah Anda Yakin Ingin Menghapus Data Gaji <span class="text-info fw-semibold">${name}</span> Dengan Kode <span class="text-info fw-semibold">${id}</span>.`,
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
