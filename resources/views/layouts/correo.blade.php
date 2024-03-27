<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loogo</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('../resources/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('../resources/css/navbar.css') }}">

    @stack('head')

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/1d4ce9f95e.js" crossorigin="anonymous"></script>

    {{-- CSRF token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" id="token">
</head>
<body>
  

    <script>
        let authed = false;

        @auth
            authed = true;
        @endauth
    </script>
    
    @yield('content')
</body>
</html>