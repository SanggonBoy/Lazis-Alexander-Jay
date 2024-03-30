<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('trx.style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('front/assets/favicon.ico') }}" />
    <title>Lazis</title>
</head>

<body>
    @yield('content')
    <script src="{{ asset('trx.script.js') }}"></script>
</body>

</html>
