@extends('layouts.dashboard.main')
@extends('layouts.dashboard.sidebar')
@extends('layouts.dashboard.header')
@extends('layouts.dashboard.footer')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="card-title fw-semibold mb-4">Kehadiran</h5>
                            <div class="card">
                                <button id="tutorKehadiran" class="btn btn-primary mb-3 d-block">
                                    <i class="fa fa-question-circle me-1" aria-hidden="true"></i>Info
                                </button>
                                <div class="card-body">
                                    <div id="boxKehadiran">
                                        <div id="reader" class="bg-primary-subtle" width="250"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
                        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
                        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
                    </script>

                    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                    <script>
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        function onScanSuccess(decodedText, decodedResult) {
                            var inputcode = decodedText;

                            $.ajax({
                                url: '/AttendanceCheck',
                                type: 'POST',
                                data: {
                                    result: inputcode
                                },
                                success: function(response) {
                                    if (response.valid) {
                                        Swal.fire({
                                            title: 'Success',
                                            text: 'QR code valid, kehadiran telah dicatat.',
                                            icon: 'success',
                                            confirmButtonText: 'OK'
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Error',
                                            text: response.message,
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                    }
                                },
                                error: function() {
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Terjadi kesalahan saat memproses data.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            });
                        }

                        function onScanFailure(error) {
                            console.log('Scan failed: ', error);
                        }

                        let html5QrcodeScanner = new Html5QrcodeScanner(
                            "reader", {
                                fps: 10,
                                qrbox: {
                                    width: 500,
                                    height: 500
                                }
                            },
                            false);
                        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                    </script>
                    <!-- Bootstrap core JS-->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
                    <script src="https://cdn.lordicon.com/lordicon.js"></script>
                    <!-- Core theme JS-->
                    <script src="{{ asset('front/js/scripts.js') }}"></script>
                    <!-- SB Forms JS-->
                    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
                @endsection
