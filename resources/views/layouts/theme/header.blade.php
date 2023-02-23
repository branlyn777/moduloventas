<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky " id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-0">
        <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none me-4">
            <a href="javascript:;" class="nav-link p-0">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                </div>
            </a>
        </div>
        @yield('migaspan')


        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">

            </div>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item d-flex px-2 align-items-center">
                    <a class="nav-link text-white font-weight-bold px-0">

                        <span class="d-sm-inline d-none">{{ auth()->user()->name }}</span>
                    </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown px-2 d-flex align-items-center">
                    <a href="javascript:;" class="btn btn-primary btn-icon-only rounded-circle me-1 position-relative"
                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="btn-inner--icon"><i class="fa fa-bell text-lg"></i></span>
                        <span
                            class="text-xs badge  badge-circle position-absolute top-10 start-90 translate-middle badge-primary border-white">{{ auth()->user()->unreadNotifications->count() > 20? '20+': auth()->user()->unreadNotifications->count() }}
                        </span>


                    </a>




                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">

                        @forelse (auth()->user()->unreadNotifications->take(5) as $value)
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">

                                        <div class="d-flex flex-column justify-content-center">
                                            <p class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">Producto agotado
                                                    {{ $value->data['nombre'] }}</span>
                                                </p>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1" aria-hidden="true"></i>
                                                {{ $value->created_at->diffForHumans() }}

                                            </p>

                                        </div>
                                    </div>
                                </a>
                            </li>



                        @empty
                            <p class="text-sm text-secondary m-1">No tiene notificaciones</p>
                        @endforelse

                        <li>
                            <div class="d-flex flex-column">

                                <a class="btn btn-success btn-sm" href="notificaciones">Ver Todas</a>

                            </div>


                        </li>


                    </ul>



                </li>
                {{-- <li class="nav-item px-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0">
                        <div class="form-check form-switch ps-0 ms-auto my-auto">
                            @if (true)
                            
                            <i class="fas fa-sun me-1"></i>
                          <input class="form-check-input mt-1 ms-auto my-auto" style="height: 1.4em" wire:model='check' type="checkbox" id="dark-version" onclick="darkMode(this)">
                            
                          @else
                          <input class="form-check-input mt-1 ms-auto my-auto" style="height: 1.4em" type="checkbox" wire:model='check' id="dark-version" onclick="darkMode(this)">
                          <i class="fas fa-moon ms-1"></i>
                      
                            @endif
                          </div>
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer" aria-hidden="true"></i>
                    </a>
                </li> --}}
                <li class="nav-item dropdown px-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('storage/usuarios/' . auth()->user()->image) }}"
                            class="avatar avatar-sm  me-3 " alt="user image"
                            style="border: 2px solid #adabab;
                                            border-radius: 50%;">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="{{ asset('storage/usuarios/' . auth()->user()->image) }}"
                                            class="avatar avatar-sm  me-3 " alt="user image">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <p class="text-sm mb-1">
                                            <span class="font-weight-bold">{{ auth()->user()->name }}</span> <br>
                                          
                                        </p>
                                        <p class="text-xs text-secondary mb-0">
                                            {{ auth()->user()->email }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item border-radius-md" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                <div class="d-flex py-1">
                                    <div class="me-4 fs-4 my-auto">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <p class="text-sm mb-1">
                                            Cerrar Sesión
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                @csrf
                            </form>

                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
