<!doctype html>
<html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/all.min.css')}}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @yield('stylesheets')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @guest
                    @include('layouts.OutHeader')
                @else
                    @include('layouts.LoggedHeader')
                @endguest
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
    @include('layouts.footer')
</div>

@yield('scripts')
<script>

    $(document).ready(function() {
        $("#basic-addon1, #searchBar").hover(function() {
                $('#searchBar').fadeIn(500);
            }, function() {
                $('#searchBar').fadeOut(500);
            }
        );
    });

</script>
<script>
    $(function() {
        setTimeout(function() { $("#hideMe").fadeOut(3000); }, 1000)

    })
</script>
</body>
</html>
