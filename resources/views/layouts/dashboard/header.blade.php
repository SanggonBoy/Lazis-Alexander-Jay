@section('header')
    <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item d-block d-xl-none">
                    <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                        <i class="ti ti-bell-ringing"></i>
                        <div class="notification bg-primary rounded-circle"></div>
                    </a>
                </li>
            </ul>

            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                    <a href="#!" data-bs-toggle="modal" data-bs-target="#laporan" class="btn btn-primary me-5">
                        Unduh Laporan
                    </a>
                    <p class="mb-0 fs-3">{{ auth()->user()->name }}</p>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('images/profile/user-1.jpg') }}" alt="" width="35" height="35"
                                class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                            <div class="message-body">
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user fs-6"></i>
                                    <p class="mb-0 fs-3">My Profile</p>
                                </a>
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-mail fs-6"></i>
                                    <p class="mb-0 fs-3">My Account</p>
                                </a>
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-list-check fs-6"></i>
                                    <p class="mb-0 fs-3">My Task</p>
                                </a>
                                <hr>
                                <a href="/" class="d-flex align-items-center gap-2 dropdown-item">
                                    <p class="mb-0 fs-3">Dashboard</p>
                                </a>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="d-flex align-items-center gap-2 dropdown-item">Logout</button>
                                </form>
                                {{-- <a href="./authentication-login.html"
                                    class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a> --}}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Modal -->
    <div class="modal fade" id="laporan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <a href="/barang-pdf">
                        <label class="form-check-label btn btn-outline-primary me-3" for="my-checkbox">
                            Laporan Barang
                        </label>
                    </a>
                    <a href="/amil-pdf">
                        <label class="form-check-label btn btn-outline-primary me-3" for="my-checkbox">
                            Laporan Amil
                        </label>
                    </a>
                    <a href="/kategori-pdf">
                        <label class="form-check-label btn btn-outline-primary me-3" for="my-checkbox">
                            Laporan Kategori
                        </label>
                    </a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Tututp</button>
                    {{-- <button class="btn btn-primary">Unduh</button> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
