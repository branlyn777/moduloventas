@section('css')
    <style>
        /*Estilos para el Boton Pendiente en la Tabla*/
        .pendienteestilos {
            text-decoration: none !important;
            background-color: rgb(161, 0, 224);
            color: white;
            border-color: rgb(161, 0, 224);
            border-radius: 7px;
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left: 5px;
            padding-right: 5px;
            box-shadow: none;
            border-width: 2px;
            border-style: solid;
            border-color: rgb(161, 0, 224);
            display: inline-block;
        }

        /*Estilos para el Boton Proceso en la Tabla*/
        .procesoestilos {
            text-decoration: none !important;
            background-color: rgb(100, 100, 100);
            color: white;
            border-color: rgb(100, 100, 100);
            border-radius: 7px;
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left: 12px;
            padding-right: 12px;
            box-shadow: none;
            border-width: 2px;
            border-style: solid;
            border-color: rgb(100, 100, 100);
            display: inline-block;
        }

        /*Estilos para el Boton Terminado en la Tabla*/
        .terminadoestilos {
            text-decoration: none !important;
            background-color: rgb(224, 146, 0);
            color: white;
            border-color: rgb(224, 146, 0);
            border-radius: 7px;
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left: 5px;
            padding-right: 5px;
            box-shadow: none;
            border-width: 2px;
            border-style: solid;
            border-color: rgb(224, 146, 0);
            display: inline-block;
        }

        .ALMACENADO {
            text-decoration: none !important;
            background-color: rgb(99, 64, 0);
            color: white !important;
            cursor: default;
            border: none;
            border-radius: 7px;
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left: 5px;
            padding-right: 5px;
            box-shadow: none;
            border-width: 2px;
            border-style: solid;
            border-color: rgb(99, 64, 0);
            display: inline-block;
        }

        /*Estilos para el Boton Entregado en la Tabla*/
        .entregadoestilos {
            text-decoration: none !important;
            background-color: rgb(22, 192, 0);
            color: white !important;
            cursor: default;
            border: none;
            border-radius: 7px;
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left: 5px;
            padding-right: 5px;
            box-shadow: none;
            border-width: 2px;
            border-style: solid;
            border-color: rgb(22, 192, 0);
            display: inline-block;
        }


        /* Estilos para la Tabla - Ventana Modal Asignar Técnico  Responsable*/
        .table-wrapper {
            width: 100%;
            /* Anchura de ejemplo */
            height: 350px;
            /* Altura de ejemplo */
            overflow: auto;
        }

        .table-wrapper table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-wrapper table thead {
            position: -webkit-sticky;
            /* Safari... */
            position: sticky;
            top: 0;
            left: 0;
        }















        #preloader_3 {
            position: relative;
        }

        #preloader_3:before {
            width: 20px;
            height: 20px;
            border-radius: 20px;
            background: blue;
            content: '';
            position: absolute;
            background: #9b59b6;
            animation: preloader_3_before 1.5s infinite ease-in-out;
        }

        #preloader_3:after {
            width: 20px;
            height: 20px;
            border-radius: 20px;
            background: blue;
            content: '';
            position: absolute;
            background: #2ecc71;
            left: 22px;
            animation: preloader_3_after 1.5s infinite ease-in-out;
        }

        @keyframes preloader_3_before {
            0% {
                transform: translateX(0px) rotate(0deg)
            }

            50% {
                transform: translateX(50px) scale(1.2) rotate(260deg);
                background: #2ecc71;
                border-radius: 0px;
            }

            100% {
                transform: translateX(0px) rotate(0deg)
            }
        }

        @keyframes preloader_3_after {
            0% {
                transform: translateX(0px)
            }

            50% {
                transform: translateX(-50px) scale(1.2) rotate(-260deg);
                background: #9b59b6;
                border-radius: 0px;
            }

            100% {
                transform: translateX(0px)
            }
        }
    </style>
@endsection

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
        <h6 class="font-weight-bolder mb-0 text-white">Reporte De Servicios</h6>
    </nav>
@endsection


@section('serviciocollapse')
    nav-link
@endsection


@section('servicioarrow')
    true
@endsection


@section('reporteservicionav')
    "nav-link active"
@endsection


@section('servicioshow')
    "collapse show"
@endsection

