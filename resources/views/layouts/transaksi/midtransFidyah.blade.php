<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lazis & Zakat</title>
    <link rel="shortcut icon" type="image/png"
        href="{{ asset('https://webicdn.com/sdirmember/26/25579/logotoko/xj97q.jpg') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/styles.min.css') }}" />
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="m-5 p-5" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @yield('content')
    </div>

    <script>
        const inputText = document.getElementById('kapital');
        const result = document.getElementById('result');

        inputText.addEventListener('input', function() {
            result.textContent = inputText.value;
        });
    </script>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $snapToken }}', {
                // Optional
                onSuccess: function(result) {
                    window.location.href = '/invoiceFidyah/{{ $order->id }}';
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>

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
