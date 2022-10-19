<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('storage/usuarios/' . auth()->user()->image) }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ auth()->user()->name }}
                            <span class="user-level">{{ auth()->user()->profile }}</span>
                        </span>
                    </a>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas icon-chart"></i>
                        <p>Movimiento Diario</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="../demo1/index.html">
                                    <i class="fas fa-chart-line"></i>
                                    Movimientos
                                </a>
                            </li>
                            <li>
                                <a href="../demo2/index.html">
                                    <i class="fas fa-money-bill-wave"></i>
                                    Ingresos / Egresos
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menú y Submenus</h4>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Administración</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            @can('Roles_Index')
                            <li>
                                <a href="{{ url('roles') }}">
                                    <i class="fas fa-address-card"></i>
                                    Roles </a>
                            </li>
                            @endcan
                            @can('Permission_Index')
                                <li>
                                    <a href="{{ url('permisos') }}">
                                        <i class="fas fa-chalkboard"></i>
                                        Permisos </a>
                                </li>
                            @endcan
                            @can('Asignar_Index')
                                <li>
                                    <a href="{{ url('asignar') }}">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                        Asignar permisos </a>
                                </li>
                            @endcan
                            @can('Usuarios_Index')
                                <li>
                                    <a href="{{ url('users') }}">
                                        <i class="fas fa-users"></i>
                                        Usuarios </a>
                                </li>
                            @endcan
                            @can('Cliente_Index')
                                <li>
                                    <a href="{{ url('clientes') }}">
                                        <i class="fas fa-user-tag"></i>
                                        Clientes </a>
                                </li>
                            @endcan
                            @can('Procedencia_Index')
                                <li>
                                    <a href="{{ url('procedenciaCli') }}">
                                        <i class="fas fa-user-lock"></i>
                                        Procedencia Clientes </a>
                                </li>
                            @endcan
                            @can('Empresa_Index')
                                <li>
                                    <a href="{{ url('companies') }}">
                                        <i class="fas fa-school"></i>
                                        Empresa </a>
                                </li>
                            @endcan
                            @can('Sucursal_Index')
                                <li>
                                    <a href="{{ url('sucursales') }}">
                                        <i class="fas fa-map-marked-alt"></i>
                                        Sucursales </a>
                                </li>
                            @endcan
                            @can('Caja_Index')
                                <li>
                                    <a href="{{ url('cajas') }}">
                                        <i class="fas fa-user-tie"></i>
                                        Cajas </a>
                                </li>
                            @endcan
                            @can('Cartera_Index')
                                <li>
                                    <a href="{{ url('carteras') }}">
                                        <i class="fas fa-wallet"></i>
                                        Cartera </a>
                                </li>
                                <li>
                                    <a href="{{ url('carteramovcategoria') }}">
                                        <i class="fas fa-layer-group"></i>
                                        Categoria Cartera Mov </a>
                                </li>

                            @endcan
                            @can('Corte_Caja_Index')
                                <li>
                                    <a href="{{ url('cortecajas') }}">
                                        <i class="fas fa-credit-card"></i>
                                        Corte caja </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-th-list"></i>
                        <p>Inventarios</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="sidebar-style-1.html">
                                    <span class="sub-item">Sidebar Style 1</span>
                                </a>
                            </li>
                            <li>
                                <a href="overlay-sidebar.html">
                                    <span class="sub-item">Overlay Sidebar</span>
                                </a>
                            </li>
                            <li>
                                <a href="compact-sidebar.html">
                                    <span class="sub-item">Compact Sidebar</span>
                                </a>
                            </li>
                            <li>
                                <a href="static-sidebar.html">
                                    <span class="sub-item">Static Sidebar</span>
                                </a>
                            </li>
                            <li>
                                <a href="icon-menu.html">
                                    <span class="sub-item">Icon Menu</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#submenu">
                        <i class="fas fa-bars"></i>
                        <p>Ventas</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a data-toggle="collapse" href="#subnav1">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav1">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a data-toggle="collapse" href="#subnav2">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav2">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Level 1</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item active">
                    <a href="{{ route('logout') }} class="btn btn-primary btn-block" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                        <i class="fa icon-logout"></i> 
                        <p>Cerrar Sesión</p>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>