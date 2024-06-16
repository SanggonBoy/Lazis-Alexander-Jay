@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')
@can('karyawan')<h1 class="display-4">Anda tidak memiliki akses kesini!</h1>@endcan
@can('admin')
    <h1>Tambah Data</h1>
    <form action="/kategori" method="post" class="mb-3">
        @csrf
        <label for="exampleFormControlInput1" class="form-label">Kode Kategori</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">KGR-</span>
            <input type="text" class="form-control" name="kode_kategori" id="kapital" oninput="this.value = this.value.toUpperCase();">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" name="kategori" id="exampleFormControlInput2">
        </div>
        <button class="btn btn-primary">Tambah</button>
    </form>
    @endcan
@endsection
