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
                        <h5 class="card-title fw-semibold mb-4">Penyerahan Zakat</h5>
                        <div class="card">
                            <button id="tutorPenyerahan" class="btn btn-primary mb-3 d-block">
                                <i class="fa fa-question-circle me-1" aria-hidden="true"></i>Info
                            </button>
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Transaksi Penyerahan Zakat</h6>

                                <a id="tambahPenyerahan" href="/penyerahan/create" class="btn btn-primary btn-icon-split btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="ti ti-plus"></i>
                                    </span>
                                    <span class="text">Tambah Transaksi</span>
                                </a>
                            </div>

                            <div class="card-body">
                                <!-- Awal Dari Tabel -->
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead id="dataPenyerahan" class="thead-white">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Amil</th>
                                                <th>Nama Mustahik</th>
                                                <th>Jenis Zakat</th>
                                                <th>Nominal</th>
                                                <th>Tanggal Penyerahan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($penyerahan as $p)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $p->amil->nama_amil ?? 'N/A' }}</td>
                                                <td>{{ $p->mustahik->nama_mustahik ?? 'N/A' }}</td>
                                                <td>{{ $p->jenis_zakat }}</td>
                                                <td>Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                                                <td>{{ date('d/m/Y', strtotime($p->tanggal)) }}</td>
                                                <td>
                                                    <a href="#" onclick="deleteConfirm(this); return false;" data-id="{{ $p->id }}" class="btn btn-danger btn-icon-split btn-sm">
                                                        <span class="icon text-white-50">
                                                            <i class="ti ti-minus"></i>
                                                        </span>
                                                        <span class="text">Hapus</span>
                                                    </a>
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

        var url3 = "{{url('penyerahan/destroy/')}}";
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

<!-- Logout Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
            </div>
        </div>
    </div>
</div>

@endsection
