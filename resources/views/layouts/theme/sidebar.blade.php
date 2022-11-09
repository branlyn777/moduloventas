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
                                <a href="{{ url('resumenmovimientos') }}">
                                    <i class="fas fa-chart-line"></i>
                                    Movimientos
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('ingresoegreso') }}">
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
                        <svg width="25" height="35" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><style>.cls-1{fill:#02b1ce;}</style></defs>
                            <g id="Capa_6" data-name="Capa 6"><g id="Menu"><g id="Boton_Administración" data-name="Boton Administración">
                                <path class="cls-1" d="M87.91,196.8Q87,188.46,86,180.11c-.26-2.26-.44-4.52-.78-6.76a1.92,1.92,0,0,0-1-1.24c-5.55-2.18-11.12-4.28-17.09-6.56l-9,7.28-9.25,7.46L31.6,163c.25-.32.73-1,1.23-1.58,4.32-5.34,8.61-10.7,13-16a2.08,2.08,0,0,0,.23-2.62q-3.19-7.23-6.06-14.6c-.43-1.08-.8-1.6-2-1.72-7.21-.69-14.41-1.47-21.6-2.29-.48-.05-1.26-.7-1.27-1.09C15,119.42,15,115.77,15,112H71.33c.35,9,3.82,16.6,10.93,22.3a28.6,28.6,0,0,0,38-2.26,28.47,28.47,0,0,0,8.36-20.1H185c0,3.84,0,7.6-.05,11.35,0,.32-.8.86-1.27.91-7.13.81-14.27,1.6-21.41,2.26-1.4.13-1.8.71-2.27,1.92-1.88,4.86-3.9,9.66-6,14.42a2.07,2.07,0,0,0,.24,2.62c4.32,5.25,8.58,10.56,12.85,15.85.51.63,1,1.27,1.43,1.8l-17.39,17.24-18.23-14.72c-6,2.28-11.55,4.37-17.08,6.57a2.24,2.24,0,0,0-1.06,1.61c-.81,7.07-1.54,14.14-2.3,21.22-.06.62-.22,1.23-.33,1.85Z"/><path class="cls-1" d="M142.74,100.36H57.32a4.83,4.83,0,0,1-.14-.8c0-9.13-.14-18.26,0-27.39a19.32,19.32,0,0,1,19.33-19q23.41-.18,46.85,0A19.34,19.34,0,0,1,142.8,72.31c.18,9,0,18,0,27A10,10,0,0,1,142.74,100.36Z"/><path class="cls-1" d="M100.05,47.06a21.93,21.93,0,1,1,21.89-21.87A22,22,0,0,1,100.05,47.06Z"/><path class="cls-1" d="M45.82,100.34H15.11c0-.67-.09-1.22-.09-1.78,0-7.31,0-14.62,0-21.93C15.07,69.15,18.1,63.33,25,60a15.66,15.66,0,0,1,6.12-1.64c6-.21,12.05-.07,18.14-.07A39.36,39.36,0,0,0,47.13,64a55.76,55.76,0,0,0-1.25,9.69c-.17,8.12-.06,16.25-.06,24.38Z"/><path class="cls-1" d="M184.75,100.34H154.2V98q0-13.12-.07-26.27a28.56,28.56,0,0,0-2.9-12.2c-.19-.39-.33-.79-.57-1.38.7,0,1.24-.09,1.77-.08,5.79.09,11.6-.06,17.37.34,7.66.54,14.59,7.48,14.87,15.15C185,82.4,184.75,91.28,184.75,100.34Z"/><path class="cls-1" d="M53.36,13.37c14.08,0,23.8,14.64,18.15,27.38a3.19,3.19,0,0,1-2.39,2.07,30.67,30.67,0,0,0-15,8.71,3.65,3.65,0,0,1-2.58.95A19.59,19.59,0,0,1,42.36,16.8,19.45,19.45,0,0,1,53.36,13.37Z"/><path class="cls-1" d="M146.53,13.37c10.28,0,19.24,8.37,19.64,18.4a19.66,19.66,0,0,1-18,20.74,3.2,3.2,0,0,1-2.24-.88,32.3,32.3,0,0,0-15.28-9,3.49,3.49,0,0,1-2-1.65C122.67,28.43,132.39,13.39,146.53,13.37Z"/></g></g></g></svg>
						<p style="padding-left: 7px;">Administración</p>
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
                        <svg width="25" height="35"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><style>.cls-1{fill:#02b1ce;}</style></defs><g id="Capa_6" data-name="Capa 6"><g id="Menu"><g id="Boton_Inventarios" data-name="Boton Inventarios"><path class="cls-1" d="M98.52,6.12h2.94l2.4,1.23q40.79,20.25,81.58,40.46c3.24,1.59,4.56,3.75,4.55,7.3q-.11,44.77,0,89.54c0,3.74-1.48,6-4.78,7.61Q144,172.54,103,193A7.18,7.18,0,0,1,96,193q-40.89-20.44-81.82-40.8A6.91,6.91,0,0,1,10,145.31q.08-45.32,0-90.64a6.78,6.78,0,0,1,4.23-6.78q16-7.8,31.83-15.83a2.71,2.71,0,0,1,2.84.07q41.43,21.42,82.89,42.76a2.82,2.82,0,0,1,1.8,2.93c-.06,13.82,0,27.64,0,41.47,0,3.86,1,4.46,4.51,2.64,4.61-2.41,9.17-4.89,13.83-7.17a4.41,4.41,0,0,0,2.8-4.56q-.15-21.11,0-42.2a4.42,4.42,0,0,0-2.82-4.63Q111.32,42.69,70.83,21.86c-.56-.28-1.1-.63-1.93-1.1Z"/></g></g></g></svg>
                        <p style="padding-left: 7px;">Inventarios</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{url('proveedores')}}">
                                    <i class="fas fa-address-book"></i>
                                    Proveedores </a>
                            </li>
                            <li>
                                <a href="{{ url('categories') }}">
                                    <i class="fas fa-layer-group"></i>
                                    Categorias </a>
                            </li>
                            <li>
                                <a href="{{ url('products') }}">
                                    <i  class="flaticon-box-2 text-dark"></i>
                                    Productos </a>
                            </li>
                            <li>
                                <a href="{{url('compras')}}">
                                    <i class="flaticon-shopping-bag text-dark"></i>
                                    Compras </a>
                            </li>
                            <li>
                                <a href="{{url('destino_prod')}}">
                                    <i class="fas fa-store"></i>
                                    Almacen Producto </a>
                            </li>
                            <li>
                                <a href="{{url('operacionesinv')}}">
                                    <i class="fas fa-arrow-circle-right"></i>
                                    Entrada/Salida de Productos </a>
                            </li>
                            <li>
                                <a href="{{url('all_transferencias')}}">
                                    <i class="fas fa-exchange-alt"></i>
                                    Transferencia de Productos </a>
                            </li>
                            <li>
                                <a href="{{url('destino')}}">
                                    <i class="fas fa-warehouse"></i>
                                    Destinos </a>
                            </li>
                            <li>
                                <a href="{{url('locations')}}">
                                    <i class="fas fa-shapes"></i>
                                    Mobiliario </a>
                            </li>
                            <li>
                                <a href="{{ url('unidades') }}">
                                    <i class="fas fa-weight"></i>
                                    Unidades </a>
                            </li>
                            <li>
                                <a href="{{ url('marcas') }}">
                                    <i class="icon-tag"></i>
                                    Marcas </a>
                            </li>
                            {{-- <li>
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
                            </li> --}}
                            {{-- <li>
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
                            </li> --}}
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#submenu">
                        <svg width="25" height="35" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><style>.cls-1{fill:#02b1ce;}</style></defs><g id="Capa_6" data-name="Capa 6"><g id="Menu"><g id="Boton_Ventas" data-name="Boton Ventas"><path class="cls-1" d="M190,57c-1.05,4.61-2.14,9.2-3.13,13.82q-5.51,25.56-11,51.13c-1.36,6.34-6.38,10.29-13,10.29H52.72c.46,3.39.81,6.59,1.39,9.74.11.59,1.11,1.1,1.79,1.47.36.2.92,0,1.39,0h109a11.74,11.74,0,0,1,2.45.14,5.6,5.6,0,0,1-1.11,11.08c-3.46.07-6.91,0-10.37,0h-1.8c2.06,8.2.14,15-6.88,19.7a15.56,15.56,0,0,1-18,.17c-7.24-4.65-9.25-11.53-7.19-19.8H93.54c1.85,6.75.64,12.77-4.41,17.72a16,16,0,0,1-12.63,4.66,16.33,16.33,0,0,1-13-7.53c-3.05-4.56-3.54-9.56-1.93-14.92-2.11,0-4,0-6,0A12.55,12.55,0,0,1,43,143.94c-2.16-15-4.22-30-6.32-45q-3.25-23.29-6.53-46.6c-.75-5.39-1.54-10.78-2.21-16.18-.21-1.64-.81-2.38-2.56-2.33-3.16.1-6.32.05-9.49,0A5.65,5.65,0,0,1,10,28.17c0-3.2,2.51-5.56,6-5.58s7-.05,10.54,0A12.59,12.59,0,0,1,38.84,33.25c.48,2.94.87,5.9,1.32,9H174.29c9.37,0,12.32,2,15.71,10.54Zm-33.74,57.79a5.79,5.79,0,0,0,5,6.17c3,.31,5.53-1.69,6.19-5q5.56-27.78,11.09-55.56a6.63,6.63,0,0,0-.08-2.77,5.5,5.5,0,0,0-5.6-4.16,5.72,5.72,0,0,0-5.38,4.92Q162.95,81.22,158.4,104C157.65,107.74,156.92,111.47,156.26,114.82Z"/></g></g></g></svg>
						<p style="padding-left: 7px;">Ventas</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-collapse">


                            <li>
                                <a href="{{ url('pos') }}">
                                    <i class="fas fa-cart-arrow-down"></i>
                                    Nueva Venta </a>
                            </li>
                            <li>
                                <a href="{{ url('salelist') }}">
                                    <i class="fas fa-clipboard-list"></i>
                                    Lista de Ventas </a>
                            </li>
                            @can('VentasMovDia_Index')
                            <li>
                                <a href="{{ url('coins') }}">
                                    <i class="fas fa-money-bill-alt"></i>
                                    Denominaciones </a>
                            </li>
                            <li>
                                <a href="{{ url('devolucionventa') }}">
                                    <i class="fas fa-sync-alt"></i>
                                    Devolución Ventas </a>
                            </li>
                            <li>
                                <a href="{{ url('salemovimientodiario') }}">
                                    <i class="fas fa-calendar-alt"></i>
                                    Movimiento Diario Ventas</a>
                            </li>
                            <li>
                                <a href="{{ url('ventasreportecantidad') }}">
                                    <i class="fas fa-chart-pie"></i>
                                    Reporte Ventas Usuarios</a>
                            </li>
                            @endcan





                            
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