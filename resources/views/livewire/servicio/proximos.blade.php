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
    <h6 class="font-weight-bolder mb-0 text-white">LISTA DE SERVICIOS</h6>
</nav>
@endsection


@section('serviciocollapse')
    nav-link
@endsection

@section('servicioarrow')
    true
@endsection


@section('vistaserviciosnav')
    "nav-link active"
@endsection


@section('servicioshow')
    "collapse show"
@endsection

@section('vistaserviciosequipoli')
    "nav-item active"
@endsection
<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div>
            <div class="d-lg-flex mb-3">
                <div>
                    <h5 class="text-white" style="font-size: 16px">Servicios próximos a vencer</h5>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">
                    <div class="ms-auto my-auto">

                        <a href="{{ url('ordenesservicios') }}" class="btn btn-secondary">
                            Ir a Órdenes de Servicio
                            <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3 text-center">
                            <b>Buscar por Codigo</b>
                            <div class="form-group">
                                <div class="input-group">
                                        <span class="input-group-text text-body">
                                            <i class="fas fa-search" aria-hidden="true"></i>
                                        </span>
                                    @if($this->type == "PENDIENTE")
                                        <input type="text" wire:model="search" placeholder="Buscar en Pendientes" class="form-control">
                                    @else
                                        @if($this->type == "PROCESO")
                                            <input type="text" wire:model="search" placeholder="Buscar en Procesos" class="form-control">
                                        @else
                                            <input type="text" wire:model="search" placeholder="Buscar en Terminados" class="form-control">
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
    
                        <div class="col-12 col-sm-6 col-md-3 text-center">
                            <b>Seleccionar Sucursal</b>
                            <div class="form-group">
                                <select wire:model="sucursal_id" class="form-select">
                                    <option value="Todos">Todas las Sucursales</option>
                                    @foreach($listasucursales as $sucursal)
                                    <option value="{{$sucursal->id}}">{{$sucursal->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                        <div class="col-12 col-sm-6 col-md-3 text-center">
                            <b>Categoría Trabajo</b>
                            <div class="form-group">
                                <select wire:model.lazy="catprodservid" class="form-select">
                                    <option value="Todos" selected>Todos</option>
                                    @foreach ($categorias as $cat)
                                        <option value="{{ $cat->id }}" selected>{{ $cat->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('catprodservid')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="col-12 col-sm-6 col-md-3 text-center">
                            <b>Tipo de Servicio</b>
                            <div class="form-group">
                                <select wire:model="type" class="form-select">
                                    <option value="PENDIENTE">Pendientes</option>
                                    <option value="PROCESO">Propios en Proceso</option>
                                    <option value="TERMINADO">Propios Terminados</option>
                                </select>
                            </div>
                        </div>
    
                    </div>
                </div>
            </div>

                
         
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-head-bg-primary table-hover">
                            <thead>
                                <tr>
                                    <th class="text-sm text-center">FECHA ENTREGA</th>
                                    @if($this->type == "TERMINADO")
                                    <th class="text-sm text-center">ACABADO HACE</th>
                                    @else
                                    <th class="text-sm text-center">TIEMPO RESTANTE</th>
                                    @endif
                                    <th class="text-sm text-center">SERVICIO</th>
                                    <th class="text-sm text-center">IR A</th>
                                    <th class="text-sm text-center">TECNICO RECEPTOR</th>
                                    <th class="text-sm text-center">CÓDIGO ORDEN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderservices as $d)
                                    @if($d->encargado != "")
                                    <tr class="text-sm">
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($d->fecha_estimada_entrega)->format('d/m/Y h:i:s a') }}
                                        </td>
                                        <td class="text-center">
                                            @if($this->type == "PENDIENTE" || $this->type == "PROCESO")
                                                @if($d->tiempo < 0)
                                                <span class="stamp stamp" style="background-color: black">
                                                    EXPIRADO
                                                </span>
                                                @else
                                                    @if($d->tiempo == 0)
                                                    <span class="stamp stamp" style="background-color: red">
                                                        Menos de 1 Hora
                                                    </span>
                                                    @else
                                                        @if($d->tiempo == 1)
                                                        <span class="stamp stamp" style="background-color: orange;">
                                                            Más de 1 Hora
                                                        </span>
                                                        @else
                                                        <span class="stamp stamp" style="background-color: rgb(0, 167, 0)">
                                                            Más de {{$d->tiempo}} Horas
                                                        </span>
                                                        @endif
                                                    @endif
                                                @endif
                                            @else
                                                {{-- Si es Igual a TERMINADO --}}
                                                @if($d->tiempo == 0)
                                                <span class="stamp stamp" style="background-color: rgb(0, 209, 28)">
                                                    Hoy
                                                </span>
                                                @else
                                                    @if($d->tiempo > 19)
                                                    <span class="stamp stamp" style="background-color: red">
                                                        {{$d->tiempo}} Dias
                                                    </span>
                                                    @else
                                                    <span class="stamp stamp" style="background-color: orange">
                                                        {{$d->tiempo}} Dias
                                                    </span>
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            {{ucwords(strtolower($d->nombrecategoria))}} {{ucwords(strtolower($d->marca))}} {{strtolower($d->detalle)}}
                                            <br>
                                            <b>Falla Según Cliente:</b> {{ucwords(strtolower($d->falla_segun_cliente))}}
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-border btn-round btn-sm" href="{{ url('ordenesservicios/' . $d->id_orden) }}">
                                                    Ver
                                                    <span class="btn-label">
                                                        <i class="fa fa-link"></i>
                                                    </span>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            {{ $d->receptor }}
                                        </td>
                                        <td class="text-center">
                                            {{ $d->id_orden }}
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
