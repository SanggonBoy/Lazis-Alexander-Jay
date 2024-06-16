<!-- Modal Zakat -->
<div class="modal fade" id="zakat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Pembayaran Zakat</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/zakatPay" id="formZakat" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="kode_transaksi" value="{{ rand() }}">

                    {{-- <input type="hidden" name="email" value="{{ auth()->user()->email }}"> --}}
                    {{-- <input type="hidden" name="nama_muzakki" value="{{ auth()->user()->name }}"> --}}
                    <input type="hidden" name="status_pembayaran" value="pending">

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control form-control-solid bg-primary-subtle" id="email"
                            name="email" value="{{ auth()->user()->email }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="nama_muzakki" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control bg-primary-subtle" id="nama_muzakki" name="full_name"
                            value="{{ auth()->user()->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_zakat">Jenis Zakat</label>
                        <select class="form-control form-control-solid" id="jenis_zakat" name="jenis_transaksi"
                            required>
                            <option value="" selected disabled>Pilih Jenis Zakat</option>
                            <option value="Zakat Fitrah">Zakat Fitrah</option>
                            <option value="Zakat Mal">Zakat Mal</option>
                        </select>
                    </div>

                    <div id="fitrahInput" style="display: none;">
                        <div class="mb-3">
                            <label for="banyak_orang">Banyaknya Orang</label><button type="button" class="btn btn-sm"
                                id="info-icon-fitrah"><i class="fa fa-info-circle"></i></button>
                            <input type="text" class="form-control" id="banyak_orang" value="0"
                                name="jumlahFitrah" required>
                            <span class="text-danger text-sm">Batas Maksimal Banyaknya Orang 100.000 Orang</span>
                        </div>

                        <div class="mb-3">
                            <label for="nominal">Nominal</label>
                            <input type="text" class="form-control bg-primary-subtle form-control-solid"
                                id="nominal_fitrah" name="nominalFitrah" value="" readonly>
                        </div>
                    </div>

                    <div id="malInput" style="display: none;">
                        <div class="mb-3">
                            <label for="harta_dimiliki">Harta yang Dimiliki</label><button type="button"
                                class="btn btn-sm" id="info-icon-mal"><i class="fa fa-info-circle"></i></button>
                            <input type="text" class="form-control form-control-solid" id="harta_dimiliki"
                                name="jumlahMal" value="0" required>
                            <span class="text-danger text-sm">Batas Minimal Harta Sebesar Rp. 10.000,-</span> <br>
                            <span class="text-danger text-sm">Batas Maksimal Harta Sebesar Rp.
                                2.000.000.000.000,-</span>
                        </div>
                        <div class="mb-3">
                            <label for="nominal">Nominal</label>
                            <input type="text" class="form-control bg-primary-subtle form-control-solid"
                                id="nominal_mal" name="nominalMal" readonly>
                        </div>
                    </div>

                    {{-- <div class="mb-3">
                        <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
                        <input type="date" class="form-control form-control-solid" id="tanggal_pembayaran"
                            name="tanggal_pembayaran">
                    </div> --}}

                    <input type="hidden" name="tanggal_pembayaran" value="{{ now() }}">

                    {{-- <div class="mb-3">
                        <label for="bukti_pembayaran">Bukti Pembayaran</label>
                        <input type="file" accept="image/*" class="form-control form-control-solid"
                            id="bukti_pembayaran" name="bukti_pembayaran">
                    </div> --}}

                    <input class="btn btn-success" type="submit" value="Simpan">
                    <a class="btn btn-danger" href="{{ url('/transaksi') }}" role="button">Batal</a>
                </div>

            </form>

            <script>
                document.getElementById('info-icon-fitrah').addEventListener('click', function() {
                    Swal.fire({
                        title: 'Kalkulasi Perhitungan Zakat Fitrah',
                        html: '<p>Perhitungan dilakukan dengan cara banyaknya <span class="fw-bold text-danger">ORANG</span> dikalikan dengan <span class="fw-bold text-danger">Rp. 45.000,-</span>.</p>',
                        icon: 'info',
                        confirmButtonText: 'Mengerti'
                    });
                });

                document.getElementById('info-icon-mal').addEventListener('click', function() {
                    Swal.fire({
                        title: 'Kalkulasi Perhitungan Zakat Mal',
                        html: '<p>Perhitungan dilakukan dengan cara <span class="fw-bold text-danger">HARTA YANG DIMILIKI</span> dikalikan dengan <span class="fw-bold text-danger">Rp. 0.025</span>.</p>',
                        icon: 'info',
                        confirmButtonText: 'Mengerti'
                    });
                });

                document.getElementById('jenis_zakat').addEventListener('change', function() {
                    var fitrahInput = document.getElementById('fitrahInput');
                    var malInput = document.getElementById('malInput');
                    var selectedValue = this.value;

                    if (selectedValue === 'Zakat Fitrah') {
                        fitrahInput.style.display = 'block';
                        malInput.style.display = 'none';
                    } else if (selectedValue === 'Zakat Mal') {
                        fitrahInput.style.display = 'none';
                        malInput.style.display = 'block';
                    }
                });

                document.getElementById('banyak_orang').addEventListener('input', function() {
                    var nominalInput = document.getElementById('nominal_fitrah');
                    var banyakOrang = parseFloat(this.value.replace(/\D/g, ''));
                    var nominal = banyakOrang * 45000;
                    nominalInput.value = new Intl.NumberFormat('id-ID').format(nominal);
                });

                document.getElementById('harta_dimiliki').addEventListener('input', function() {
                    var nominalInput = document.getElementById('nominal_mal');
                    var hartaDimiliki = parseFloat(this.value.replace(/\D/g, ''));
                    var nominal = Math.floor(hartaDimiliki * 0.025);
                    nominalInput.value = new Intl.NumberFormat('id-ID').format(nominal);
                });

                function formatNumberInput(input) {
                    input.addEventListener('input', function() {
                        var value = this.value.replace(/\D/g, '');
                        this.value = new Intl.NumberFormat('id-ID').format(value);
                    });
                }

                formatNumberInput(document.getElementById('harta_dimiliki'));
                formatNumberInput(document.getElementById('banyak_orang'));

                document.getElementById('formZakat').addEventListener('submit', function(event) {
                    var banyakOrangInput = document.getElementById('banyak_orang');
                    var banyakOrang = parseFloat(banyakOrangInput.value.replace(/\D/g, ''));
                    var hartaDimilikiInput = document.getElementById('harta_dimiliki');
                    var hartaDimiliki = parseFloat(hartaDimilikiInput.value.replace(/\D/g, ''));
                    var jenis_transaksi = document.getElementById('jenis_zakat').value;

                    if (jenis_transaksi == 'Zakat Fitrah') {
                        if (banyakOrang > 100000) {
                            event.preventDefault();
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                html: 'Maaf, jumlah banyaknya orang tidak boleh melebihi <span class="fw-bold text-danger">100.000</span>.',
                                confirmButtonText: 'Mengerti'
                            });
                        }
                    }

                    if (jenis_transaksi == 'Zakat Mal') {
                        if (hartaDimiliki < 10000 || hartaDimiliki > 2000000000000) {
                            event.preventDefault();
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                html: 'Maaf, nominal harta yang dimiliki harus di antara <span class="fw-bold text-danger">Rp. 10.000,-</span> dan <span class="fw-bold text-danger">Rp. 2.000.000.000.000,-</span>.',
                                confirmButtonText: 'Mengerti'
                            });
                        }
                    }
                });
            </script>
        </div>
    </div>
