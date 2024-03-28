@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')
<h2 style="text-align: center;">Tabel Barang</h2>
<hr>

@can('admin') <a class="badge text-bg-primary mb-5 mt-2 p-2" href="/barang/create">Tambah Barang</a> @endcan

<table style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th style="border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;">No</th>
            <th style="border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;">Kode Barang</th>
            <th style="border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;">Kategori Barang</th>
            <th style="border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;">Nama Barang</th>
            @can('admin')<th style='border: 1px solid #dddddd; background-color: #f2f2f2; padding: 8px;' colspan="2">Opsi</th>@endcan
        </tr>
    </thead>
    <tbody>
        <?php $count = 1;
        ?>
        @foreach ($barang as $b)
        <tr>
            <td style="border: 1px solid #dddddd; padding: 8px;">{{ $count++ }}</td>
            <td style="border: 1px solid #dddddd; padding: 8px;">{{ $b->kategori->kode_kategori }}</td>
            <td style="border: 1px solid #dddddd; padding: 8px;">{{ $b->kategori->kategori }}</td>
            <td style="border: 1px solid #dddddd; padding: 8px;">{{ $b->nama_barang }}</td>
            @can('admin')<td style="border: 1px solid #dddddd; padding: 8px;"><a class="badge text-bg-warning border-0" href="/barang/{{ $b->id }}/edit">
                    Edit
                </a></td>
            <td style="border: 1px solid #dddddd; padding: 8px;">
                <a href="#" onclick="deleteConfirm(this); return false;" data-id="{{ $b->id }}" class="btn btn-danger btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="ti ti-minus"></i>
                    </span>
                    <span class="text">Hapus</span>
                    <!-- <form action="/barang/{{ $b->id }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="badge text-bg-danger border-0">Hapus</button>
                        </form> -->
            </td>@endcan
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    function deleteConfirm(e) {
        var tomboldelete = document.getElementById('btn-delete')
        id = e.getAttribute('data-id');

        // const str = 'Hello' + id + 'World';
        var url3 = "{{url('barang/destroy/')}}";
        var url4 = url3.concat("/", id);
        // console.log(url4);

        // console.log(id);
        // var url = "{{url('barang/destroy/"+id+"')}}";

        // url = JSON.parse(rul.replace(/"/g,'"'));
        tomboldelete.setAttribute("href", url4); //akan meload kontroller delete

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