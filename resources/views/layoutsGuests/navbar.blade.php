@section('navbar')
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            {{-- <a class="navbar-brand" href="#page-top"><img src="{{ asset ('front/assets/img/navbar-logo.svg') }}" alt="..." /></a> --}}
            <a class="navbar-brand" href="#page-top">LAZIS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#services">Pelayanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portfolio">Kegiatan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#team">Tim Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!" data-bs-toggle="modal"
                            data-bs-target="#pt">Privacy & Terms</a></li>
                </ul>
                @auth
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="/godFrey">Dashboard</a></li>
                    </ul>
                @else
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="/joinUs">Bergabung</a></li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>
@endsection
