<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LAZIS</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('front/assets/favicon.ico') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('front/css/styles.css') }}" rel="stylesheet" />
    @notifyCss
</head>

<body id="page-top">
    <div class="card">
        <div class="card-header bg-primary text-info-emphasis">
            <h1 class="text-center card-title fs-1 text-uppercase ">Pindai menggunakan kamera atau masukkan QrCode yang
                telah
                anda
                unduh.</h1>
            <div class="card-body">

            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div id="reader" class="bg-primary-subtle" width="250"></div>
            <form action="/QrValidasi" method="POST" id="form">
                @csrf
                <input type="hidden" name="result" id="result">
            </form>
            {{-- @foreach ($user as $users)
                <input type="hidden" name="qr_token" value="{{ $users->qr_token }}" id="qr_token">
            @endforeach --}}
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            
            var inputcode = decodedText;
            document.getElementById("result").value = inputcode;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            if (inputcode) {
                document.getElementById("form").submit();
            } else {
                alert('Data tidak ditemukan');
            }
        }

        function onScanFailure(error) {
            console.log('Data tidak ditemukan');
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
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    @notifyJs
</body>

</html>
