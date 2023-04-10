@section('migaspan')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-4 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
                <a class="text-white" href="javascript:;">
                    <i class="ni ni-box-2"></i>
                </a>
            </li>
            <li class="breadcrumb-item text-sm text-white"><a class="opacity-5 text-white"
                    href="{{ url('') }}">Inicio</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Gestion</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white">Ordenes de Servicios</h6>
    </nav>
@endsection

@section('serviciocollapse')
    nav-link
@endsection

@section('servicioarrow')
    true
@endsection

@section('ordenservicionav')
    "nav-link active"
@endsection

@section('servicioshow')
    "collapse show"
@endsection

@section('ordenservicioli')
    "nav-item active"
@endsection


@section('css')
    <style>
        /* Estilos para las tablas */
        .table-style {
            width: 100%;
            /* Altura de ejemplo */
            /* height: 300px; */
            overflow: auto;
        }
        .table-height {
            height: 300px;
        }

        .table-style table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        .table-style table thead {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            left: 0;
        }

        .table-style table thead th {
            padding-top: 3px;
            padding-bottom: 10px;
        }

        .table-style table tbody tr:hover {
            background-color: rgba(11, 99, 230, 0.308);
        }






        .table-style table thead tr {
            background: #ffffff;
            color: rgb(0, 0, 0);
        }

        .table-style table td {
            /* border-top: 0.3px solid #ffffff;
            border-right: 0.3px solid #ffffff; */
        }

        /* Estilos para el codigo de servicio */
        .code {
            padding-top: 1.5px;
            padding-bottom: 2.5px;
            padding-left: 6px;
            padding-right: 6px;
            background-color: #5e72e4;
            color: white;
            border-radius: 3px;
            cursor: pointer;
        }
        /* Estilos para la columna detalle de la tabla principal */
        .detail-service {
            cursor: pointer;
            padding-top: 0.3px;
            padding-bottom: 0.5px;
            padding-left: 4px;
            padding-right: 4px;
            color: #5e72e4;
            border-radius: 3px;
            font-size: 15px;
        }
        /* Estilos para la terjeta en la ventana modal detalle de servicio */
        .box-detail{
            width: 100%;
            height: 25px;
            font-size: 15px;
            color: white;
        }

        /* Estilos base para los botones (PENDIENTE, PROCESO, TERMINADO y ENTREGADO) */
        .btn-service {
            font-size: 12px;
            text-decoration: none !important;
            cursor: pointer;
            color: white;
            border-radius: 7px;
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left: 5px;
            padding-right: 5px;
            box-shadow: none;
            border-width: 2px;
            border-style: solid;
            display: inline-block;
        }

        .PENDIENTE {
            background-color: rgb(161, 0, 224);
            border-color: rgb(161, 0, 224);
            border-color: rgb(161, 0, 224);
        }

        .btn-service.PENDIENTE:hover {
            background-color: rgb(255, 255, 255);
            color: rgb(161, 0, 224);
            transition: all 0.4s ease-out;
            border-color: rgb(161, 0, 224);
            text-decoration: underline;
            -webkit-transform: scale(1.05);
            -moz-transform: scale(1.05);
            -ms-transform: scale(1.05);
            transform: scale(1.05);
        }

        .PROCESO {
            background-color: rgb(100, 100, 100);
            border-color: rgb(100, 100, 100);
            border-color: rgb(100, 100, 100);
        }

        .btn-service.PROCESO:hover {
            background-color: rgb(255, 255, 255);
            color: rgb(100, 100, 100);
            transition: all 0.4s ease-out;
            border-color: rgb(100, 100, 100);
            text-decoration: underline;
            -webkit-transform: scale(1.05);
            -moz-transform: scale(1.05);
            -ms-transform: scale(1.05);
            transform: scale(1.05);
        }

        .TERMINADO {
            background-color: rgb(224, 146, 0);
            border-color: rgb(224, 146, 0);
            border-color: rgb(224, 146, 0);
        }

        .btn-service.TERMINADO:hover {
            background-color: rgb(255, 255, 255);
            color: rgb(224, 146, 0);
            transition: all 0.4s ease-out;
            border-color: rgb(224, 146, 0);
            text-decoration: underline;
            -webkit-transform: scale(1.05);
            -moz-transform: scale(1.05);
            -ms-transform: scale(1.05);
            transform: scale(1.05);
        }

        .ALMACENADO {
            background-color: rgb(99, 64, 0);
            border-color: rgb(99, 64, 0);
            border-color: rgb(99, 64, 0);
            cursor: pointer;
        }
        .btn-service.ALMACENADO:hover {
            background-color: rgb(255, 255, 255);
            color: rgb(99, 64, 0);
            transition: all 0.4s ease-out;
            border-color: rgb(99, 64, 0);
            text-decoration: underline;
            -webkit-transform: scale(1.05);
            -moz-transform: scale(1.05);
            -ms-transform: scale(1.05);
            transform: scale(1.05);
        }

        .ENTREGADO {
            background-color: rgb(22, 192, 0);
            border-color: rgb(22, 192, 0);
            border-color: rgb(22, 192, 0);
            cursor: default !important;
        }


        /*Estilos para el Botón Editar Servicio de la Tabla*/
        .btn-edit {
            background-color: #008a5c;
            cursor: pointer;
            color: white;
            border-color: #008a5c;
            border-radius: 7px;
        }

        .btn-edit:hover {
            background-color: rgb(255, 255, 255);
            color: #008a5c;
            transition: all 0.4s ease-out;
            border-color: #008a5c;
            transform: translateY(-2px);
        }

        .btn-edit-deliver {
            background-color: #004585;
            cursor: pointer;
            color: white;
            border-color: #004585;
            border-radius: 7px;
        }

        .btn-edit-deliver:hover {
            background-color: rgb(255, 255, 255);
            color: #004585;
            transition: all 0.4s ease-out;
            border-color: #004585;
            transform: translateY(-2px);
        }
        .btn-formless-technical {
            background-color: #0043d4;
            cursor: pointer;
            color: white;
            border-color: #0043d4;
            border-radius: 7px;
            padding: 4px;
        }
        .btn-formless-technical:hover {
            background-color: #145bf3;
            color: #ffffff;
            transition: all 0.4s ease-out;
            border-color: #00a8db;
            padding: 4px;
            transform: translateY(-4px);
        }



        /* Definición de estilo del botón */
        .button {
        background-color: #4CAF50; /* color de fondo */
        border: none; /* borde sin estilo */
        color: white; /* color de texto */
        padding: 12px 24px; /* padding interno */
        text-align: center; /* centrar texto */
        text-decoration: none; /* sin subrayado */
        display: inline-block; /* mostrar como bloque */
        font-size: 16px; /* tamaño de letra */
        margin: 4px 2px; /* margen exterior */
        cursor: pointer; /* cursor al pasar por encima */
        transition-duration: 0.3s; /* duración de la transición */
        }

        /* Efecto hover */
        .button:hover {
        background-color: #3e8e41; /* color de fondo al pasar por encima */
        }

        /* Efecto hover after */
        .button:after {
        content: "";
        background-color: #4CAF50; /* color de fondo */
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: all 0.3s;
        }

        .button:hover:after {
        opacity: 1;
        }

        /* Efecto hover before */
        .button:before {
        content: "";
        background-color: #4CAF50; /* color de fondo */
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 0%;
        height: 100%;
        opacity: 0;
        transition: all 0.3s;
        }

        .button:hover:before {
        width: 100%;
        opacity: 1;
        }







        /* Estilos para la lista de marcas disponibles a elegir en la ventana modal editar */
        .product-search {
            position: relative;
        }
        #product-input {
            width: 100%;
            padding: 10px;
            /* font-size: 16px; */
        }
        #product-list {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            max-height: 200px;
            overflow-y: auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-top: none;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        #product-list li {
            padding: 10px;
            cursor: pointer;
            font-size: 12px;
        }
        #product-list li:hover {
            background-color: #5e72e4;
            color: white;
        }

        /* Estilos para l loading */
        .loader {
            width: 100%;
            height: 4.8px;
            display: inline-block;
            position: relative;
            overflow: hidden;
            }
            .loader::after {
            content: '';  
            width: 96px;
            height: 4.8px;
            background: #5e72e4;
            position: absolute;
            top: 0;
            left: 0;
            box-sizing: border-box;
            animation: hitZak 0.6s ease-in-out infinite alternate;
            }

            @keyframes hitZak {
            0% {
                left: 0;
                transform: translateX(-1%);
            }
            100% {
                left: 100%;
                transform: translateX(-99%);
            }
        }
                
    </style>
