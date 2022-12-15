<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>Sistema Edsoft</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Estilos para el Login --}}
    <style>
        
        h1 {
            letter-spacing: -1px;
            color: #5e72e4;
            font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;
        }
        a {
        color: #5e72e4;
        text-decoration: unset;
        }
        .login-root {
            background: rgba(255, 255, 255, 0); /*background: #fff;*/
            display: flex;
            width: 100%;
            min-height: 100vh;
            overflow: hidden;
        }
        .loginbackground {
            min-height: 692px;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
            z-index: 0;
            overflow: hidden;
        }
        .flex-flex {
            display: flex;
        }
        .align-center {
        align-items: center; 
        }
        .center-center {
        align-items: center;
        justify-content: center;
        }
        .box-root {
            box-sizing: border-box;
        }
        .flex-direction--column {
            -ms-flex-direction: column;
            flex-direction: column;
        }
        .loginbackground-gridContainer {
            display: -ms-grid;
            display: grid;
            -ms-grid-columns: [start] 1fr [left-gutter] (86.6px)[16] [left-gutter] 1fr [end];
            grid-template-columns: [start] 1fr [left-gutter] repeat(16,86.6px) [left-gutter] 1fr [end];
            -ms-grid-rows: [top] 1fr [top-gutter] (64px)[8] [bottom-gutter] 1fr [bottom];
            grid-template-rows: [top] 1fr [top-gutter] repeat(8,64px) [bottom-gutter] 1fr [bottom];
            justify-content: center;
            margin: 0 -2%;
            transform: rotate(-12deg) skew(-12deg);
        }
        .box-divider--light-all-2 {
            box-shadow: inset 0 0 0 2px #e3e8ee;
        }
        .box-background--blue {
            background-color: #5e72e4;
        }
        .box-background--white {
        background-color: #ffffff; 
        }
        .box-background--blue800 {
            background-color: #212d63;
        }
        .box-background--gray100 {
            background-color: #e3e8ee;
        }
        .box-background--cyan200 {
            background-color: #7fd3ed;
        }
        .padding-top--64 {
        padding-top: 64px;
        }
        .padding-top--24 {
        padding-top: 24px;
        }
        .padding-top--48 {
        padding-top: 48px;
        }
        .padding-bottom--24 {
        padding-bottom: 24px;
        }
        .padding-horizontal--48 {
        padding: 48px;
        }
        .padding-bottom--15 {
        padding-bottom: 15px;
        }


        .flex-justifyContent--center {
        -ms-flex-pack: center;
        justify-content: center;
        }

        .formbg {
            margin: 0px auto;
            width: 100%;
            max-width: 448px;
            background: rgba(255, 255, 255, 0.507);
            border-radius: 4px;
            box-shadow: rgba(60, 66, 87, 0.12) 0px 7px 14px 0px, rgba(0, 0, 0, 0.12) 0px 3px 6px 0px;
            border-radius: 20px;
        }
        span {
            display: block;
            font-size: 20px;
            line-height: 28px;
            color: #1a1f36;
        }
        label {
            margin-bottom: 10px;
        }
        .reset-pass a,label {
            font-size: 14px;
            font-weight: 600;
            display: block;
        }
        .reset-pass > a {
            text-align: right;
            margin-bottom: 10px;
        }
        .grid--50-50 {
            display: grid;
            grid-template-columns: 50% 50%;
            align-items: center;
        }

        .field input {
            font-size: 16px;
            line-height: 28px;
            padding: 8px 16px;
            width: 100%;
            min-height: 44px;
            border: unset;
            border-radius: 4px;
            outline-color: rgb(84 105 212 / 0.5);
            background-color: rgb(255, 255, 255);
            box-shadow: rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                        rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                        rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                        rgba(60, 66, 87, 0.16) 0px 0px 0px 1px, 
                        rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                        rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                        rgba(0, 0, 0, 0) 0px 0px 0px 0px;
        }

        input[type="submit"] {
            background-color: #5e72e4;
            box-shadow: rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                        rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                        rgba(0, 0, 0, 0.12) 0px 1px 1px 0px, 
                        #5e72e4 0px 0px 0px 1px, 
                        rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                        rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                        rgba(60, 66, 87, 0.08) 0px 2px 5px 0px;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
        }
        .field-checkbox input {
            width: 20px;
            height: 15px;
            margin-right: 5px; 
            box-shadow: unset;
            min-height: unset;
        }
        .field-checkbox label {
            display: flex;
            align-items: center;
            margin: 0;
        }
        a.ssolink {
            display: block;
            text-align: center;
            font-weight: 600;
        }
        .footer-link span {
            font-size: 14px;
            text-align: center;
        }
        .listing a {
            color: #697386;
            font-weight: 600;
            margin: 0 10px;
        }
        

    </style>

    {{-- Fondo Animado --}}
    <style>
        .bg {
        animation:slide 3s ease-in-out infinite alternate;
        background-image: linear-gradient(-60deg, rgb(255, 255, 255) 50%, #95a4f8 50%);
        bottom:0;
        left:-50%;
        opacity:.5;
        position:fixed;
        right:-50%;
        top:0;
        z-index:-1;
        }

        .bg2 {
        animation-direction:alternate-reverse;
        animation-duration:4s;
        }

        .bg3 {
        animation-duration:5s;
        }


        .content {
        background-color:rgba(255,255,255,.8);
        border-radius:.25em;
        box-shadow:0 0 .25em rgba(0,0,0,.25);
        box-sizing:border-box;
        left:50%;
        padding:10vmin;
        position:fixed;
        text-align:center;
        top:50%;
        transform:translate(-50%, -50%);
        }

        @keyframes slide {
        0% {
            transform:translateX(-25%);
        }
        100% {
            transform:translateX(25%);
        }
        }
    </style>

</head>
<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
