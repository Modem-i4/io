<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ url('favicon.ico') }}">
    <title>Інвентаризація ОА</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
<!--script src="{{-- asset('js/app.js') --}}" defer></script-->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!--link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&family=Roboto:ital,wght@0,300;1,300&display=swap" rel="stylesheet"-->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        .full-height {
            height: 100vh;
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="text-center mb-4">
            <img class="mb-1" src="{{ url('/img/oa_logo.png') }}" alt="Герб Національного університету 'Острозька академія'" width="150" height="150">
            <h1 class="mb-3">Інвентаризація ОА</h1>
        </div>
        <a href="{{ route('login.google.redirect') }}" class="btn btn-lg btn-danger btn-block">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                 width="32" height="32"
                 viewBox="0 0 226 226"
                 style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,226v-226h226v226z" fill="none"></path><g fill="#ffffff"><path d="M113.02759,99.31641v29.68457h42.29224c-5.51758,17.9873 -20.55298,30.87085 -42.29224,30.87085c-25.87744,0 -46.87182,-20.99438 -46.87182,-46.87183c0,-25.87744 20.9668,-46.87183 46.87182,-46.87183c11.64209,0 22.26343,4.27612 30.45703,11.31104l21.84961,-21.8772c-13.79395,-12.58008 -32.16748,-20.24952 -52.30664,-20.24952c-42.92676,0 -77.71509,34.78833 -77.71509,77.6875c0,42.89917 34.78833,77.6875 77.71509,77.6875c65.21777,0 79.61866,-60.99683 73.21827,-91.26074z"></path></g></g></svg>
            <span> Вхід через пошту @oa.edu.ua</span>
        </a>
        <p class="mt-5 mb-3 h5 text-muted text-center">© 2020</p>
    </div>
</div>

{{--   @if (Route::has('login'))
    <div class="top-right links">
        @auth
            <a href="{{ url('/home') }}">Home</a>
        @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    </div>
@endif
--}}
</body>
</html>