</div>

<!-- Modal Sedekah -->
<div class="modal fade" id="sedekah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Pembayaran Sedekah dan Infaq</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/sedekahPay" id="formSedekah" method="post" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <input type="hidden" name="kode_transaksi" value="{{ rand() }}">

                    {{-- <input type="hidden" name="email" value="{{ auth()->user()->email }}"> --}}
                    {{-- <input type="hidden" name="nama_muzakki" value="{{ auth()->user()->name }}"> --}}
                    <input type="hidden" name="status_pembayaran" value="pending">

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control form-control-solid bg-primary-subtle"
                            id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama_pembayar" class="form-label">Nama Pembayar</label>
                        <input type="text" class="form-control form-control-solid bg-primary-subtle"
                            id="nama_pembayar" name="full_name" value="{{ auth()->user()->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal</label>
                        <input type="text" class="form-control form-control-solid" id="nominalSedekah"
                            name="nominal" placeholder="Masukkan Nominal">
                        <span class="text-danger text-sm">Batas Minimal Harta Sebesar Rp.
                            10.000,-</span><br>
                        <span class="text-danger text-sm">Batas Maksimal Harta Sebesar Rp.
                            50.000.000.000,-</span>
                    </div>
                    <div class="mb-3">
                        <label for="badan" class="form-label">Badan Amal</label>
                        <select class="form-control form-control-solid" id="badan" name="jenis_transaksi">
                            <option value="" selected disabled>Pilih Nama Badan Amal</option>
                            <option value="Sedekah Palestina">Sedekah Palestina</option>
                            <option value="Sedekah Anak Yatim">Sedekah Anak Yatim</option>
                            <option value="Infaq Pendidikan">Infaq Pendidikan</option>
                            <option value="Infaq Ekonomi">Infaq Ekonomi</option>
                            <option value="Infaq Kesehatan">Infaq Kesehatan</option>
                        </select>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                        <input type="date" class="form-control form-control-solid" id="tanggal_pembayaran"
                            name="tanggal_pembayaran">
                    </div> --}}

                    <input type="hidden" name="tanggal_pembayaran" value="{{ now() }}">

                    <input class="btn btn-success" type="submit" value="Simpan">
                    <a class="btn btn-danger" href="{{ url('/transaksi') }}" role="button">Batal</a>
                </div>
            </form>

            <script>
                function formatNumberSedekah(input) {
                    input.addEventListener('input', function() {
                        var value = this.value.replace(/\D/g, '');
                        this.value = new Intl.NumberFormat('id-ID').format(value);
                    });
                }

                formatNumberSedekah(document.getElementById('nominalSedekah'));

                document.getElementById('formSedekah').addEventListener('submit', function(event) {
                    var nominalInput = document.getElementById('nominalSedekah');
                    var nominal = parseFloat(nominalInput.value.replace(/\D/g, ''));

                    if (nominal < 10000 || nominal > 50000000000) {
                        event.preventDefault();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: 'Maaf, nominal harus di antara <span class="fw-bold text-danger">Rp. 10.000,-</span> dan <span class="fw-bold text-danger">Rp. 50.000.000.000,-</span>.',
                            confirmButtonText: 'Mengerti'
                        });
                    }
                });
            </script>
        </div>
    </div>
