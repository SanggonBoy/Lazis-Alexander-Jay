<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lazis & Zakat</title>
    <link rel="shortcut icon" type="image/png"
        href="{{ asset('https://webicdn.com/sdirmember/26/25579/logotoko/xj97q.jpg') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/styles.min.css') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
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

    <script>
        const inputText = document.getElementById('kapital');
        const result = document.getElementById('result');

        inputText.addEventListener('input', function() {
            result.textContent = inputText.value;
        });
    </script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="{{ asset('dashboard/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dashboard/js/app.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('dashboard/js/dashboard.js') }}"></script>
    <script src="{{ asset('calendar/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

</body>

</html>
