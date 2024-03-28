@extends('layouts.auth.main')

@section('notif')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endsection

@section('container')
    <div class="form-container sign-up">
        <form action="/register" method="POST">
            @csrf
            <h1>Registrasi</h1>
            {{-- <div class="social-icons">
                <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
            </div> --}}
            <span>Gunakan email Anda untuk registrasi</span>
            <input type="text" placeholder="Name" name="name" class="@error('name') is-invalid @enderror"
                value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <input type="email" placeholder="Email" name="email" class="@error('email') is-invalid @enderror"
                value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <input type="password" placeholder="Password" name="password" class="@error('password') is-invalid @enderror"
                required>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <input type="hidden" name="status" value="karyawan">
            <button>Daftar</button>
        </form>
    </div>
    <div class="form-container sign-in">
        <form action="/login" method="POST">
            @csrf
            <h1>Masuk</h1>
            {{-- <div class="social-icons">
                <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
            </div> --}}
            <span>Gunakan email dan kata sandi Anda.</span>
            <input type="email" placeholder="Email" name="email" value="{{ old('email') }}"
                class="@error('email') is-invalid @enderror" autofocus required>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <input type="password" placeholder="Password" name="password" required>
            {{-- <a href="#">Forget Your Password?</a> --}}
            <button>Masuk</button>
        </form>
    </div>
    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Selamat Datang Kembali!</h1>
                <p>Kembali lah kami merindukan Anda.</p>
                <button class="hidden" id="login">Masuk</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Hallo Sobat!</h1>
                <p>Daftarkan diri Anda agar lebih dekat dengan LAZIS.</p>
                <button class="hidden" id="register">Daftar</button>
            </div>
        </div>
    </div>
@endsection
