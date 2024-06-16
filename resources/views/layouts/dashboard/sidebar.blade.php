@section('sidebar')
    <aside class="left-sidebar" style="height: 100%; overflow-y: auto;">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="/godFrey" class="text-nowrap logo-img">
                    <img src="{{ asset('https://webicdn.com/sdirmember/26/25579/logotoko/xj97q.jpg') }}" width="180"
                        alt="" />

                    <p class="display-8 text-dark">Lazis & Zakat Masjid Syamsul 'Ulum</p>
                </a>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <i class="ti ti-x fs-8"></i>
                </div>
            </div>
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>
                    <li class="sidebar-item">
                        <a id="dashboard" class="sidebar-link {{ Request::is('godFrey') ? 'active' : '' }}" href="/godFrey" aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    @can('amil')
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">MASTER DATA</span>
                        </li>

                        <li class="sidebar-item">
                            <a id="transaksi" class="sidebar-link {{ Request::is('checking-transaction', 'filter-transactions', 'search-duplicate-transactions') ? 'active' : '' }}" href="/checking-transaction" aria-expanded="false">
                                <span>
                                    <i class="fa fa-money"></i>
                                </span>
                                <span class="hide-menu">Transaksi</span>
                            </a>
                        </li>
                        
                        {{-- <li class="sidebar-item">
                            <a class="sidebar-link {{ Request::is('pengaduan-list') ? 'active' : '' }}" href="/pengaduan-list" aria-expanded="false">
                                <span>
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                                <span class="hide-menu">Pengaduan</span>
                            </a>
                        </li> --}}

                        @can('admin')
                        <li class="sidebar-item">
                            <a id="cetakKehadiran" class="sidebar-link {{ Request::is('kehadiran*', 'editAbsen') ? 'active' : '' }}" href="/kehadiran" aria-expanded="false">
                                <span>
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </span>
                                <span class="hide-menu">Cetak Kehadiran</span>
                            </a>
                        </li>
                        @endcan

                        <li class="sidebar-item">
                            <a id="kehadiran" class="sidebar-link {{ Request::is('AttendanceQrAbsen') ? 'active' : '' }}" href="/AttendanceQrAbsen" aria-expanded="false">
                                <span>
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </span>
                                <span class="hide-menu">Kehadiran</span>
                            </a>
                        </li>

                        {{-- <li class="sidebar-item">
                            <a class="sidebar-link" href="/barang" aria-expanded="false">
                                <span>
                                    <i class="ti ti-package"></i>
                                </span>
                                <span class="hide-menu">Barang</span>
                            </a>
                        </li> --}}

                        <li class="sidebar-item">
                            <a id="muzakki" class="sidebar-link {{ Request::is('muzakki*', 'muzakkiUser') ? 'active' : '' }}" href="{{auth()->user()->status == 'admin' ? '/muzakki' : '/muzakkiUser'}}" aria-expanded="false">
                                <span>
                                    <i class="fa fa-user"></i>
                                </span>
                                <span class="hide-menu">Muzakki</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a id="mustahik" class="sidebar-link {{ Request::is('mustahik', 'mustahik/create') ? 'active' : '' }}" href="/mustahik" aria-expanded="false">
                                <span>
                                    <i class="fa fa-user"></i>
                                </span>
                                <span class="hide-menu">Mustahik</span>
                            </a>
                        </li>

                        @can('admin')
                        <li class="sidebar-item">
                            <a id="amil" class="sidebar-link {{ Request::is('amil*') ? 'active' : '' }}" href="/amil" aria-expanded="false">
                                <span>
                                    <i class="fa fa-user"></i>
                                </span>
                                <span class="hide-menu">Amil</span>
                            </a>
                        </li>
                        @endcan

                        {{-- <li class="sidebar-item">
                            <a class="sidebar-link" href="/coa" aria-expanded="false">
                                <span>
                                    <i class="ti ti-server"></i>
                                </span>
                                <span class="hide-menu">Coa</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/kategori" aria-expanded="false">
                                <span>
                                    <i class="ti ti-clipboard"></i>
                                </span>
                                <span class="hide-menu">Kategori</span>
                            </a>
                        </li> --}}

                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Transaksi
                            </span>
                        </li>

                        {{-- <li class="sidebar-item">
                            <a class="sidebar-link" href="/zakat" aria-expanded="false">
                                <span>
                                    <i class="fa fa-money"></i>
                                </span>
                                <span class="hide-menu">Pembayaran Zakat</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/sedekah" aria-expanded="false">
                                <span>
                                    <i class="fa fa-money"></i>
                                </span>
                                <span class="hide-menu">Sedekah Dan Infaq</span>
                            </a>
                        </li> --}}

                        <li class="sidebar-item">
                            <a id="penyerahanZakat" class="sidebar-link {{ Request::is('penyerahan*') ? 'active' : '' }}" href="/penyerahan" aria-expanded="false">
                                <span>
                                    <i class="fa fa-money"></i>
                                </span>
                                <span class="hide-menu">Penyerahan Zakat</span>
                            </a>
                        </li>

                        @can('admin')
                        <li class="sidebar-item">
                            <a id="penggajian" class="sidebar-link {{ Request::is('gaji*') ? 'active' : '' }}" href="/gaji" aria-expanded="false">
                                <span>
                                    <i class="fa fa-money"></i>
                                </span>
                                <span class="hide-menu">Penggajian</span>
                            </a>
                        </li>
                        @endcan

                        {{-- <li class="sidebar-item">
                            <a class="sidebar-link" href="/fidyah" aria-expanded="false">
                                <span>
                                    <i class="fa fa-money"></i>
                                </span>
                                <span class="hide-menu">Fidyah</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/wakaf" aria-expanded="false">
                                <span>
                                    <i class="fa fa-money"></i>
                                </span>
                                <span class="hide-menu">Wakaf</span>
                            </a>
                        </li> --}}
                    @endcan
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
@endsection