@section('reporteservicioli')
    "nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12">
            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class=" text-white" style="font-size: 16px">{{ $componentName }}</h5>
                </div>
                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        <a class="btn btn-success mb-0 text-white {{ count($data) < 1 ? 'disabled' : '' }}"
                            type="button"
                            href="{{ url('reporteServicio/pdf' . '/' . $userId . '/' . $estado . '/' . $sucursal . '/' . $reportType . '/' . $dateFrom . '/' . $dateTo) }}">
                            Generar PDF</a>
                            <a href="ordenesservicios" type="button" class="btn btn-secondary">
                                Ir a Órdenes de Servicio
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-2">
                            <h6>Elige Usuario</h6>
                            <div class="form-group">
                                <select wire:model="userId" class="form-select">
                                    <option value="0">Todos</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-2">
                            <h6>Elige Estado</h6>
                            <div class="form-group">
                                <select wire:model="estado" class="form-select">
                                    <option value="Todos">Todos</option>
                                    <option value="PENDIENTE">Pendiente</option>
                                    <option value="PROCESO">Proceso</option>
                                    <option value="TERMINADO">Terminado</option>
                                    <option value="ENTREGADO">Entregado</option>
                                    <option value="ABANDONADO">Abandonado</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-2">
                            <h6>Sucursal</h6>
                            <div class="form-group">
                                <select wire:model="sucursal" class="form-select">
                                    <option value="0">Todos</option>
                                    @foreach ($sucursales as $suc)
                                        <option value="{{ $suc->id }}">{{ $suc->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-2">
                            <h6>Tipo de Reporte</h6>
                            <div class="form-group">
                                <select wire:model="reportType" class="form-select">
                                    <option value="0">Servicios del día</option>
                                    <option value="1">Servicios por fecha</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-2">
                            <h6>Fecha Desde</h6>
                            <div class="form-group">
                                <input @if ($reportType == 0) disabled @endif type="date"
                                    wire:model="dateFrom" class="form-control" placeholder="Click para elegir">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-2">
                            <h6>Fecha Hasta</h6>
                            <div class="form-group">
                                <input @if ($reportType == 0) disabled @endif type="date"
                                    wire:model="dateTo" class="form-control" placeholder="Click para elegir">
                            </div>
                            <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                                <div class="form-check form-switch ms-2">
                                    <input class="form-check-input" type="checkbox" wire:model="show_date" title="Mostrar/Ocultar Fechas">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="row">
                    <div class="col-12 col-sm-6 col-md-10 text-center"></div>
                    <div class="col-12 col-sm-6 col-md-2 text-center">
                        <a class="btn btn-primary {{ count($data) < 1 ? 'disabled' : '' }}"
                            href="{{ url('reporteServicio/pdf' . '/' . $userId . '/' . $estado . '/' . $sucursal . '/' . $reportType . '/' . $dateFrom . '/' . $dateTo) }}"
                            target="_blank" style='font-size:15px'>Generar PDF</a>
                    </div>
                </div> --}}

            {{-- <div class="row">
                    <div class="col-lg-3">
                        <label>
                            <h6 style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">TÉCNICO: {{ $tecnico }}</h6>
                        </label><br />
                    </div>
                    <div class="col-lg-3">
                        <label>
                            <h6 style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">ESTADO: {{ $estadovista }}</h6>
                        </label><br />
                    </div>
                    <div class="col-lg-3">
                        <label>
                            <h6 style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">FECHA DESDE:
                                {{ \Carbon\Carbon::parse($fechadesde)->format('d/m/Y') }}</h6>
                        </label><br />
                    </div>
                    <div class="col-lg-3">
                        <label>
                            <h6 style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">FECHA HASTA:
                                {{ \Carbon\Carbon::parse($fechahasta)->format('d/m/Y') }}</h6>
                        </label><br />
                    </div>
                </div> --}}
            {{-- <center>
                        <div id="preloader_3" wire:loading></div>
                    </center>
                    <br> --}}
            <br>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="width: 100%;">
                            <thead style="color: black;">
                                <tr>
                                    <th class="text-withe text-center text-sm">#</th>
                                    <th class="text-withe text-center text-sm">CÓDIGO</th>
                                    <th class="text-withe text-sm">CLIENTE</th>
                                    @if($this->show_date)
                                    <th class="text-withe text-center text-sm">
                                        FECHA REC
                                    </th>
                                    <th class="text-withe text-center text-sm">
                                        FECHA TERM.</th>
                                    <th class="text-withe text-center text-sm">
                                        FECHA ENTR.</th>
                                    @endif
                                    <th class="text-withe text-sm" style="text-align: right;">COSTO</th>
                                    <th class="text-withe text-sm" style="text-align: right;">IMPORTE</th>
                                    {{-- <th class="text-withe text-center text-sm" style="font-size: 90%">A CUENTA</th>
                                        <th class="text-withe text-center text-sm" style="font-size: 90%">SALDO</th>

                                        <th class="text-withe text-center text-sm" style="font-size: 90%">TIPO SERVICIO</th> --}}
                                    <th class="text-withe text-sm" style="text-align: right;">UTILIDAD</th>
                                    <th class="text-withe text-center text-sm">DETALLE</th>
                                    <th class="text-withe text-center text-sm">ESTADO</th>
                                    <th class="text-withe text-center text-sm">TEC. RESP.
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @if (count($data) < 1)
                                    <tr>
                                        <td colspan="9">
                                            <h5 class="text-center">Sin Resultados</h5>
                                        </td>
                                    </tr>
                                @endif

                                @foreach ($data as $d)
                                    <tr class="tablaserviciostr text-sm">
                                        {{-- # --}}
                                        <td width="2%">
                                            <h6 class="text-center"
                                                style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                {{ $loop->iteration }}</h6>
                                        </td>
                                        {{-- NÚMERO ORDEN --}}
                                        <td class="text-center">
                                            <a href="{{ url('ordenesservicios/' . $d->order_service_id) }}" target="_blank">
                                                {{ $d->order_service_id }}
                                            </a>
                                        </td>
                                        {{-- CLIENTE --}}
                                        <td>
                                            {{ ucwords(strtolower($d->movservices[0]->movs->climov->client->nombre)) }}
                                        </td>
                                        @if($this->show_date)
                                            {{-- FECHA --}}
                                            @foreach ($d->movservices as $mv)
                                                @if ($mv->movs->type == 'PENDIENTE')
                                                    <td class="text-center">
                                                        <h6
                                                            style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                            {{ \Carbon\Carbon::parse($mv->movs->created_at)->format('d/m/Y') }}
                                                        </h6>
                                                    </td>
                                                    @if ($mv->movs->status == 'ACTIVO')
                                                        <td class="text-center">
                                                            <h6
                                                                style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                                Pendiente</h6>
                                                        </td>
                                                        <td class="text-center">
                                                            <h6
                                                                style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                                Pendiente</h6>
                                                        </td>
                                                    @endif
                                                @endif
                                                @if ($mv->movs->type == 'PROCESO')
                                                    @if ($mv->movs->status == 'ACTIVO')
                                                        <td class="text-center">
                                                            <h6
                                                                style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                                Proceso</h6>
                                                        </td>
                                                        <td class="text-center">
                                                            <h6
                                                                style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                                Proceso</h6>
                                                        </td>
                                                    @endif
                                                @endif
                                                @if ($mv->movs->type == 'TERMINADO')
                                                    <td class="text-center">
                                                        <h6
                                                            style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                            {{ \Carbon\Carbon::parse($mv->movs->created_at)->format('d/m/Y') }}
                                                        </h6>
                                                    </td>
                                                    @if ($mv->movs->status == 'ACTIVO')
                                                        <td class="text-center">
                                                            <h6
                                                                style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                                Terminado</h6>
                                                        </td>
                                                    @endif
                                                @endif

                                                @if ($mv->movs->type == 'ENTREGADO')
                                                    <td class="text-center">
                                                        <h6
                                                            style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                            {{ \Carbon\Carbon::parse($mv->movs->created_at)->format('d/m/Y') }}
                                                        </h6>
                                                    </td>
                                                @elseif ($mv->movs->type == 'ABANDONADO')
                                                    <td class="text-center">
                                                        <h6
                                                            style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                            Abandonado</h6>
                                                    </td>
                                                @endif

                                                {{-- @if ($mv->movs->type == 'ABANDONADO')
                                                        @if ($mv->movs->status == 'ACTIVO')
                                                            <td class="text-center">
                                                                <h6>Abandonado</h6>
                                                            </td>
                                                            <td class="text-center">
                                                                <h6>Abandonado</h6>
                                                            </td>
                                                            <td class="text-center">
                                                                <h6>Abandonado</h6>
                                                            </td>
                                                        @endif
                                                    @endif --}}
                                            @endforeach
                                        @endif
                                        {{-- COSTO --}}
                                        <td style="text-align: right;">
                                            {{ number_format($d->costo, 2, ',', '.') }}
                                        </td>
                                        {{-- TOTAL --}}
                                        <td style="text-align: right;">
                                            @if ($d->movservices[0]->movs->status == 'ACTIVO')
                                                {{ number_format($d->movservices[0]->movs->import, 2,',','.') }}
                                            @else
                                                @if ($d->movservices[1]->movs->status == 'ACTIVO')
                                                    {{ number_format($d->movservices[1]->movs->import, 2,',','.') }}
                                                @else
                                                    @if ($d->movservices[2]->movs->status == 'ACTIVO')
                                                        {{ number_format($d->movservices[2]->movs->import, 2,',','.') }}
                                                    @else
                                                        @if ($d->movservices[3]->movs->status == 'ACTIVO')
                                                            {{ number_format($d->movservices[3]->movs->import, 2,',','.') }}
                                                        @else
                                                            {{ number_format($d->movservices[3]->movs->import, 2,',','.') }}a
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                        {{-- A CUENTA --}}
                                        {{-- <td class="text-center">
                                                <h6 style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                    {{ number_format($d->movservices[0]->movs->on_account, 2) }}</h6>
                                            </td> --}}
                                        {{-- SALDO --}}
                                        {{-- <td class="text-center">
                                                <h6 style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                    {{ number_format($d->movservices[0]->movs->saldo, 2) }}</h6>
                                            </td> --}}
                                        {{-- TIPO SERVICIO --}}
                                        {{-- <td class="text-center">
                                                <h6 style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">{{ $d->OrderServicio->type_service }}</h6>
                                            </td> --}}

                                        {{-- UTILIDAD --}}
                                        <td style="text-align: right;">
                                            {{ number_format($d->utilidad, 2,',','.') }}
                                        </td>

                                        {{-- DETALLE --}}
                                        <td class="text-center">
                                            {{ ucwords(strtolower($d->marca)) }}
                                            {{ ucwords(strtolower($d->categoria->nombre)) }}
                                            {{ ucwords(strtolower($d->detalle)) }}
                                            <br>
                                            <b>Falla:</b> {{ ucwords(strtolower($d->falla_segun_cliente)) }}
                                            </h6>

                                        </td>
                                        {{-- ESTADO Y TECNICO RESPONSABLE --}}
                                        @foreach ($d->movservices as $mv)
                                            @if ($mv->movs->type == 'PENDIENTE' && $mv->movs->status == 'ACTIVO')
                                                <td class="text-center">
                                                    <div class="pendienteestilos">
                                                        {{ $mv->movs->type }}
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    {{ ucwords(strtolower($mv->movs->usermov->name)) }}
                                                </td>
                                            @endif
                                            @if ($mv->movs->type == 'PROCESO' && $mv->movs->status == 'ACTIVO')
                                                <td class="text-center">
                                                    <div class="procesoestilos">
                                                        {{ $mv->movs->type }}
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    {{ ucwords(strtolower($mv->movs->usermov->name)) }}
                                                </td>
                                            @endif
                                            @if ($mv->movs->type == 'TERMINADO' && $mv->movs->status == 'ACTIVO')
                                                <td class="text-center">
                                                    <div class="terminadoestilos">
                                                        {{ $mv->movs->type }}
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    {{ ucwords(strtolower($mv->movs->usermov->name)) }}
                                                </td>
                                            @endif
                                            @if ($mv->movs->type == 'ENTREGADO' && $mv->movs->status == 'ACTIVO')
                                                <td class="text-center">
                                                    <div class="entregadoestilos">
                                                        {{ $mv->movs->type }}
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    {{ ucwords(strtolower($d->movservices[2]->movs->usermov->name)) }}
                                                </td>
                                            @endif
                                            @if ($mv->movs->type == 'ALMACENADO' && $mv->movs->status == 'ACTIVO')
                                                <td class="text-center">
                                                    <div class="ALMACENADO">
                                                        {{ $mv->movs->type }}
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <h6
                                                        style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                        {{ $mv->movs->usermov->name }}
                                                    </h6>
                                                </td>
                                            @endif
                                        @endforeach


                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="tablaserviciostr">
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td class="text-left">
                                        <span
                                            style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0"><b>TOTALES</b></span>
                                    </td>
                                    <td style="text-align: right" colspan="{{ $this->show_date ? '4' : '1' }}">
                                        <span
                                            style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0"><strong>
                                                @if (($estado == 'ENTREGADO' && $userId != 0) || ($estado == 'Todos' && $userId != 0))
                                                    {{ $costoEntregado }}
                                                @else
                                                    {{ number_format($data->sum('costo'), 2,',','.') }}
                                                @endif
                                            </strong></span>
                                    </td>
                                    <td style="text-align: right" colspan="1">
                                        <span
                                            style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0"><strong>
                                                @php
                                                    $mytotal = 0;
                                                @endphp
                                                @foreach ($data as $d)
                                                    @foreach ($d->movservices as $mv)
                                                        @if ($mv->movs->status == 'ACTIVO')
                                                            @php
                                                                $mytotal += $mv->movs->import;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                                {{ number_format($mytotal, 2,',','.') }}

                                            </strong></span>
                                    </td>
                                    <td style="text-align: right" colspan="0">
                                        <span class="text-sm">
                                            <b>{{ number_format($sumaUtilidad, 2,',','.') }}</b>
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        //eventos
        window.livewire.on('show-modal', msg => {
            $('#modalDetails').modal('show')
            noty(msg)
        });

    })
</script>
