@extends('layouts.dashboard.main')

@section('content')
    @extends('layouts.dashboard.sidebar')
    @extends('layouts.dashboard.header')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">List Pengaduan</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Subjek</th>
                                    <th>Pesan</th>
                                    @can('admin')
                                        <th>Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengaduan as $m)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $m->subjek }}</td>
                                        <td>{{ $m->pesan }}</td>
                                        @can('admin')
                                            {{-- <td style="border: 1px solid #dddddd; padding: 8px;"><a
                                                    class="badge text-bg-warning border-0"
                                                    href="/barang/{{ $m->id }}/edit">
                                                    Edit
                                                </a></td> --}}
                                            <td style="border: 1px solid #dddddd; padding: 8px;">
                                                <a href="#" onclick="deleteConfirm(this); return false;"
                                                    data-id="{{ $m->id }}" class="btn btn-danger btn-icon-split btn-sm">
                                                    <span class="icon text-white-50">
                                                        <i class="ti ti-minus"></i>
                                                    </span>
                                                    <span class="text">Hapus</span>
                                                    <!-- <form action="/barang/{{ $m->id }}" method="post">
                                                                                    @method('delete')
                                                                                    @csrf
                                                                                    <button class="badge text-bg-danger border-0">Hapus</button>
                                                                                </form> -->
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <script>
                            function deleteConfirm(e) {
                                var tomboldelete = document.getElementById('btn-delete')
                                id = e.getAttribute('data-id');

                                // const str = 'Hello' + id + 'World';
                                var url3 = "{{ url('pengaduan/destroy/') }}";
                                var url4 = url3.concat("/", id);
                                // console.log(url4);

                                // console.log(id);
                                // var url = "{{ url('barang/destroy/"+id+"') }}";

                                // url = JSON.parse(rul.replace(/"/g,'"'));
                                tomboldelete.setAttribute("href", url4); //akan meload kontroller delete

                                var pesan = "Data dengan ID <m>"
                                var pesan2 = " </m>akan dihapus"
                                var res = id;
                                document.getElementById("xid").innerHTML = pesan.concat(res, pesan2);

                                var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
                                    keyboard: false
                                });

                                myModal.show();

                            }
                        </script>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    @extends('layouts.dashboard.footer')
@endsection
