<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Majestic Cockroaches</title>

    <!-- Fonts -->

    <script src="https://kit.fontawesome.com/b07d89ef49.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @include('inc.switchsort')
    @include('inc.search')
</head>

<body>
    @include('inc.navbar')
    @include('inc.header')
    @yield('content')
</body>

</html>