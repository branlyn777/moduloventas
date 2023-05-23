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
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Reportes</li>
    </ol>
    <span class="font-weight-bolder mb-0 text-white"> Movimiento Diario Ventas </span>
</nav>
@endsection


@section('Reportescollapse')
nav-link
@endsection


@section('Reportesarrow')
true
@endsection


@section('movimientodiarioventasnav')
"nav-link active"
@endsection


@section('Reportesshow')
"collapse show"
@endsection

@section('movimientodiarioventasli')
"nav-item active"
@endsection

<div>


















    <div>
        <div class="row">
            <div class="col-12">
                <div class="card-header pt-0 mb-4">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="text-white" style="font-size: 16px">REPORTE DE MOVIMIENTO DIARIO - VENTAS</h5>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
    
                                {{-- <button wire:click="Agregar()" class="btn btn-add "> <i class="fas fa-plus me-2"></i> Nueva
                                    Cartera Digital</button>
    
                                <a href="cortecajas" class="btn btn-secondary" data-type="csv" type="button">
                                    <span style="margin-right: 7px;" class="btn-inner--text">Ir a Corte de Caja</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
    
    
    
                <div class="card">
                    <div class="card-body">
    
                        <div class="row">
                            <div class="col-sm-2">
                                <span class="text-sm">Elige el Tipo de Reporte</span>
                                <div class="form-group">
                                    <select wire:model="reportType" class="form-select">
                                        <option value="0">Ventas del Día</option>
                                        <option value="1">Ventas por Fecha</option>
                                    </select>
                                </div>
                            </div>
        
        
                            @if ($this->verificarpermiso() == true)
                                <div class="col-sm-2">
                                    <span class="text-sm">Elige la Sucursal</span>
                                    <div class="form-group">
                                        <select wire:model="sucursal" class="form-select">
                                            <option value="Todos">Todos</option>
                                            @foreach ($sucursales as $su)
                                                <option value="{{ $su->idsucursal }}">
                                                    {{ $su->nombresucursal . ' - ' . $su->direccionsucursal }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
        
                            <div class="col-sm-2">
                                <span class="text-sm">Elige la Caja</span>
                                <div class="form-group">
                                    <select wire:model="caja" class="form-select">
                                        <option value="Todos">Todos</option>
                                        @foreach ($cajas as $c)
                                            <option value="{{ $c->idcaja }}">{{ $c->nombrecaja }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="col-sm-2 ">
                                <span class="text-sm">Fecha Desde</span>
                                <div class="form-group">
                                    <input @if ($reportType == 0) disabled @endif type="date"
                                        wire:model="dateFrom" class="form-control" placeholder="Click para elegir">
                                </div>
                                <div class="form-group">
                                    <input @if ($reportType == 0) disabled @endif type="time"
                                        wire:model="timeFrom" class="form-control" placeholder="Click para elegir">
                                </div>
                            </div>
                            <div class="col-sm-2 ">
                                <span class="text-sm">Fecha Hasta</span>
                                <div class="form-group">
                                    <input @if ($reportType == 0) disabled @endif type="date" wire:model="dateTo"
                                        class="form-control" placeholder="Click para elegir">
                                </div>
                                <div class="form-group">
                                    <input @if ($reportType == 0) disabled @endif type="time" wire:model="timeTo"
                                        class="form-control" placeholder="Click para elegir">
                                </div>
                            </div>
        
                            <div class="col-sm-2 mt-4">
        
        
        
                                {{-- <button wire:click.prevent="generarpdf({{ $data }})" class="btn btn-primary">
                                    GENERAR PDF
                                </button> --}}
        
                            </div>
        
                        </div>
                    </div>
                </div>
    
                <br>
    
    
                <div class="card mb-4">
                    <div style="padding-left: 12px; padding-right: 12px;">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table table-hover">
                                    <thead class="text-sm">
                                        <tr>
                                            <th class="text-center">N°</th>
                                            <th>FECHA</th>
                                            <th>CARTERA</th>
                                            <th>CAJA</th>
                                            <th class="text-end">INGRESO (Bs)</th>
                                            <th class="text-end">MOTIVO</th>
                                            <th class="text-end">COSTO</th>
                                            @if ($this->verificarpermiso() == true)
                                                <th class="text-end">UTILIDAD (Bs)</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr class="text-sm">
                                                <td class="text-center">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{ date('d/m/Y h:i A', strtotime($item->fecha)) }}
                                                </td>
                                                <td>
                                                    {{ ucwords(strtolower($item->nombrecartera)) }}
                                                </td>
                                                <td>
                                                    {{ ucwords($item->nombrecaja) }}
                                                </td>
                                                <td class="text-end">
                                                    @if ($item->tipo == 'INGRESO')
                                                        {{ number_format($item->importe + $item->totalsale, 2, ',', '.') }}
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    {{ ucwords($item->motivo) }}
                                                </td>
                                                <td class="text-end">
                                                    {{ number_format($item->costototal, 2, ',', '.') }}
                                                </td>
                                                @if ($this->verificarpermiso() == true)
                                                    <td class="text-end">
                                                        @if ($this->buscarventa($item->idmovimiento)->count() > 0)
                                                            {{ number_format($item->importe + $item->totalsale - $item->costototal, 2, ',', '.') }}
                                                        @endif
                                                    </td>
                                                @endif
                                        </tr>
                                        @endforeach
            
            
                                        <tr>
                                            <td colspan="8"></td>
                                        </tr>
            
            
                                        @if ($this->verificarpermiso() == true)
                                            <tr class="text-sm">
                                                <td colspan="6">
                                                    <b>TOTALES</b>
                                                </td>
                                                <td class="text-end">
                                                    <b>{{ number_format($total_costo_general, 2, ',', '.') }}</b>
                                                </td>
                                                <td class="text-end">
                                                    <b>{{ number_format($utilidad, 2, ',', '.') }}</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">
            
                                                </td>
                                            </tr>
            
                                            @foreach ($listacarteras as $cartera)
                                                @if ($cartera->totales != 0)
                                                    <tr class="text-sm">
                                                        <td colspan="7"><b>Total en Cartera:
                                                                {{ ucwords(strtolower($cartera->nombre)) }}</b></td>
                                                        <td class="text-end"><b>{{ number_format($cartera->totales, 2) }}</b>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            <tr class="text-sm">
                                                <td colspan="7"><b>TOTAL INGRESOS</b></td>
                                                <td class="text-end"> <b>{{ number_format($ingreso, 2) }}</b> </td>
                                            </tr>
            
                                            <tr class="text-sm">
            
                                                <td colspan="7"><b>TOTAL EGRESOS</b></td>
                                                <td class="text-end"> <b>{{ number_format($egreso, 2) }}</b> </td>
                                            </tr>
                                            <tr class="text-sm">
            
                                                <td colspan="7"><b>TOTAL INGRESOS - EGRESOS</b></td>
                                                <td class="text-end"> <b>{{ number_format($ingreso - $egreso, 2) }}</b> </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="7">
            
                                                </td>
                                            </tr>
            
                                            @foreach ($listacarteras as $cartera)
                                                @if ($cartera->totales != 0)
                                                    <tr class="text-sm">
                                                        <td colspan="7"><b>Total en Cartera:
                                                                {{ ucwords(strtolower($cartera->nombre)) }}</b></td>
                                                        <td class="text-end"><b>{{ number_format($cartera->totales, 2) }}</b>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
            
            
            
            
            
            
            
            
                                            <tr class="text-sm">
                                                <td colspan="6"><b>TOTAL INGRESOS</b></td>
                                                <td class="text-end"> <b>{{ number_format($ingreso, 2) }}</b> </td>
                                            </tr>
            
                                            <tr class="text-sm">
            
                                                <td colspan="6"><b>TOTAL EGRESOS</b></td>
                                                <td class="text-end"> <b>{{ number_format($egreso, 2) }}</b> </td>
                                            </tr>
                                            <tr class="text-sm">
                                                <td colspan="4"><b>TOTAL INGRESOS - EGRESOS</b></td>
                                                <td class="text-end"> <b>{{ number_format($ingreso - $egreso, 2) }}</b> </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="table-5">
    
                </div>
            </div>
        </div>
    </div>































</div>
