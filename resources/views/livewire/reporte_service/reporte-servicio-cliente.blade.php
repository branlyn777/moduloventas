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
        <h6 class="font-weight-bolder mb-0 text-white">OrdenServicioCliente</h6>
    </nav>
@endsection

@section('serviciocollapse')
    nav-link
@endsection


@section('servicioarrow')
    true
@endsection


@section('ordenserviClinav')
    "nav-link active"
@endsection


@section('servicioshow')
    "collapse show"
@endsection

@section('reporteserviciocostoli')
    "nav-item active"
@endsection

<div>
    <div class="row">
        <div class="col-12">
            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class=" text-white" style="font-size: 16px">Orden Servicio Cliente</h5>
                </div>

            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        
                        @if (Auth::user()->hasPermissionTo('Filtrar_sucursal_Reporte_Servicio'))
                            <div class="col-12 col-sm-6 col-md-3 text-center">
                                <b>Seleccionar Sucursal</b>
                                <div class="form-group">
                                    <select wire:model="sucursal_id" class="form-select">
                                     
                                        <option value="Todos">Todas las Sucursales</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                        <div class="col-12 col-sm-6 col-md-3 text-center">
                            <b>Categoría Trabajo</b>
                            <div class="form-group">
                                <select wire:model.lazy="catprodservid" class="form-select">
                                    <option value="Todos" selected>Todos</option>
                                   
                                </select>
                              
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3 text-center">
                            <b>Tipo de Servicio</b>
                            <div class="form-group">
                                <select wire:model="type" class="form-select">
                                    <option value="PENDIENTE">Pendientes</option>
                                    <option value="PROCESO">Proceso</option>
                                    <option value="TERMINADO">Terminados</option>
                                    <option value="ENTREGADO">Entregados</option>
                                    <option value="Todos">Todos</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
          
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="align-items-center mb-0" style="width: 100%;">
                                <thead>
                                    <tr class="bg-primary text-center text-white">
                                        <th style="padding-top: 10px; padding-bottom: 10px;"
                                            class="text-uppercase text-xs font-weight-bolder">#</th>
                                            <th style="padding-top: 10px; padding-bottom: 10px;"
                                                class="text-uppercase text-xs font-weight-bolder">nombre</th>
                                        <th style="padding-top: 10px; padding-bottom: 10px;"
                                            class="text-uppercase text-xs font-weight-bolder ps-2">categoria
                                        </th>
                                        
                                </thead>
                                <tbody>
                                    @foreach ($orden_de_servicio->unique('codigo') as $os)
                                        <tr>
                                            <td class="text-center">
                                                <span class="text-sm">
                                                    {{ ($orden_de_servicio->currentpage()-1) * $orden_de_servicio->perpage() + $loop->index + 1 }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="bg-primary text-sm"
                                                    style="padding-top: 0.3px; padding-bottom: 0.5px;padding-left: 4px; padding-right: 4px; color: white; border-radius: 3px;">
                                                    <b>{{ $os->codigo }}</b>
                                                </span>
                                            </td>
                                            <td class="text-center text-sm">
                                                {{ \Carbon\Carbon::parse($os->fechacreacion)->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="text-center">
                                                <span class="text-sm">
                                                    @if ($os->servicios->count() == 1)
                                                        @foreach ($os->servicios as $d)
                                                            {{ \Carbon\Carbon::parse($d->fecha_estimada_entrega)->format('d/m/Y H:i') }}
                                                        @endforeach
                                                    @else
                                                        @foreach ($os->servicios as $d)
                                                            <div style="padding-top: 15px;">
                                                                {{ \Carbon\Carbon::parse($d->fecha_estimada_entrega)->format('d/m/Y H:i') }}
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-sm">
                                                    @if ($os->servicios->count() == 1)
                                                        @foreach ($os->servicios as $rt)
                                                            {{ ucwords(strtolower($rt->responsabletecnico)) }}
                                                        @endforeach
                                                    @else
                                                        @foreach ($os->servicios as $rt)
                                                            <div style="padding-top: 15px;">
                                                                {{ ucwords(strtolower($rt->responsabletecnico)) }}
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-dot me-4">
                                                    {{-- <i class="bg-info"></i> --}}
                                                    <span class="text-dark text-sm">
                                                        Cliente:
                                                        <b>{{ ucwords(strtolower($os->nombrecliente)) }}</b> |
                                                        Sucursal:
                                                        <b>{{ $os->nombresucursal }}</b>

                                                        @foreach ($os->servicios as $d)
                                                            @if ($os->servicios->count() == 1)
                                                                <div>
                                                                    <a href="javascript:void(0)"
                                                                        style="color: #1572e8;"
                                                                        wire:click="modalserviciodetalles('{{ $d->estado }}' , {{ $d->idservicio }}, {{ $os->codigo }})">
                                                                        {{ ucwords(strtolower($d->nombrecategoria)) }}
                                                                        {{ ucwords(strtolower($d->marca)) }}
                                                                        {{ strtolower($d->detalle) }}
                                                                        <br>
                                                                        <b>Falla Según Cliente:</b>
                                                                        {{ ucwords(strtolower($d->falla_segun_cliente)) }}
                                                                    </a>
                                                                </div>
                                                            @else
                                                                <div>
                                                                    <a href="javascript:void(0)"
                                                                        style="color: #1572e8;"
                                                                        wire:click="modalserviciodetalles('{{ $d->estado }}' , {{ $d->idservicio }}, {{ $os->codigo }})">
                                                                        {{ ucwords(strtolower($d->nombrecategoria)) }}
                                                                        {{ ucwords(strtolower($d->marca)) }}
                                                                        {{ strtolower($d->detalle) }}
                                                                        <br>
                                                                        <b>Falla Según Cliente:</b>
                                                                        {{ ucwords(strtolower($d->falla_segun_cliente)) }}
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-sm">
                                                    @if ($os->servicios->count() == 1)
                                                        @foreach ($os->servicios as $d)
                                                            {{ $d->importe }}
                                                        @endforeach
                                                    @else
                                                        @foreach ($os->servicios as $d)
                                                            <div style="padding-top: 15px;">
                                                                {{ $d->importe }}
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-sm">
                                                    @if ($os->servicios->count() == 1)
                                                        @foreach ($os->servicios as $dss)
                                                            {{ ucwords(strtolower($dss->tecnicoreceptor)) }}
                                                        @endforeach
                                                    @else
                                                        @foreach ($os->servicios as $dss)
                                                            <div style="padding-top: 15px;">
                                                                {{ ucwords(strtolower($dss->tecnicoreceptor)) }}
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-sm">
                                                    @if ($os->servicios->count() == 1)
                                                        @foreach ($os->servicios as $d)
                                                            @if ($d->estado == 'PENDIENTE')
                                                                @if (Auth::user()->hasPermissionTo('Asignar_Tecnico_Servicio'))
                                                                    <a href="javascript:void(0)"
                                                                        class="pendienteestilos"
                                                                        wire:click="modalasignartecnico({{ $d->idservicio }}, {{ $os->codigo }})"
                                                                        title="Asignar Técnico Responsable">
                                                                        {{ $d->estado }}
                                                                    </a>
                                                                @else
                                                                    <button type="button"
                                                                        class="pendienteestilos"
                                                                        onclick="ConfirmarTecnicoResponsable('{{ $os->codigo }}','{{ ucwords(strtolower($os->nombrecliente)) }}', {{ $d->idservicio }})"
                                                                        title="Ser Técnico Responsable de este Servicio">
                                                                        {{ $d->estado }}
                                                                    </button>
                                                                @endif
                                                            @else
                                                                @if ($d->estado == 'PROCESO')
                                                                    <a href="javascript:void(0)"
                                                                        class="procesoestilos"
                                                                        wire:click="modaleditarservicio2('{{ $d->estado }}', {{ $d->idservicio }}, {{ $os->codigo }})"
                                                                        title="Registrar Servicio Terminado o Actualizar Servicio">
                                                                        {{ $d->estado }}
                                                                    </a>
                                                                @else
                                                                    @if ($d->estado == 'TERMINADO')
                                                                        <a href="javascript:void(0)" class="terminadoestilos"
                                                                            wire:click="modalentregarservicio('{{ $d->estado }}', {{ $d->idservicio }}, {{ $os->codigo }})"
                                                                            title="Registrar Servicio como Entregado">
                                                                            {{ $d->estado }}
                                                                        </a>
                                                                    @else
                                                                        @if ($d->estado == 'ENTREGADO')
                                                                            <a href="javascript:void(0)"
                                                                                class="entregadoestilos">
                                                                                {{ $d->estado }}
                                                                            </a>
                                                                        @else
                                                                            @if ($d->estado == 'ABANDONADO')
                                                                                <button class="stamp stamp"
                                                                                    style="background-color: rgb(186, 238, 0)">
                                                                                    {{ $d->estado }}
                                                                                </button>
                                                                            @else
                                                                                @if ($d->estado == 'ANULADO')
                                                                                    <button class="stamp stamp"
                                                                                        style="background-color: rgb(0, 0, 0)">
                                                                                        {{ $d->estado }}
                                                                                    </button>
                                                                                @else
                                                                                    {{ $d->estado }}
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        @foreach ($os->servicios as $d)
                                                            @if ($d->estado == 'PENDIENTE')
                                                                @if (Auth::user()->hasPermissionTo('Asignar_Tecnico_Servicio'))
                                                                    <a href="javascript:void(0)"
                                                                        style="margin-top: 17px;"
                                                                        class="pendienteestilos"
                                                                        wire:click="modalasignartecnico({{ $d->idservicio }}, {{ $os->codigo }})"
                                                                        title="Asignar Técnico Responsable">
                                                                        {{ $d->estado }}
                                                                    </a>
                                                                @else
                                                                    <a href="javascript:void(0)"
                                                                        style="margin-top: 17px;"
                                                                        class="pendienteestilos"
                                                                        onclick="ConfirmarTecnicoResponsable('{{ $os->codigo }}','{{ ucwords(strtolower($os->nombrecliente)) }}', {{ $d->idservicio }})"
                                                                        title="Ser Técnico Responsable de este Servicio">
                                                                        {{ $d->estado }}
                                                                    </a>
                                                                @endif
                                                            @else
                                                                @if ($d->estado == 'PROCESO')
                                                                    <a href="javascript:void(0)"
                                                                        style="margin-top: 17px;"
                                                                        class="procesoestilos"
                                                                        wire:click="modaleditarservicio2('{{ $d->estado }}', {{ $d->idservicio }}, {{ $os->codigo }})"
                                                                        title="Registrar Servicio Terminado o Actualizar Servicio">
                                                                        {{ $d->estado }}
                                                                    </a>
                                                                @else
                                                                    @if ($d->estado == 'TERMINADO')
                                                                        <a href="javascript:void(0)" class="terminadoestilos"
                                                                            style="margin-top: 17px;"
                                                                            wire:click="modalentregarservicio('{{ $d->estado }}', {{ $d->idservicio }}, {{ $os->codigo }})"
                                                                            title="Registrar Servicio como Entregado">
                                                                            {{ $d->estado }}
                                                                        </a>
                                                                    @else
                                                                        @if ($d->estado == 'ENTREGADO')
                                                                            <a href="javascript:void(0)"
                                                                                style="margin-top: 17px;"
                                                                                class="entregadoestilos">
                                                                                {{ $d->estado }}
                                                                            </a>
                                                                        @else
                                                                            @if ($d->estado == 'ABANDONADO')
                                                                                <button class="stamp stamp"
                                                                                    style="background-color: rgb(186, 238, 0)">
                                                                                    {{ $d->estado }}
                                                                                </button>
                                                                            @else
                                                                                @if ($d->estado == 'ANULADO')
                                                                                    <button class="stamp stamp"
                                                                                        style="background-color: rgb(0, 0, 0)">
                                                                                        {{ $d->estado }}
                                                                                    </button>
                                                                                @else
                                                                                    {{ $d->estado }}
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                            <br>
                                                        @endforeach
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-sm">
                                                    @if ($os->servicios->count() == 1)
                                                        @foreach ($os->servicios as $d)
                                                            @if ($d->estado != 'ENTREGADO')
                                                                <button class="botoneditar"
                                                                    wire:click="modaleditarservicio1('{{ $d->estado }}',{{ $d->idservicio }},{{ $os->codigo }})"
                                                                    title="Editar Servicio">
                                                                    EDITAR
                                                                </button>
                                                            @else
                                                                @if (@Auth::user()->hasPermissionTo('Modificar_Detalle_Serv_Entregado'))
                                                                    <button class="botoneditarterminado"
                                                                        wire:click="modaleditarservicioterminado('{{ $d->estado }}',{{ $d->idservicio }},{{ $os->codigo }})"
                                                                        title="Editar Precio Servicio">
                                                                        EDITAR
                                                                    </button>
                                                                @else
                                                                    {{-- Espacio para que no se descuadre los botones --}}
                                                                    <div style="padding-top: 15px;">
                                                                        <button
                                                                            style="background-color: #00458500; border-color: #00458500;">
                                                                        </button>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        @foreach ($os->servicios as $d)
                                                            @if ($d->estado != 'ENTREGADO')
                                                                <button class="botoneditar"
                                                                    style="margin-top: 15px;"
                                                                    wire:click="modaleditarservicio1('{{ $d->estado }}',{{ $d->idservicio }},{{ $os->codigo }})"
                                                                    title="Editar Servicio">
                                                                    EDITAR
                                                                </button>
                                                                <br>
                                                            @else
                                                                @if (@Auth::user()->hasPermissionTo('Modificar_Detalle_Serv_Entregado'))
                                                                    <div style="padding-top: 15px;">
                                                                        <button class="botoneditarterminado"
                                                                            wire:click="modaleditarservicioterminado('{{ $d->estado }}',{{ $d->idservicio }},{{ $os->codigo }})"
                                                                            title="Editar Precio Servicio">
                                                                            EDITAR
                                                                        </button>
                                                                    </div>
                                                                @else
                                                                    {{-- Espacio para que no se descuadre los botones --}}
                                                                    <div style="padding-top: 15px;">
                                                                        <button
                                                                            style="background-color: #00458500; border-color: #00458500;">

                                                                        </button>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-sm">
                                                    <div class="btn-group" role="group"
                                                        aria-label="Button group with nested dropdown">
                                                        <div class="btn-group" role="group">
                                                            <button 
                                                                id="btnGroupDrop1" type="button"
                                                                class="btn btn-primary dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Opciones
                                                            </button>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="btnGroupDrop1">
                                                                {{-- <div class="asignar">
                                                                <a class="dropdown-item" href="#">Imprimir Servicio</a>
                                                                   </div> --}}
                                                                <div class="imprimir">
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('reporte/pdf' . '/' . $os->codigo) }}">Imprimir
                                                                        Orden de Servicio</a>
                                                                </div>
                                                                @if (@Auth::user()->hasPermissionTo('Modificar_Detalle_Serv'))
                                                                    <div class="modificar">
                                                                        <a class="dropdown-item"
                                                                            href="javascript:void(0)"
                                                                            wire:click="modificarordenservicio({{ $os->idcliente }},{{ $os->codigo }},'{{ $os->tiposervicio }}')">Modificar
                                                                            Orden de Servicio</a>
                                                                    </div>
                                                                @endif
                                                                @if (@Auth::user()->hasPermissionTo('Anular_Servicio'))
                                                                    <div class="anular">
                                                                        <a class="dropdown-item" href="#"
                                                                            onclick="ConfirmarAnular('{{ $os->codigo }}','{{ $os->nombrecliente }}')">Anular
                                                                            Orden de Servicio</a>
                                                                    </div>
                                                                @endif
                                                                @if (@Auth::user()->hasPermissionTo('Eliminar_Servicio'))
                                                                    <div class="eliminar">
                                                                        <a class="dropdown-item" href="#"
                                                                            onclick="ConfirmarEliminar('{{ $os->codigo }}','{{ $os->nombrecliente }}')">Eliminar
                                                                            Orden de Servicio</a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
















            
        </div>
    </div>
    
</div>