@endsection
<div>
    <div class="row">
        <div class="col-12">
            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class=" text-white">Órdenes de Servicios</h5>
                </div>
                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        <a class="btn btn-add mb-0" wire:click.prevent="go_new_service_order()">
                            <i class="fas fa-plus"></i>
                            Nueva Órden de Servicio
                        </a>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-3">
                            <label>Buscar</label>
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" wire:model="search" placeholder="{{ $this->search_all ? 'Busqueda General...' : 'Buscar por Código...' }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mt-2">
                            <label>&nbsp;</label>
                            <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                                <div class="form-check form-switch ms-2">
                                    <input class="form-check-input" type="checkbox" wire:model="search_all" title="{{ $this->search_all ? 'Click :: Para búsqueda solo por código' : 'Click :: Para busqueda general' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            {{-- <label>Categoria</label> --}}
                            {{-- <div class="form-group">
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" wire:model="search" placeholder="Buscar..."
                                        class="form-control">
                                </div>
                            </div> --}}
                        </div>
                        <div class="col-3">
                            <label>Estado Servicio</label>
                            <select wire:model="status_service_table" class="form-select">
                                <option value="TODOS">TODOS</option>
                                <option value="PENDIENTE">PENDIENTE</option>
                                <option value="PROCESO">PROCESO</option>
                                <option value="TERMINADO">TERMINADO</option>
                                <option value="ENTREGADO">ENTREGADO</option>
                                <option value="ALMACENADO">ALMACENADO</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <span wire:loading class="loader"></span>
                <div class="card-body p-4">
                    <div class="">
                        <div class="table-style">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-xs pe-3">#</th>
                                        <th class="text-uppercase text-xs pe-3">Código</th>
                                        <th class="text-uppercase text-xs">Fecha Recepción</th>
                                        <th class="text-uppercase text-xs">Fecha Estimada Entrega</th>
                                        <th class="text-uppercase text-xs ps-3">Responsable Técnico</th>
                                        <th class="text-uppercase text-xs">Servicios</th>
                                        <th class="text-uppercase text-xs text-end">Precio</th>
                                        <th class="text-uppercase text-xs ps-4">Técnico Receptor</th>
                                        <th class="text-uppercase text-xs ps-3">Estado</th>
                                        <th class="text-uppercase text-xs ps-4">Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($service_orders->count() > 0)
                                        @foreach ($service_orders as $so)
                                            @foreach ($so->services as $s)
                                                <tr>
                                                    <td class="text-center pe-3">
                                                        <span class="text-sm">
                                                            {{$so->number}}
                                                        </span>
                                                    </td>
                                                    <td class="pe-3">
                                                        <span class="text-sm code dropdown-toggle pointer"
                                                            id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <b>{{ $so->code }}</b>
                                                        </span>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <li>
                                                                <a class="dropdown-item" target=”_blank” href="{{ url('reporte/pdf' . '/' . $so->code) }}">
                                                                    Imprimir
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" wire:click.prevent="modify_order_service({{$so->code}})" class="dropdown-item">
                                                                    Modificar
                                                                </a>
                                                            </li>
                                                            @can('Anular_Servicio')
                                                            <li>
                                                                <a href="#" onclick="Confirm({{$so->code}}, '{{$so->client->nombre}}', 'Anular')" class="dropdown-item">
                                                                    Anular
                                                                </a>
                                                            </li>
                                                            @endcan
                                                            @can('Eliminar_Servicio')
                                                            <li>
                                                                <a href="#" onclick="Confirm({{$so->code}}, '{{$so->client->nombre}}', 'Eliminar')"  class="dropdown-item">
                                                                    Eliminar
                                                                </a>
                                                            </li>
                                                            @endcan
                                                            @if($s->type == "TERMINADO")
                                                            <li>
                                                                <a href="#" onclick="ConfirmStorageService({{$so->code}}, {{$s->idservice}}, '{{$so->client->nombre}}')"  class="dropdown-item">
                                                                    Almacenar
                                                                </a>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <span class="text-uppercase text-sm">
                                                            <b>{{ $so->client->nombre }}</b> 
                                                        </span>
                                                        <br>
                                                        <span class="text-sm">
                                                            {{ \Carbon\Carbon::parse($so->reception_date)->format('d/m/Y H:i') }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="text-sm">
                                                            {{ \Carbon\Carbon::parse($s->created_at)->format('d/m/Y H:i') }}
                                                        </span>
                                                    </td>
                                                    <td class="ps-3">
                                                        <span class="text-sm">
                                                            {{ $s->responsible_technician }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div wire:click.prevent="show_modal_detail({{$s->idservice}})" class="detail-service">
                                                            <span class="text-sm">
                                                                {{ $s->name_cps }} {{ $s->mark }}
                                                                {{ $s->detail }}
                                                                <br>
                                                                Falla: {{ substr($s->client_fail, 0, 20) }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="text-end">
                                                        <span class="text-sm">
                                                            <b>{{ number_format($s->price_service, 2, ',', '.') }}</b>
                                                        </span>
                                                    </td>
                                                    <td class="ps-4">
                                                        <span class="text-sm">
                                                            {{ $s->receiving_technician }}
                                                        </span>
                                                    </td>
                                                    <td class="ps-3">
                                                        <button wire:click.prevent="filter_type({{ $s->idservice }}, '{{ $s->type }}')" class="btn-service {{ $s->type }}">
                                                            {{ $s->type }}
                                                        </button>
                                                    </td>
                                                    <td class="ps-4">
                                                        <button wire:click.prevent="filter_edit({{ $s->idservice }}, '{{ $s->type }}')" class="{{ $s->type != 'ENTREGADO' ? 'btn-edit' : 'btn-edit-deliver' }} text-sm">
                                                            EDITAR
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @else
                                        <tr class="text-center">
                                            <td colspan="11">
                                                <br>
                                                <br>
                                                <br>
                                                <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                                                    style="opacity: 15%;" width="250pt" height="250pt"
                                                    viewBox="0 0 512.000000 512.000000"
                                                    preserveAspectRatio="xMidYMid meet">

                                                    <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                                                        fill="#000000" stroke="none">
                                                        <path
                                                            d="M2740 5107 c-49 -16 -123 -93 -138 -143 -6 -23 -12 -75 -12 -115 l0
                                                    -74 -81 -28 c-45 -15 -123 -47 -174 -71 l-93 -44 -53 54 c-64 65 -120 94 -180
                                                    94 -99 0 -109 -7 -341 -238 -120 -118 -225 -231 -234 -250 -46 -97 -27 -180
                                                    63 -273 l63 -66 -41 -89 c-23 -49 -54 -125 -69 -169 l-28 -80 -90 -7 c-106 -8
                                                    -151 -28 -204 -86 -55 -61 -60 -102 -56 -433 l3 -286 30 -49 c19 -30 49 -60
                                                    79 -78 42 -27 59 -31 141 -34 l93 -4 32 -88 c17 -48 49 -125 71 -171 l40 -82
                                                    -54 -56 c-74 -76 -91 -111 -91 -191 0 -85 14 -111 131 -231 52 -53 90 -99 86
                                                    -102 -5 -3 -37 -13 -73 -22 -36 -9 -212 -61 -392 -117 l-327 -100 -33 38 c-54
                                                    62 -67 64 -358 64 -239 0 -264 -2 -299 -20 -50 -25 -88 -71 -98 -118 -4 -20
                                                    -8 -289 -8 -597 0 -623 -4 -589 69 -653 56 -49 92 -54 359 -50 229 3 244 4
                                                    284 26 24 12 54 40 68 61 l26 38 187 -33 c103 -19 217 -37 253 -40 63 -6 66
                                                    -6 87 21 28 35 28 57 -1 90 -21 25 -41 30 -267 69 l-245 43 -3 455 -2 455 347
                                                    106 c596 183 665 196 1019 204 277 7 313 0 377 -65 66 -68 83 -142 48 -219
                                                    -39 -85 -130 -114 -349 -112 -128 1 -137 -1 -199 -43 -95 -64 -123 -217 -57
                                                    -310 58 -83 90 -95 411 -149 361 -61 538 -83 628 -76 39 3 312 62 607 131 295
                                                    69 551 126 568 126 45 0 98 -28 115 -61 33 -63 7 -152 -53 -183 -43 -22 -1667
                                                    -505 -1737 -516 -107 -17 -174 -11 -528 50 -191 33 -358 60 -371 60 -31 0 -63
                                                    -28 -71 -61 -5 -19 0 -34 17 -54 23 -26 40 -30 358 -86 379 -67 480 -77 600
                                                    -60 72 11 1642 470 1770 518 62 24 142 105 163 167 63 185 -51 361 -242 373
                                                    -58 4 -131 -11 -606 -122 -297 -69 -561 -129 -587 -132 -65 -8 -225 11 -543
                                                    63 -304 49 -338 57 -366 85 -27 27 -25 80 4 107 21 20 34 22 133 22 155 1 249
                                                    15 315 48 56 27 57 27 95 10 34 -15 76 -18 347 -18 335 0 352 2 410 58 49 46
                                                    69 97 76 195 l6 89 100 37 c55 21 130 53 167 71 l67 34 60 -57 c33 -32 77 -65
                                                    98 -74 51 -21 139 -21 183 1 48 25 446 422 472 471 26 49 28 134 5 188 -9 21
                                                    -42 65 -73 98 l-57 59 38 78 c21 42 53 118 71 167 l32 90 93 6 c127 8 182 38
                                                    231 130 23 43 23 49 23 344 0 328 -3 349 -58 411 -48 55 -97 75 -201 81 l-91
                                                    6 -23 71 c-13 39 -44 115 -69 169 l-46 98 55 57 c69 71 89 110 91 176 2 98 -9
                                                    114 -232 340 -224 227 -264 256 -354 256 -67 0 -112 -22 -183 -90 l-61 -59
                                                    -89 43 c-49 24 -126 56 -171 72 l-83 27 0 67 c0 129 -45 214 -134 256 -50 23
                                                    -55 24 -351 23 -189 -1 -313 -5 -335 -12z m631 -150 c31 -24 39 -56 39 -165 0
                                                    -91 3 -111 18 -124 9 -9 72 -34 139 -56 67 -23 172 -67 233 -98 133 -67 132
                                                    -68 240 41 112 113 101 117 333 -112 104 -104 196 -202 203 -220 19 -45 9 -65
                                                    -80 -153 -57 -56 -76 -81 -76 -101 0 -15 24 -75 54 -133 30 -59 70 -157 91
                                                    -219 54 -165 41 -154 189 -158 181 -6 166 24 166 -335 l0 -293 -26 -20 c-23
                                                    -18 -41 -21 -138 -21 -77 -1 -116 -5 -129 -14 -9 -7 -33 -62 -52 -122 -20 -60
                                                    -62 -163 -95 -230 -33 -67 -60 -132 -60 -144 0 -16 25 -49 75 -100 76 -79 99
                                                    -117 88 -147 -8 -26 -384 -403 -411 -414 -36 -14 -79 11 -157 90 -51 52 -76
                                                    71 -95 71 -15 0 -75 -25 -135 -55 -59 -30 -159 -72 -222 -92 -62 -20 -121 -42
                                                    -131 -49 -14 -10 -18 -34 -22 -139 -7 -178 20 -165 -337 -165 l-285 0 7 22
                                                    c32 108 30 189 -9 272 -37 80 -88 131 -174 173 l-76 38 -266 0 c-169 -1 -297
                                                    -6 -354 -14 l-89 -13 -134 134 c-106 107 -133 140 -133 162 0 21 20 49 85 116
                                                    49 51 85 97 85 108 0 11 -27 73 -59 139 -54 107 -121 284 -121 318 0 7 -12 23
                                                    -26 34 -23 18 -41 21 -138 21 -71 1 -117 5 -127 13 -36 28 -39 51 -39 326 l0
                                                    270 24 28 c24 27 27 28 150 33 69 3 129 10 135 15 5 6 28 66 50 134 23 68 66
                                                    171 96 229 30 58 55 116 55 130 0 16 -26 51 -85 112 -65 68 -85 95 -85 116 0
                                                    24 35 64 203 231 247 247 230 241 351 124 44 -43 91 -82 103 -85 15 -5 53 9
                                                    130 47 116 58 214 97 305 122 81 23 88 36 88 173 0 107 1 114 25 137 l24 25
                                                    283 0 c207 -1 287 -4 299 -13z m-2673 -3539 c9 -9 12 -145 12 -552 0 -488 -2
                                                    -541 -17 -558 -15 -16 -36 -18 -243 -18 -162 0 -229 3 -238 12 -9 9 -12 148
                                                    -12 563 0 304 3 555 7 558 12 13 478 8 491 -5z" />
                                                        <path
                                                            d="M2922 4430 c-157 -20 -382 -90 -423 -131 -25 -25 -25 -81 1 -104 29
                                                    -26 63 -22 171 18 147 55 233 70 399 70 323 1 596 -110 825 -338 452 -448 461
                                                    -1164 21 -1623 -126 -131 -268 -226 -428 -286 l-68 -26 0 224 c0 212 1 225 19
                                                    231 39 12 148 89 204 143 297 288 322 746 58 1068 -85 103 -236 204 -305 204
                                                    -44 0 -95 -34 -114 -78 -14 -31 -17 -88 -22 -348 l-5 -311 -29 -41 c-39 -57
                                                    -119 -97 -175 -87 -54 9 -115 55 -143 107 -22 41 -23 55 -28 353 -5 289 -6
                                                    312 -25 345 -15 24 -34 39 -62 50 -37 12 -48 12 -95 -3 -113 -36 -269 -187
                                                    -347 -336 -62 -120 -85 -214 -85 -356 -1 -284 137 -528 382 -678 l82 -50 0
                                                    -219 c0 -120 -3 -218 -6 -218 -14 0 -165 67 -219 98 -253 143 -446 373 -534
                                                    638 -50 151 -64 249 -58 419 6 182 34 299 106 451 64 134 115 207 222 320 98
                                                    102 107 127 64 169 -48 49 -90 27 -215 -110 -119 -131 -218 -305 -274 -484
                                                    -82 -261 -73 -600 24 -851 96 -246 279 -478 491 -619 156 -105 264 -153 449
                                                    -199 94 -23 125 -26 285 -27 249 0 402 34 603 137 358 182 613 516 699 918 25
                                                    119 25 390 -1 510 -113 524 -510 921 -1031 1031 -107 22 -311 31 -413 19z
                                                    m-185 -997 c-2 -280 -1 -290 21 -345 32 -80 99 -150 180 -190 127 -63 263 -38
                                                    367 67 26 25 59 72 73 103 l27 57 3 298 c2 163 5 297 8 297 16 0 98 -67 152
                                                    -124 67 -73 131 -191 153 -286 17 -75 15 -212 -5 -290 -47 -189 -187 -353
                                                    -369 -434 -30 -13 -60 -33 -66 -44 -7 -14 -11 -117 -11 -295 l0 -274 -52 -7
                                                    c-68 -8 -218 -8 -285 0 l-53 7 0 268 c0 147 -4 279 -9 292 -7 18 -35 37 -98
                                                    67 -157 76 -287 231 -339 405 -27 92 -25 249 5 345 29 94 47 130 106 208 42
                                                    56 164 162 186 162 5 0 8 -129 6 -287z" />
                                                    </g>
                                                </svg>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            @if ($service_orders->count() > 0)
                                {{ $service_orders->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.order_service.modal_assign_technician')
    @include('livewire.order_service.modal_terminated_service')
    @include('livewire.order_service.modal_deliver_service')
    @include('livewire.order_service.modal_edit_service')
    @include('livewire.order_service.modal_edit_service_deliver')
    @include('livewire.order_service.modal_detail_service')
</div>
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            window.livewire.on('show-assign-technician', Msg => {
                $('#assigntechnician').modal('show')
            });
            window.livewire.on('hide-assign-technician', Msg => {
                $('#assigntechnician').modal('hide')
            });


            window.livewire.on('show-terminated-service', Msg => {
                $('#terminatedservice').modal('show')
            });
            window.livewire.on('hide-terminated-service', Msg => {
                $('#terminatedservice').modal('hide')
            });


            window.livewire.on('show-deliver-service', Msg => {
                $('#deliverservice').modal('show')
            });
            window.livewire.on('hide-deliver-service', Msg => {
                $('#deliverservice').modal('hide')
            });


            window.livewire.on('show-edit-service', Msg => {
                $('#editservice').modal('show')
            });
            window.livewire.on('hide-edit-service', Msg => {
                $('#editservice').modal('hide')
            });


            window.livewire.on('show-edit-service-deliver', Msg => {
                $('#editservicedeliver').modal('show')
            });
            window.livewire.on('hide-edit-service-deliver', Msg => {
                $('#editservicedeliver').modal('hide')
            });


            window.livewire.on('show-detail-service', Msg => {
                $('#detailservice').modal('show')
            });
            window.livewire.on('hide-detail-service', Msg => {
                $('#detailservice').modal('hide')
            });
            

            //Código que se ejecuta cuando se haga click en editar (carga las marcas en el input con el id product-input)
            Livewire.on('marks-loaded', function(data) {

                //Actualzando la variable @this.s_mark
                const miInputmark = document.getElementById('product-input');
                miInputmark.value = @this.s_mark;
                //------------

                const list_marks = data;
                const products = list_marks.map(m => m.name);
                const input = document.getElementById('product-input');
                const list = document.getElementById('product-list');

                input.addEventListener('input', function() {
                    // Limpiar lista de productos
                    list.innerHTML = '';

                    // Obtener valor del input
                    const value = input.value.toLowerCase();

                    // Filtrar productos que coincidan con el valor ingresado
                    const filteredProducts = products.filter(function(product) {
                        return product.toLowerCase().includes(value);
                    });

                    // Agregar productos filtrados a la lista
                    filteredProducts.forEach(function(product) {
                        const li = document.createElement('li');
                        li.textContent = product;
                        li.addEventListener('click', function() {
                            input.value = product;
                            list.innerHTML = '';
                        });
                        list.appendChild(li);
                    });

                    // Mostrar lista de productos si hay resultados
                    if (filteredProducts.length > 0) {
                        list.style.display = 'block';
                    } else {
                        list.style.display = 'none';
                    }
                });

                // Ocultar lista de productos al hacer clic fuera del input
                document.addEventListener('click', function(event) {
                    if (event.target !== input && event.target.parentNode !== list) {
                        list.innerHTML = '';
                    }
                });
            });


            //Mostrar Mensaje No se Puede Eliminar
            window.livewire.on('delivered-finished', event => {
                swal("¡No se puede realizar esta acción!",
                    "No se pueden Anular o Eliminar las Ordenes de Servicio que tengan Servicios Terminados o Entregados", {
                        icon: "info",
                        buttons: {
                            confirm: {
                                className: 'btn btn-info'
                            }
                        },
                    });
            });


            //Mostrar Mensaje de tipo toast
            window.livewire.on('message-toast', event => {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '2em'
                });
                toast({
                    type: 'success',
                    title: @this.message_toast,
                    padding: '2em',
                })
            });

            


        });
        //Emite un evento para actualizar un servicio
        function updateService()
        {
            var mark = document.getElementById('product-input').value;
            window.livewire.emit('updateservice', mark)
        }
        //Lanza una alerta para eliminar o anular un servicio
        function Confirm(code, nameclient, type)
        {
            swal({
                title: '¿' + type + ' la Órden de Servicio "' + code + '"?',
                text: "Todos los Servicios correspondientes a esta Órden del Cliente: " + nameclient + " se verán afectados",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: type + ' Servicio',
                padding: '2em'
            }).then(function(result) {
                if (result.value)
                {
                    if(type == "Anular")
                    {
                        window.livewire.emit('annularservice', code);
                    }
                    else
                    {
                        if(type == "Eliminar")
                        {
                            window.livewire.emit('deleteservice', code);
                        }
                        else
                        {
                            window.livewire.emit('storeservice', code);
                        }
                    }
                }
            })
        }
        //Lannza una lerta para almacenar un servicio de una Órden de Servicio
        function ConfirmStorageService(code, idservice, nameclient)
        {
            swal({
                title: '¿Almacenar Servicio?',
                text: "Este servicio correspondinete a la Órden número " + code + " pasará a un estado almacenado",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Almacenar Servicio',
                padding: '2em'
            }).then(function(result) {
                if (result.value)
                {
                    window.livewire.emit('storeservice', idservice);
                }
            })
        }
    </script>
@endsection
