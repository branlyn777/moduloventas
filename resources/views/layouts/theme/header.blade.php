
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<livewire:name-controller>

				</livewire:name-controller>
				

				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

						<li class="nav-item dropdown hidden-caret">
							@if (@Auth::user()->hasPermissionTo('Corte_Caja_Index'))
							<a href="{{ url('cortecajas') }}" class="boton-blanco-g" role="button" aria-pressed="true">CORTE DE CAJA</a>            
							@endif
						  </li>




						<livewire:home-controller>
      					</livewire:home-controller>

						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="{{ asset('storage/usuarios/' . auth()->user()->image) }}" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="{{ asset('storage/usuarios/' . auth()->user()->image) }}" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>{{ auth()->user()->name }}</h4>
												<p class="text-muted">
													{{ auth()->user()->email }}
												</p><a href="{{ route('logout') }}" class="btn btn-xs btn-secondary btn-sm"
												onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
													Cerrar Sesión
												</a>
												<form action="{{ route('logout') }}" method="POST" id="logout-form">
													@csrf
												  </form>
											</div>
										</div>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>