<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="robots" content="noindex, nofollow">
        <meta name="googlebot" content="noindex, nofollow, noarchieve,nosnippet">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

        <title>We Ride - Rent a scooter and start earning money</title>

        <link async rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link async rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
        <link async href="{{ asset('css/app.css') }}" rel="stylesheet">
        
        @yield('styles')
    </head>
    <body>

       @section('header')
           @include('partials.header')
       @show

        @yield('content')

        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        @yield('scripts')

       @section('footer')
           @include('partials.footer')
       @show

    </body>
</html>



