<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="robots" content="index, follow">
        <meta name="googlebot" content="index, follow, archieve,snippet">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="WeRide is a Sydney company proposing you an alternative and a low cost way to ride a scooter without buying it.">
        <meta name="author" content="">
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

        <!-- CSFR Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
        <!-- End CSFR Token -->

        <!-- Facebook opengraphs -->
        <meta property="og:url"                content="http://weriderentals.com" />
        <meta property="og:type"               content="website" />
        <meta property="og:title"              content="WeRide" />
        <meta property="og:description"        content="Rent a scooter in Sydney and start earning money" />
        <meta property="og:image"              content="http://weriderentals.com/images/scooter.jpeg" />
        <!-- end of facebook opengraph -->

        <title>WeRide - Rent a scooter in Sydney and start earning money</title>

    <title>{{ config('app.name', 'Tweelz') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fullcalendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-stars.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('styles')

    </head>
    <body>

       @section('header')
           @include('partials.header')
       @show

        @yield('content')
        
            <!-- Scripts -->
    
        <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/moment.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
        <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
        

        @yield('scripts')

    </body>
</html>



