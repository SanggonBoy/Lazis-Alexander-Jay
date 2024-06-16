<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lazis & Zakat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.48.0/apexcharts.min.css"
        integrity="sha512-qc0GepkUB5ugt8LevOF/K2h2lLGIloDBcWX8yawu/5V8FXSxZLn3NVMZskeEyOhlc6RxKiEj6QpSrlAoL1D3TA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" type="image/png"
        href="{{ asset('https://webicdn.com/sdirmember/26/25579/logotoko/xj97q.jpg') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('node_modules/intro.js/minified/introjs.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('node_modules/intro.js/themes/introjs-modern.css') }}" />
    @notifyCss
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute">
        <!-- Sidebar Start -->
        @yield('sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @yield('header')
            <!--  Header End -->
            <div class="container-fluid">
                <!--Row -->
                @yield('content')
                {{-- endrow --}}
                {{-- Footer --}}
                @yield('footer')
                {{-- EndFooter --}}
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.48.0/apexcharts.min.js"
        integrity="sha512-wqcdhB5VcHuNzKcjnxN9wI5tB3nNorVX7Zz9NtKBxmofNskRC29uaQDnv71I/zhCDLZsNrg75oG8cJHuBvKWGw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="{{ asset('dashboard/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dashboard/js/app.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('dashboard/js/dashboard.js') }}"></script>
    <script src="{{ asset('calendar/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    @notifyJs

    <script>
        const inputText = document.getElementById('kapital');
        const result = document.getElementById('result');

        inputText.addEventListener('input', function() {
            result.textContent = inputText.value;
        });
    </script>
    <script>
        var options = {
            series: [{
                name: "Desktops",
                data: [10]
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Product Trends by Month',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            }
        };

        var chart = new ApexCharts(document.querySelector("#order"), options);
        chart.render();
    </script>

    <script>
        function qrdownload() {
            document.getElementById("form").submit();
        }
    </script>

    <script>
        function qrAbsen() {
            document.getElementById("formAbsen").submit();
        }
    </script>

    <script src="{{ asset('node_modules/intro.js/minified/intro.min.js') }}"></script>
    {{-- Dashboard --}}
    <script>
        document.getElementById('tutorDashboard').addEventListener('click', function() {
            const intro = introJs();
            intro.setOptions({
                steps: [{
                    element: '#laporan',
                    intro: 'Disini Anda Dapat Mengunduh Laporan Data-Data.',
                    position: 'bottom'
                },
                {
                    element: '#qrLogin',
                    intro: 'Anda Bisa Mengunduh QrLogin Anda Disini.',
                    position: 'bottom'
                },
                {
                    element: '#profile',
                    intro: 'Klik Disini Untuk Keluar Dari Sesi Login Anda dan Kembali Ke Dashboard Awal.',
                    position: 'bottom'
                },
                {
                    element: '#dataTahunanTransaksi',
                    intro: 'Tampilan Data Tahunan Semua Transaksi.',
                    position: 'bottom'
                },
                {
                    element: '#dataBulananMal',
                    intro: 'Tampilan Data Rekap Bulanan Zakat Mal.',
                    position: 'bottom'
                },
                {
                    element: '#dataBulananFitrah',
                    intro: 'Tampilan Data Rekap Bulanan Zakat Fitrah.',
                    position: 'bottom'
                },
                {
                    element: '#dataBulananSedekah',
                    intro: 'Tampilan Data Rekap Bulanan Sedekah.',
                    position: 'bottom'
                },
                {
                    element: '#dataBulananWakaf',
                    intro: 'Tampilan Data Rekap Bulanan Wakaf.',
                    position: 'bottom'
                },
                {
                    element: '#dataBulananFidyah',
                    intro: 'Tampilan Data Rekap Bulanan Fidyah.',
                    position: 'bottom'
                },
                {
                    element: '#dashboard',
                    intro: 'Tampilan Dashboard Disini.',
                    position: 'bottom'
                },
                {
                    element: '#transaksi',
                    intro: 'Anda Bisa Melihat Tampilan Data Semua Transaksi Disini',
                    position: 'bottom'
                },
                @can('admin')
                {
                    element: '#cetakKehadiran',
                    intro: 'Anda Bisa Melakukan Cetak Kehadiran Karyawan Disini',
                    position: 'bottom'
                },
                @endcan
                {
                    element: '#kehadiran',
                    intro: 'Tampilan Kehadiran Ini Hanya Bisa Digunakan Untuk Karyawan',
                    position: 'bottom'
                },
                {
                    element: '#muzakki',
                    intro: 'Anda Bisa Melihat Data-Data Muzakki Disini',
                    position: 'bottom'
                },
                {
                    element: '#mustahik',
                    intro: 'Anda Bisa Melihat Data-Data Mustahik Disini',
                    position: 'bottom'
                },
                @can('admin')
                {
                    element: '#amil',
                    intro: 'Anda Bisa Melihat Data-Data Amil Disini',
                    position: 'bottom'
                },
                @endcan
                {
                    element: '#penyerahanZakat',
                    intro: 'Anda Bisa Melihat Data-Data Penyerahan Zakat Disini',
                    position: 'bottom'
                },
                @can('admin')
                {
                    element: '#penggajian',
                    intro: 'Anda Bisa Melihat Data-Data Penggajian Karyawan Disini',
                    position: 'bottom'
                },
                @endcan
            ]
            });
            intro.start();
        });
    </script>

    {{-- Transaksi --}}
    <script>
        document.getElementById('tutorTransaksi').addEventListener('click', function() {
            const intro = introJs();
            intro.setOptions({
                steps: [{
                    element: '#filterTransaksi',
                    intro: 'Disini Anda Dapat Mengsortir Transaksi Berdasarkan Jenis/Kategori Transaksi.',
                    position: 'bottom'
                },
                {
                    element: '#searchTransaksi',
                    intro: 'Anda Bisa Mencari Sebuah Transaksi Berdasarkan Kode Transaksi.',
                    position: 'bottom'
                },
                @can('admin')
                {
                    element: '#multipleDelete',
                    intro: 'Anda Bisa Menghapus Beberapa Transaksi Sekaligus.',
                    position: 'bottom'
                },
                {
                    element: '#duplicateTransaksi',
                    intro: 'Klik Disini Untuk Melihat Jika Ada Beberapa Transaksi Yang Terduplikat.',
                    position: 'bottom'
                },
                @endcan
                {
                    element: '#dataTransaksi',
                    intro: 'Disini Adalah List Data Transaksi',
                    position: 'bottom'
                }
            ]
            });
            intro.start();
        });
    </script>

    {{-- Cetak Kehadiran --}}
    <script>
        document.getElementById('tutorCetakKehadiran').addEventListener('click', function() {
            const intro = introJs();
            intro.setOptions({
                steps: [{
                    element: '#absenManual',
                    intro: 'Klik Disini Untuk Melakukan Pencatatan Kehadiran Secara Manual. Anda Perlu Membuat Absen Secara Manual Dahulu Disini Sebelum Melanjutkan Pencatatan Kehadiran.',
                    position: 'bottom'
                },
                {
                    element: '#absenEdit',
                    intro: 'Klik Disini Untuk Melakukan Perubahan Kehadiran Pada Karyawan.',
                    position: 'bottom'
                },
                {
                    element: '#qrAbsen',
                    intro: 'Klik Disini Untuk Mengunduh QrAbsen.',
                    position: 'bottom'
                },
                {
                    element: '#dateFilterAbsen',
                    intro: 'Klik Disini Untuk Melihat Data Kehadiran Pada Waktu Tertentu.',
                    position: 'bottom'
                },
                {
                    element: '#dataCetakKehadiran',
                    intro: 'Data-Data Kehadiran Karyawan Akan Ditampilkan Disini.',
                    position: 'bottom'
                },
            ]
            });
            intro.start();
        });
    </script>

    {{-- Kehadiran --}}
    <script>
        document.getElementById('tutorKehadiran').addEventListener('click', function() {
            const intro = introJs();
            intro.setOptions({
                steps: [{
                    element: '#boxKehadiran',
                    intro: 'Klik "Request Camera Permissions" Untuk Mengizinkan Aplikasi Mengakses Kamera Anda atau Anda Bisa Menggunakan "Scan an Image File" Untuk Mengupload QrAbsen Pada Aplikasi.',
                    position: 'bottom'
                },
            ]
            });
            intro.start();
        });
    </script>

    {{-- Muzakki --}}
    <script>
        document.getElementById('tutorMuzakki').addEventListener('click', function() {
            const intro = introJs();
            intro.setOptions({
                steps: [{
                    element: '#dataMuzakki',
                    intro: 'Data-Data Muzakki Akan Tampil Disini.',
                    position: 'bottom'
                },
            ]
            });
            intro.start();
        });
    </script>

    {{-- Mustahik --}}
    <script>
        document.getElementById('tutorMustahik').addEventListener('click', function() {
            const intro = introJs();
            intro.setOptions({
                steps: [{
                    element: '#tambahMustahik',
                    intro: 'Klik Disini Untuk Menambah Data-Data Mustahik.',
                    position: 'bottom'
                },
                {
                    element: '#dataMustahik',
                    intro: 'Data-Data Mustahik Akan Tampil Disini.',
                    position: 'bottom'
                },
            ]
            });
            intro.start();
        });
    </script>

    {{-- Amil --}}
    <script>
        document.getElementById('tutorAmil').addEventListener('click', function() {
            const intro = introJs();
            intro.setOptions({
                steps: [{
                    element: '#tambahAmil',
                    intro: 'Klik Disini Untuk Menambah Data-Data Amil.',
                    position: 'bottom'
                },
                {
                    element: '#dataAmil',
                    intro: 'Data-Data Amil Akan Tampil Disini.',
                    position: 'bottom'
                },
            ]
            });
            intro.start();
        });
    </script>

    {{-- Penyerahan --}}
    <script>
        document.getElementById('tutorPenyerahan').addEventListener('click', function() {
            const intro = introJs();
            intro.setOptions({
                steps: [{
                    element: '#tambahPenyerahan',
                    intro: 'Klik Disini Untuk Menambah Data-Data Penyerahan.',
                    position: 'bottom'
                },
                {
                    element: '#dataPenyerahan',
                    intro: 'Data-Data Penyerahan Akan Tampil Disini.',
                    position: 'bottom'
                },
            ]
            });
            intro.start();
        });
    </script>

    {{-- Penggajian --}}
    <script>
        document.getElementById('tutorPenggajian').addEventListener('click', function() {
            const intro = introJs();
            intro.setOptions({
                steps: [{
                    element: '#tambahPenggajian',
                    intro: 'Klik Disini Untuk Menambah Data-Data Penggajian.',
                    position: 'bottom'
                },
                {
                    element: '#dateFilterPenggajian',
                    intro: 'Klik Disini Untuk Menyortir Data Penggajian Berdasarkan Periode Yang Anda Pilih.',
                    position: 'bottom'
                },
                {
                    element: '#dataPenggajian',
                    intro: 'Data-Data Penggajian Akan Tampil Disini.',
                    position: 'bottom'
                },
            ]
            });
            intro.start();
        });
    </script>
</body>

</html>
