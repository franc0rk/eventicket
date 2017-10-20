<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap for the CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Bootstrap Flatly theme -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Left Sidebar -->
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>
        @guest
            @include('layouts.navs.guest')
        @else
            @if(Auth::user()->user_type_id == 1)
                @include('layouts.navs.admin')
            @else(Auth::user()->user_type_id == 2)
                @include('layouts.navs.client')
            @endif
        @endguest

        <div id="app">
            @yield('content')
        </div>

        <footer>
            <div class="col-xs-12">
                <p>EvenTicket&copy; 2017. Todos los derechos reservados.</p>
            </div>
        </footer>
        <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
