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

        <!-- Facebook opengraphs -->
        <meta property="og:url"                content="http://weriderentals.com" />
        <meta property="og:type"               content="website" />
        <meta property="og:title"              content="WeRide" />
        <meta property="og:description"        content="Rent a scooter in Sydney and start earning money" />
        <meta property="og:image"              content="http://weriderentals.com/images/scooter.jpeg" />
        <!-- end of facebook opengraph -->

        <title>WeRide - Rent a scooter in Sydney and start earning money</title>

        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        @yield('styles')

        <!-- Google Analytics -->
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-92688726-1', 'auto');
          ga('send', 'pageview');

        </script>
        <!-- End Google Analytics -->

    </head>
    <body>

      <!-- Yandex.Metrika counter -->
      <script type="text/javascript">
          (function (d, w, c) {
              (w[c] = w[c] || []).push(function() {
                  try {
                      w.yaCounter43079819 = new Ya.Metrika({
                          id:43079819,
                          clickmap:true,
                          trackLinks:true,
                          accurateTrackBounce:true,
                          webvisor:true,
                          trackHash:true
                      });
                  } catch(e) { }
              });

              var n = d.getElementsByTagName("script")[0],
                  s = d.createElement("script"),
                  f = function () { n.parentNode.insertBefore(s, n); };
              s.type = "text/javascript";
              s.async = true;
              s.src = "https://mc.yandex.ru/metrika/watch.js";

              if (w.opera == "[object Opera]") {
                  d.addEventListener("DOMContentLoaded", f, false);
              } else { f(); }
          })(document, window, "yandex_metrika_callbacks");
      </script>
      <!-- /Yandex.Metrika counter -->

      <!-- Facebook API for likes and shares -->    
      <div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_AU/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
      <!-- End facebook API --> 

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



