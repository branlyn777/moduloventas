<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 ps ps--active-y bg-white"
    id="sidenav-main">
    <div class="sidenav-header">

        <livewire:icono-controller>

        </livewire:icono-controller>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto ps" id="sidenav-collapse-main">








        <ul class="navbar-nav">
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#dashboardsExamples" class="nav-link active collapsed"
                    aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-money-coins text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Movimiento Diario</span>
                </a>
                <div class="collapse" id="dashboardsExamples" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('resumenmovimientos') }}">
                                <span class="sidenav-mini-icon"> M </span>
                                <span class="sidenav-normal"> Movimientos </span>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link active" href="{{ url('ingresoegreso') }}">
                                <span class="sidenav-mini-icon"> I </span>
                                <span class="sidenav-normal"> Ingresos/Egresos </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>




            @can('Administracion_Sidebar')
            
          

                <li class="nav-item">
                    <a  href="#dashboardsExamples" class="nav-link active collapsed"
                        aria-controls="dashboardsExamples" role="a" aria-expanded="false" style="pointer-events: none; background-color:transparent">
                        <span class="nav-link-text ms-1">Gestion</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagesExamples" class="nav-link collapsed"
                        aria-controls="pagesExamples" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Usuarios</span>
                    </a>
                    <div class="collapse" id="pagesExamples" style="">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ url('users') }}">
                                    <span class="sidenav-mini-icon"> U </span>
                                    <span class="sidenav-normal"> Usuarios </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ url('roles') }}">
                                    <span class="sidenav-mini-icon"> R </span>
                                    <span class="sidenav-normal"> Roles </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ url('permisos') }}">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal"> Permisos </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ url('asignar') }}">
                                    <span class="sidenav-mini-icon"> A </span>
                                    <span class="sidenav-normal"> Asignar Permisos</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan




            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#applicationsExamples2" class="nav-link collapsed"
                    aria-controls="applicationsExamples2" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-building text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Empresa</span>
                </a>
                <div class="collapse" id="applicationsExamples2" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('companies') }}">
                                <span class="sidenav-mini-icon"> E </span>
                                <span class="sidenav-normal"> Empresa </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('sucursales') }}">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal"> Sucursales </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('cajas') }}">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal"> Cajas </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('carteras') }}">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal"> Cartera </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('monedas') }}">
                                <span class="sidenav-mini-icon"> M </span>
                                <span class="sidenav-normal"> Moneda </span>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('carteramovcategoria') }}">
                                <span class="sidenav-mini-icon"> I </span>
                                <span class="sidenav-normal"> Ingresos/Egresos Categoria </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('clientes') }}">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal"> Clientes </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('procedenciaCli') }}">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal"> Procedencia Clientes </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('cortecajas') }}">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal"> Corte de Caja </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>





            <li class="nav-item">
            

                <a  href="#dashboardsExamples" class="nav-link active collapsed"
                aria-controls="dashboardsExamples" role="a" aria-expanded="false" style="pointer-events: none; background-color:transparent">
                <span class="nav-link-text ms-1">Inventarios</span>
            </a>
            </li>

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#componentsExamples2" class="nav-link "
                    aria-controls="componentsExamples" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-tag text-primary text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Gestión Productos</span>
                </a>
                <div class="collapse " id="componentsExamples2">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('destino_prod') }}">
                                <span class="sidenav-mini-icon"> A </span>
                                <span class="sidenav-normal"> Almacen Stock </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('products') }}"">
                                <span class="sidenav-mini-icon"> L </span>
                                <span class="sidenav-normal"> Lista Productos </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('categories') }}">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal"> Categoria Productos </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('operacionesinv') }}">
                                <span class="sidenav-mini-icon"> E </span>
                                <span class="sidenav-normal"> Entrada/Salida </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('all_transferencias') }}">
                                <span class="sidenav-mini-icon"> T </span>
                                <span class="sidenav-normal"> Transferencias </span>
                            </a>
                        </li>




                        <li class="nav-item ">
                            <a class="nav-link " data-bs-toggle="collapse" aria-expanded="false"
                                href="#gettingStartedExample">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal"> Parámetros <b class="caret"></b></span>
                            </a>
                            <div class="collapse " id="gettingStartedExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{ url('destino') }}">
                                            <span class="sidenav-mini-icon text-xs"> D </span>
                                            <span class="sidenav-normal"> Destinos </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{ url('locations') }}">
                                            <span class="sidenav-mini-icon text-xs"> M </span>
                                            <span class="sidenav-normal"> Mobiliarios </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{ url('unidades') }}">
                                            <span class="sidenav-mini-icon text-xs"> U </span>
                                            <span class="sidenav-normal"> Unidades </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{ url('marcas') }}">
                                            <span class="sidenav-mini-icon text-xs"> M </span>
                                            <span class="sidenav-normal"> Marcas </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>





                    </ul>
                </div>
            </li>


            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#componentsExamples" class="nav-link "
                    aria-controls="componentsExamples" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-bag-17 text-danger text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Compras</span>
                </a>
                <div class="collapse " id="componentsExamples">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('compras') }}">
                                <span class="sidenav-mini-icon"> L </span>
                                <span class="sidenav-normal"> Lista de Compras </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('orden_compras') }}">
                                <span class="sidenav-mini-icon"> O </span>
                                <span class="sidenav-normal"> Orden Compra </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('proveedores') }}">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal"> Proveedores </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>











            <li class="nav-item">
                
                <a  class="nav-link active collapsed"
                aria-controls="dashboardsExamples" role="a" aria-expanded="false" style="pointer-events: none; background-color:transparent">
                <span class="nav-link-text ms-1">Ventas</span>
                </a>
                
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{ url('pos') }}">
                    <div
                        class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-cart text-warning text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Nueva Venta</span>
                </a>
            </li>


            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#componentsExamples3" class="nav-link "
                    aria-controls="componentsExamples3" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-info text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Lista de Ventas</span>
                </a>
                <div class="collapse " id="componentsExamples3">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('salelist') }}">
                                <span class="sidenav-mini-icon"> V </span>
                                <span class="sidenav-normal"> Ventas Agrupadas </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('ventalistaproductos') }}">
                                <span class="sidenav-mini-icon"> V </span>
                                <span class="sidenav-normal"> Ventas No Agrupadas </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>





            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#componentsExamples4" class="nav-link "
                    aria-controls="componentsExamples3" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-collection text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Reportes</span>
                </a>
                <div class="collapse " id="componentsExamples4">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('salemovimientodiario') }}">
                                <span class="sidenav-mini-icon"> M </span>
                                <span class="sidenav-normal">Movimiento Diario Ventas</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('productosvendidos') }}">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal">Productos Mas Vendidos</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>






        </ul>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
            </div>
        </div>
        <div class="ps__rail-y" style="top: 0px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
    </div>
    <div class="sidenav-footer mx-3 ">
        <a href="{{ url('cortecajas') }}" class="btn btn-primary btn-lg w-100 mb-3">Corte Caja</a>
    </div>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 0px; right: 0px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
    </div>
</aside>














































