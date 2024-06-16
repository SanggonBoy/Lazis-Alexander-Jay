<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>LAZIS</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('front/assets/favicon.ico') }}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('front/css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('node_modules/intro.js/minified/introjs.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('node_modules/intro.js/themes/introjs-modern.css') }}" />
    @notifyCss

    <style>
        /* CSS Kustom untuk Tooltip Intro.js */
        .introjs-tooltip {
            background-color: #343a40;
            /* Gunakan warna Bootstrap untuk latar belakang */
            color: #fff;
            /* Warna teks */
            border-radius: 0.25rem;
            /* Sudut melengkung Bootstrap */
            padding: 1rem;
            /* Padding Bootstrap */
            max-width: 90vw;
            /* Lebar maksimum untuk responsif */
            word-wrap: break-word;
            /* Pemotongan kata */
        }

        /* Gaya Panah Tooltip */
        .introjs-arrow {
            border-color: #343a40 transparent transparent transparent;
            /* Sesuaikan dengan latar belakang tooltip */
        }

        /* Gaya Tombol */
        .introjs-button {
            background-color: #007bff;
            /* Warna tombol primary Bootstrap */
            color: #fff;
            /* Warna teks tombol */
            border: none;
            padding: 0.5rem 1rem;
            /* Padding Bootstrap */
            margin: 0.5rem;
            /* Margin antar tombol */
            border-radius: 0.25rem;
            /* Sudut melengkung Bootstrap */
            cursor: pointer;
        }

        /* Gaya Tombol Lewati */
        .introjs-button.introjs-skipbutton {
            background-color: #dc3545;
            /* Warna tombol danger Bootstrap */
        }

        /* Responsif untuk Mobile */
        @media (max-width: 600px) {
            .introjs-tooltip {
                font-size: 0.875rem;
                /* Ukuran font lebih kecil untuk mobile */
                padding: 0.5rem;
                /* Padding lebih kecil */
            }

            .introjs-button {
                padding: 0.375rem 0.75rem;
                /* Padding tombol lebih kecil */
                font-size: 0.875rem;
                /* Ukuran font tombol lebih kecil */
            }
        }

        /* CSS untuk Kontrol Intro.js */
        .introjs-tooltipbuttons {
            display: flex;
            /* Flexbox untuk tata letak tombol */
            justify-content: space-between;
            /* Jarak antar tombol */
        }

        .introjs-tooltipbuttons button {
            flex: 1;
            /* Biarkan tombol mengisi ruang yang tersedia */
            margin: 0 0.25rem;
            /* Margin antar tombol */
        }
    </style>
</head>

<body id="page-top">
    {{-- <div class="fixed-bottom float-end">
        <button type="button" class="btn btn-outline-success btn btn-lg rounded-pill m-2" data-bs-toggle="modal"
            data-bs-target="#pengaduan"><i class="fa fa-phone me-3" aria-hidden="true"></i>Layanan
            Pengaduan</button>
    </div>

    <div class="modal fade" id="pengaduan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Layanan Pengaduan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/pengaduan">
                        @csrf
                        <div class="mb-3">
                            <label for="subjek" class="form-label">Subjek</label>
                            <input type="text" class="form-control" id="subjek" name="subjek">
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea class="form-control" id="pesan" name="pesan"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-outline-primary">Kirim</button>
                </div>
                </form>
            </div>
        </div>
    </div> --}}
    <!-- Navigation-->
    @yield('navbar')
    <!-- Masthead-->
    @yield('header')
    <!-- Services-->
    @yield('services')
    <!-- Portfolio Grid-->
    @yield('porto')
    <!-- About-->
    @yield('about')
    <!-- Team-->
    @yield('team')
    <!-- Clients-->
    @yield('clients')
    <!-- Contact-->
    @yield('contact')
    <!-- Footer-->
    @yield('footer')
    <!-- Portfolio Modals-->
    @yield('portomodals')
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('front/js/scripts.js') }}"></script>
    
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    @notifyJs

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/6666f3e99a809f19fb3c0728/1i012hjcp';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('node_modules/intro.js/minified/intro.min.js') }}"></script>


    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            
            function setTourStatus(status) {
                const expiryDate = new Date();
                expiryDate.setDate(expiryDate.getDate() + 30);
                localStorage.setItem('tourStatus', JSON.stringify({
                    status,
                    expiry: expiryDate
                }));
                console.log('Status tur disimpan:', status);
            }
    
            
            function getTourStatus() {
                const tourData = localStorage.getItem('tourStatus');
                if (!tourData) return null;
    
                const {
                    status,
                    expiry
                } = JSON.parse(tourData);
                const currentDate = new Date();
    
                if (new Date(expiry) > currentDate) {
                    console.log('Status tur valid:', status);
                    return status;
                } else {
                    localStorage.removeItem('tourStatus');
                    console.log('Status tur kedaluwarsa, dihapus.');
                    return null;
                }
            }
    
            // Cek status tur
            const tourStatus = getTourStatus();
    
            if (!tourStatus) {
                
                Swal.fire({
                    title: 'Mulai Tur?',
                    text: "Apakah Anda ingin melihat tur panduan situs ini?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Mulai Tur',
                    cancelButtonText: 'Tidak, Terima Kasih'
                }).then((result) => {
                    if (result.isConfirmed) {
                        
                        const intro = introJs();
                        intro.setOptions({
                            steps: [{
                                    element: '#berita',
                                    intro: 'Berita Seputar Ke-Agamaan.',
                                    position: 'bottom'
                                },
                                {
                                    element: '#pelayanan',
                                    intro: 'Berikut Adalah Layanan Yang Kami Sediakan Untuk Anda!',
                                    position: 'bottom'
                                },
                                {
                                    element: '#kegiatan',
                                    intro: 'Ini Adalah Kegiatan Yang Telah Kami Lakukan Selama Menjalani Tugas Membantu Masyarakat.',
                                    position: 'bottom'
                                },
                                {
                                    element: '#tentang',
                                    intro: 'Singkat Sejarah Proses Perjalanan Kami.',
                                    position: 'bottom'
                                },
                                {
                                    element: '#tim',
                                    intro: 'Tim Kami Yang Merintis Membangun LAZIS Hingga Saat Ini.',
                                    position: 'bottom'
                                },
                                {
                                    element: '#kebijakan',
                                    intro: 'Klik Disini Untuk Melihat Kebijakan Kami.',
                                    position: 'bottom'
                                },
                                {
                                    element: '#login',
                                    intro: 'Klik Disini Untuk Bergabung Bersama Kami.',
                                    position: 'bottom'
                                },
                                {
                                    element: '#transaksi',
                                    intro: 'Klik Disini. Anda Bisa Menyumbangkan Sebagian Harta Anda Untuk Disalurkan Pada Orang-Orang Yang Membutuhkan.',
                                    position: 'bottom'
                                }
                            ],
                            nextLabel: 'Berikutnya',
                            prevLabel: 'Sebelumnya',
                            doneLabel: 'Selesai'
                        });

                        intro.oncomplete(() => {
                            setTourStatus(true);
                            console.log('Tur selesai.');
                        });

                        intro.onexit(() => {
                            setTourStatus(true);
                            console.log('Tur dihentikan.');
                        });
    
                        intro.start();
                    }
                });
            } else {
                console.log("Pengguna telah menyelesaikan tur sebelumnya.");
            }
        });
    </script>
    

</body>

</html>
