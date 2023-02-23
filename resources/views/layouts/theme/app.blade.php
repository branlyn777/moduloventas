<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <title>
        Edsoft
    </title>
    @yield('css')
    @include('layouts.theme.styles')
    

</head>

<body class="g-sidenav-show bg-gray-300">


    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>

    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    @include('layouts.theme.sidebar')


    <main class="main-content position-relative border-radius-lg ">

        @livewire('header')

        <div class="container-fluid py-4">
          @yield('content')
        </div>

    </main>

    @include('layouts.theme.footer')


  
    @include('layouts.theme.scripts')
    @yield('javascript')
    
</body>

</html>