</div>

<!-- Modal Fidyah -->
<div class="modal fade" id="fidyah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Pembayaran Fidyah</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="/fidyahPay" id="formFidyah" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="kode_transaksi" value="{{ rand() }}">

                    {{-- <input type="hidden" name="email" value="{{ auth()->user()->email }}"> --}}
                    {{-- <input type="hidden" name="nama_muzakki" value="{{ auth()->user()->name }}"> --}}
                    <input type="hidden" name="status_pembayaran" value="pending">

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control form-control-solid bg-primary-subtle"
                            id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama_pembayar" class="form-label">Nama Pembayar</label>
                        <input type="text" class="form-control form-control-solid bg-primary-subtle"
                            id="nama_pembayar" name="full_name" value="{{ auth()->user()->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="nama_pembayar" class="form-label">Jumlah Hari</label>
                        <button type="button" class="btn btn-sm" id="info-icon-fidyah"><i
                                class="fa fa-info-circle"></i></button>
                        <input type="text" class="form-control form-control-solid bg-primary-subtle"
                            id="jumlah_hari_fidyah" name="jumlah" value="0">
                        <span class="text-danger text-sm">Maksimal Jumlah Hari 1826 Hari.</span>
                    </div>

                    {{-- <div class="mb-3">
                        <label for="jumlah_hari">Jumlah Hari</label>
                        <select class="form-control form-control-solid" id="jumlah_hari_fidyah" name="jumlah_hari"
                            onchange="calculateNominalFidyah()">
                            <option value="" selected disabled>Pilih Jumlah Hari</option>
                            @for ($i = 1; $i <= 30; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div> --}}

                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal</label>
                        <input type="text" class="form-control form-control-solid" id="nominal_fidyah"
                            name="nominal" placeholder="Masukkan Nominal" readonly>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                        <input type="date" class="form-control form-control-solid" id="tanggal_pembayaran"
                            name="tanggal_pembayaran">
                    </div> --}}

                    <input type="hidden" name="jenis_transaksi" value="Pembayaran Fidyah">

                    <input type="hidden" name="tanggal_pembayaran" value="{{ now() }}">

                    <input class="btn btn-success" type="submit" value="Simpan">
                    <a class="btn btn-danger" href="{{ url('/transaksi') }}" role="button">Batal</a>
                </div>
            </form>
            <!-- Akhir Dari Input Form -->

            <script>
                function formatNumberFidyah(input) {
                    input.addEventListener('input', function() {
                        var value = this.value.replace(/\D/g, '');
                        this.value = new Intl.NumberFormat('id-ID').format(value);
                    });
                }

                formatNumberFidyah(document.getElementById('jumlah_hari_fidyah'));

                document.getElementById('jumlah_hari_fidyah').addEventListener('input', function() {
                    var nominalInput = document.getElementById('nominal_fidyah');
                    var hartaDimiliki = parseFloat(this.value.replace(/\D/g, ''));
                    var nominal = hartaDimiliki * 60000;
                    nominalInput.value = new Intl.NumberFormat('id-ID').format(nominal);
                });

                document.getElementById('info-icon-fidyah').addEventListener('click', function() {
                    Swal.fire({
                        title: 'Kalkulasi Perhitungan Fidyah',
                        html: '<p>Perhitungan dilakukan dengan cara banyaknya <span class="fw-bold text-danger">HARI</span> dikalikan dengan <span class="fw-bold text-danger">Rp. 60.000,-</span>.</p>',
                        icon: 'info',
                        confirmButtonText: 'Mengerti'
                    });
                });

                document.getElementById('formFidyah').addEventListener('submit', function(event) {
                    var jumlah_hari_fidyah = document.getElementById('jumlah_hari_fidyah');
                    var jumlah_hari = parseFloat(jumlah_hari_fidyah.value.replace(/\D/g, ''));

                    if (jumlah_hari > 1826) {
                        event.preventDefault();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: 'Maaf, <span class="fw-bold text-danger">JUMLAH HARI</span> melebihi batas yang telah ditentukan.',
                            confirmButtonText: 'Mengerti'
                        });
                    }
                });
            </script>

        </div>
    </div>
