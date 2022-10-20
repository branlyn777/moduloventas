<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />


	<livewire:icono-controller>

	</livewire:icono-controller>



    @include('layouts.theme.styles')
    @yield('css')

</head>
<body>
	<div class="wrapper">

        @include('layouts.theme.header')


		<!-- Sidebar -->
        @include('layouts.theme.sidebar')
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					@yield('content')
				</div>
			</div>
            {{-- @include('layouts.theme.footer') --}}
		</div>
	</div>
    @include('layouts.theme.scripts')
	@yield('javascript')
</body>
</html>