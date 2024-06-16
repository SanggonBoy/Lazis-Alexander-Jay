@section('donasi')
    <!-- Zakat -->
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col">
            <div class="card warna border-dark">
                <img src="{{ asset('trx/img/zakat.png') }}" class="img-fluid" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-light ukir">Bayar Zakat</h5>
                    <p class="card-text text-light ukir">Mari bersihkan harta kita dengan membayar zakat, wujudkan keadilan
                        dan kepedulian sosial.</p>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#zakat" class="btn btn-light">
                        <span class="icon text-white-50">
                            <i class="ti ti-plus"></i>
                        </span>
                        <span class="text">Bayar Zakat</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sedekah -->
        <div class="col">
            <div class="card warna border-dark">
                <img src="{{ asset('trx/img/sedekah1.png') }}" class="img-fluid" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-light ukir">Bayar Sedekah</h5>
                    <p class="card-text text-light ukir">Berikan sedekah terbaikmu, sebarkan kebaikan dan bantu mereka yang
                        membutuhkan.</p>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#sedekah" class="btn btn-light">
                        <span class="icon text-white-50">
                            <i class="ti ti-plus"></i>
                        </span>
                        <span class="text">Bayar Sedekah</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Fidyah -->
        <div class="col">
            <div class="card warna border-dark">
                <img src="{{ asset('trx/img/fidyah.png') }}" class="img-fluid" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-light ukir">Bayar Fidyah</h5>
                    <p class="card-text text-light ukir">Lunasi fidyah Anda, gantikan hak orang lain dan sempurnakan ibadah
                        puasa Anda.</p>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#fidyah" class="btn btn-light">
                        <span class="icon text-white-50">
                            <i class="ti ti-plus"></i>
                        </span>
                        <span class="text">Bayar Fidyah</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Wakaf -->
        <div class="col">
            <div class="card warna border-dark">
                <img src="{{ asset('trx/img/wakaf.png') }}" class="img-fluid" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-light ukir">Bayar Wakaf</h5>
                    <p class="card-text text-light ukir">Berwakaflah untuk masa depan, investasi amal yang pahalanya tak
                        pernah putus.</p>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#wakaf" class="btn btn-light">
                        <span class="icon text-white-50">
                            <i class="ti ti-plus"></i>
                        </span>
                        <span class="text">Bayar Wakaf</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