</div>


<!-- Wakaf -->
<div class="modal fade" id="wakaf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Pembayaran Wakaf</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/wakafPay" id="formWakaf" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="kode_transaksi" value="{{ rand() }}">

                    {{-- <input type="hidden" name="email" value="{{ auth()->user()->email }}"> --}}
                    {{-- <input type="hidden" name="nama_muzakki" value="{{ auth()->user()->name }}"> --}}
                    <input type="hidden" name="status_pembayaran" value="pending">

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control form-control-solid bg-primary-subtle"
                            id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama_pewakaf" class="form-label">Nama Pewakaf</label>
                        <input type="text" class="form-control form-control-solid bg-primary-subtle"
                            id="nama_pewakaf" name="full_name" value="{{ auth()->user()->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_wakaf" class="form-label">Jenis Wakaf</label>
                        <select class="form-control form-control-solid" id="jenis_wakaf" name="jenis_transaksi">
                            <option value="" selected disabled>Pilih Jenis Wakaf</option>
                            <option value="Wakaf Masjid">Wakaf Masjid</option>
                            <option value="Wakaf Al-Qur'an">Wakaf Al-Qur'an</option>
                            <option value="Wakaf Tanah">Wakaf Tanah</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal</label>
                        <input type="text" class="form-control form-control-solid" id="nominalWakaf"
                            name="nominal" placeholder="Masukkan Nominal">
                        <span class="text-danger text-sm">Batas Maksimal Harta Sebesar Rp.
                            50.000.000.000,-</span>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                        <input type="date" class="form-control form-control-solid" id="tanggal_pembayaran"
                            name="tanggal_pembayaran">
                    </div> --}}

                    <input type="hidden" name="tanggal_pembayaran" value="{{ now() }}">

                    <input class="btn btn-success" type="submit" value="Simpan">
                    <a class="btn btn-danger" href="{{ url('/transaksi') }}" role="button">Batal</a>
                </div>
            </form>

            <script>
                function formatNumberWakaf(input) {
                    input.addEventListener('input', function() {
                        var value = this.value.replace(/\D/g, '');
                        this.value = new Intl.NumberFormat('id-ID').format(value);
                    });
                }

                formatNumberWakaf(document.getElementById('nominalWakaf'));

                document.getElementById('formWakaf').addEventListener('submit', function(event) {
                    var jumlah_hari_fidyah = document.getElementById('nominalWakaf');
                    var jumlah_hari = parseFloat(jumlah_hari_fidyah.value.replace(/\D/g, ''));

                    if (jumlah_hari > 50000000000) {
                        event.preventDefault();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: 'Maaf, nominal melebihi batas yang telah ditentukan <span class="fw-bold text-danger">Rp. 50.000.000.000,-</span>.',
                            confirmButtonText: 'Mengerti'
                        });
                    }
                });
            </script>
        </div>
    </div>
</div>





<!-- <script>
    function setNominal() {
        var select = document.getElementById('jenis_transaksi');
        var nominalInput = document.getElementById('nominal');
        var selectedValue = select.value;

        if (selectedValue === 'zakat_fitrah') {
            nominalInput.value = '20000';
        } else if (selectedValue === 'zakat_mal') {
            nominalInput.value = '50000';
        } else {
            nominalInput.value = '';
        }
    }
</script> -->
