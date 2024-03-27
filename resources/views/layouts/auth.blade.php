<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAHM | Tienda de muebles</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('../resources/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('../resources/css/auth.css') }}">
    <!-- FAVICON -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('../resources/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('../resources/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('../resources/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('../resources/images/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('../resources/images/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#fbb3ff">
    <meta name="theme-color" content="#ffd3ff">
    
    @stack('head')

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/1d4ce9f95e.js" crossorigin="anonymous"></script>

    {{-- CSRF token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" id="token">
</head>
<body>    
    @yield('content')
</body>
</html>