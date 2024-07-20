<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Playstation Games</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset("images/playstationlogo.png") }}" />
        <!-- Bootstrap icons-->
        <link href="{{ asset("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css") }}" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset("css/styles2.css") }}" rel="stylesheet" />

        <!-- Link JQuery!-->
        <script src="{{ asset("https://code.jquery.com/jquery-3.6.0.min.js") }}"></script>
        <script src="{{ asset("https://code.jquery.com/ui/1.12.1/jquery-ui.js") }}"></script>
    </head>
    <body>
        @include('dashboardpelanggan.partials.navbar')
        <!-- Header-->
        @include('dashboardpelanggan.partials.header')
        <!-- Section-->
        <section class="py-5">
            @include('flash-message')
            @yield('container')
        </section>
        @include('dashboardpelanggan.partials.footer')
        <!-- Bootstrap core JS-->
        <script src="{{ asset("https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js") }}"></script>
        <!-- Core theme JS-->
        <script src="{{ asset("js/scripts.js") }}"></script>
    </body>
</html>
