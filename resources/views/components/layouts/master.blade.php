<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/unitama.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.741d8512.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>Home - IKA UNITAMA</title>
</head>

<body class="min-vh-100 d-flex flex-column"><!-- ** Vars-->
    @include('components.layouts.partials.header')

    @yield('content')

    @include('components.layouts.partials.footer')

</body>

</html>
