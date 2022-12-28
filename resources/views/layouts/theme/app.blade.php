<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
  <link rel="icon" type="image/png" href="img/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>
    Edsoft
  </title>

  @yield('css')
	@include('layouts.theme.styles')
</head>

<body class="g-sidenav-show bg-gray-100 g-sidenav-pinned">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>

  @include('layouts.theme.sidebar')


  <main class="main-content position-relative border-radius-lg">

	@include('layouts.theme.header')

    <div class="container-fluid py-4">

		  @yield('content')

	  </div>
    
  </main>

  @include('layouts.theme.footer')



  @include('layouts.theme.scripts')
  @yield('javascript')


</body>

</html>