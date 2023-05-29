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
    <h6 class="font-weight-bolder mb-0 text-white"> Movimiento Diario Ventas </h6>
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

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                      <h6>Movimiento Diario Venta</h6>
                    </div>


                    <div style="padding-left: 15px; padding-right: 15px;">
                        <div class="row">
                            <div class="col-12 col-sm-4 col-md-2 text-center">
                                <h6 class="mb-0 text-sm">Elige el Tipo de Reporte</h6>
                                <div class="form-group">
                                    <select wire:model="reportType" class="form-select">
                                        <option value="0">Ventas del Día</option>
                                        <option value="1">Ventas por Fecha</option>
                                    </select>
                                </div>
                            </div>
    
    
                            @if($this->verificarpermiso() == true)
                            <div class="col-12 col-sm-4 col-md-2 text-center">
                                <h6 class="mb-0 text-sm">Elige la Sucursal</h6>
                                <div class="form-group">
                                    <select wire:model="sucursal" class="form-select">
                                        <option value="Todos">Todos</option>
                                        @foreach ($sucursales as $su)
                                            <option value="{{ $su->idsucursal }}">{{ $su->nombresucursal. ' - ' .$su->direccionsucursal }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
        
                            <div class="col-12 col-sm-4 col-md-2 text-center">
                                <h6 class="mb-0 text-sm">Elige la Caja</h6>
                                <div class="form-group">
                                    <select wire:model="caja" class="form-select">
                                        <option value="Todos">Todos</option>
                                        @foreach ($cajas as $c)
                                            <option value="{{ $c->idcaja }}">{{ $c->nombrecaja }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="col-12 col-sm-4 col-md-2 text-center ">
                                <h6 class="mb-0 text-sm">Fecha Desde</h6>
                                <div class="form-group">
                                    <input @if ($reportType == 0) disabled @endif type="date" wire:model="dateFrom"
                                        class="form-control" placeholder="Click para elegir">
                                </div>
                                <div class="form-group">
                                    <input @if ($reportType == 0) disabled @endif type="time" wire:model="timeFrom"
                                        class="form-control" placeholder="Click para elegir">
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-2 text-center ">
                                <h6 class="mb-0 text-sm">Fecha Hasta</h6>
                                <div class="form-group">
                                    <input @if ($reportType == 0) disabled @endif type="date" wire:model="dateTo"
                                        class="form-control" placeholder="Click para elegir">
                                </div>
                                <div class="form-group">
                                    <input @if ($reportType == 0) disabled @endif type="time" wire:model="timeTo"
                                        class="form-control" placeholder="Click para elegir">
                                </div>
                            </div>
        
                            <div class="col-12 col-sm-4 col-md-2 text-center mt-4">
        
                                
    
                                    <button wire:click.prevent="generarpdf({{$data}})" class="btn btn-primary">
                                        GENERAR PDF
                                    </button>
    
                            </div>
        
                        </div>
                    </div>
    
                    <br>


                    <div class="card-body px-0 pt-0 pb-2">
                      <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                          <thead>
                            <tr>
                              <th class="text-uppercase text-xxs font-weight-bolder">#</th>
                              <th class="text-uppercase text-xxs font-weight-bolder ps-2">Fecha</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">Cartera</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">Caja</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">Ingreso(Bs)</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">Egreso(Bs)</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">Motivo</th>
                              @if($this->verificarpermiso() == true)
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">Utilidad(Bs)</th>
                              @endif
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($data as $item)
                            <tr>
                              <td>
                                <p class="text-xs mb-0">
                                    {{$loop->iteration}}
                                </p>
                              </td>
                              <td>
                                <p class="text-xs mb-0">
                                    {{ date("d/m/Y h:i A", strtotime($item->fecha))}}
                                </p>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <p class="text-xs mb-0">
                                    {{ ucwords(strtolower($item->nombrecartera))}}
                                </p>
                              </td>
                              <td class="align-middle text-center">
                                <p class="text-xs mb-0">
                                    {{ ucwords($item->nombrecaja)}}
                                </p>
                              </td>
                              <td class="align-middle text-center">
                                <p class="text-xs mb-0">
                                    @if($item->tipo == "INGRESO")
                                        {{ucwords($item->importe)}}
                                    @endif
                                </p>
                              </td>
                              <td class="align-middle text-center">
                                <p class="text-xs mb-0">
                                    @if($item->tipo == "EGRESO")
                                        {{ucwords($item->importe)}}
                                    @endif
                                </p>
                              </td>
                              <td class="align-middle text-center">
                                <p class="text-xs mb-0">
                                    {{ ucwords($item->motivo) }}
                                </p>
                              </td>
                              @if($this->verificarpermiso() == true)
                              <td class="align-middle text-center">
                                <p class="text-xs mb-0">
                                    @if($item->tipo == "INGRESO")
                                        @if($this->buscarventa($item->idmovimiento)->count() > 0)
                                            {{ number_format($this->buscarutilidad($this->buscarventa($item->idmovimiento)->first()->idventa), 2) }}
                                        @endif

                                    @else

                                        -{{number_format($item->d_price - $item->d_cost,2)}}

                                    @endif

                                </p>
                              </td>
                              @endif
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="8">

                                </td>
                            </tr>
                            @if($this->verificarpermiso() == true)
                                <tr>
                                    <td colspan="7" class="align-middle text-center">
                                        <p class="text-xs mb-0">
                                            <b>TOTAL UTILIDAD</b>
                                        </p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs mb-0">
                                            <b>{{number_format($utilidad,2)}}</b>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8">

                                    </td>
                                </tr>
                                @foreach($listacarteras as $cartera)
                                    @if($cartera->totales != 0)
                                    <tr>
                                        <td colspan="7">
                                            <p class="text-xs mb-0">
                                                <b>Total en Cartera: {{ucwords(strtolower($cartera->nombre))}}</b>
                                            </p>
                                        </td>
                                        <td class="text-right">
                                            <p class="text-xs mb-0">
                                                <b>{{number_format($cartera->totales,2)}}</b>
                                            </p>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <td colspan="7">
                                        <p class="text-xs mb-0">
                                            <b>TOTAL INGRESOS</b>
                                        </p>
                                    </td>
                                    <td class="text-right">
                                        <p class="text-xs mb-0">
                                            <b>{{number_format($ingreso,2)}}</b>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <p class="text-xs mb-0">
                                            <b>TOTAL EGRESOS</b>
                                        </p>
                                    </td>
                                    <td class="text-right">
                                        <p class="text-xs mb-0">
                                            <b>{{number_format($egreso,2)}}</b>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <p class="text-xs mb-0">
                                            <b>TOTAL INGRESOS - EGRESOS</b>
                                        </p>
                                    </td>
                                    <td class="text-right">
                                        <p class="text-xs mb-0">
                                            <b>{{number_format( $ingreso - $egreso,2)}}</b>
                                        </p>
                                    </td>
                                </tr>
                                @else
                                    
                                <tr>
                                    <td colspan="7">

                                    </td>
                                </tr>

                                @foreach($listacarteras as $cartera)

                                    @if($cartera->totales != 0)
                                    <tr>
                                        <td colspan="6">
                                            <p class="text-xs mb-0">
                                                <b>Total en Cartera: {{ucwords(strtolower($cartera->nombre))}}</b>
                                            </p>
                                        </td>
                                        <td class="text-right">
                                            <p class="text-xs mb-0">
                                                <b>{{number_format($cartera->totales,2)}}</b>
                                            </p>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach








                                <tr>

                                    <td colspan="6">
                                        <p class="text-xs mb-0">
                                            <b>TOTAL INGRESOS</b>
                                        </p>
                                    </td>
                                    <td class="text-right"> <b>{{number_format($ingreso,2)}}</b> </td>
                                </tr>

                                <tr>

                                    <td colspan="6">
                                        <p class="text-xs mb-0">
                                            <b>TOTAL EGRESOS</b>
                                        </p>
                                    </td>
                                    <td class="text-right">
                                        <p class="text-xs mb-0">
                                            <b>{{number_format($egreso,2)}}</b>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <p class="text-xs mb-0">
                                            <b>TOTAL INGRESOS - EGRESOS</b>
                                        </p>
                                    </td>
                                    <td class="text-right">
                                        <p class="text-xs mb-0">
                                            <b>{{number_format( $ingreso - $egreso,2)}}</b>
                                        </p>
                                    </td>
                                </tr>
                            @endif

                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
</div>
