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
            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class="text-white" style="font-size: 16px">Movimiento Diario Venta</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        <a href="generarpdf({{ $data }})" class="btn btn-add mb-0">
                            <i class="fas fa-plus"></i> GENERAR PDF
                        </a>
                    </div>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-body p-4 m-1">
                    <div class="row justify-content-between">


                        <div class="col-12 col-md-2">
                            <h6>Elige el Tipo de Reporte</h6>
                            <div class="form-group">
                                <select wire:model="reportType" class="form-select">
                                    <option value="0">Ventas del Día</option>
                                    <option value="1">Ventas por Fecha</option>
                                </select>
                            </div>
                        </div>


                        @if ($this->verificarpermiso() == true)
                            <div class="col-md-2">
                                <h6 style="font-size: 1rem">Elige la Sucursal</h6>
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

                        <div class="col-md-2">
                            <h6 style="font-size: 1rem">Elige la Caja</h6>
                            <div class="form-group">
                                <select wire:model="caja" class="form-select">
                                    <option value="Todos">Todos</option>
                                    @foreach ($cajas as $c)
                                        <option value="{{ $c->idcaja }}">{{ $c->nombrecaja }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <h6>Fecha Desde</h6>
                            <div class="form-group">
                                <input @if ($reportType == 0) disabled @endif type="date"
                                    wire:model="dateFrom" class="form-control" placeholder="Click para elegir">
                            </div>
                            <div class="form-group">
                                <input @if ($reportType == 0) disabled @endif type="time"
                                    wire:model="timeFrom" class="form-control" placeholder="Click para elegir">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <h6>Fecha Hasta</h6>
                            <div class="form-group">
                                <input @if ($reportType == 0) disabled @endif type="date"
                                    wire:model="dateTo" class="form-control" placeholder="Click para elegir">
                            </div>
                            <div class="form-group">
                                <input @if ($reportType == 0) disabled @endif type="time"
                                    wire:model="timeTo" class="form-control" placeholder="Click para elegir">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>


            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm text-center">N°</th>
                                    <th class="text-uppercase text-sm ps-2">Fecha</th>
                                    <th class="text-uppercase text-sm ps-2">Cartera</th>
                                    <th class="text-uppercase text-sm ps-2 text-center">Caja</th>
                                    <th class="text-uppercase text-sm ps-2 text-center">Ingreso(Bs)</th>
                                    <th class="text-uppercase text-sm ps-2 text-center">Egreso(Bs)</th>
                                    <th class="text-uppercase text-sm ps-2 text-center">Motivo</th>
                                    @if ($this->verificarpermiso() == true)
                                        <th class="text-uppercase text-sm ps-2 text-center">Utilidad(Bs)
                                        </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr style="font-size: 14px">
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ date('d/m/Y h:i A', strtotime($item->fecha)) }}
                                        </td>
                                        <td>
                                            {{ ucwords(strtolower($item->nombrecartera)) }}
                                        </td>
                                        <td class="text-center ps-0">
                                            {{ ucwords($item->nombrecaja) }}
                                        </td>
                                        <td class="text-center">
                                            @if ($item->tipo == 'INGRESO')
                                                {{ ucwords($item->importe) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->tipo == 'EGRESO')
                                                {{ ucwords($item->importe) }}
                                            @endif
                                        </td>
                                        <td class="text-center ps-0">
                                            {{ ucwords($item->motivo) }}
                                        </td>
                                        @if ($this->verificarpermiso() == true)
                                            <td class="text-center ps-0">
                                                @if ($this->buscarventa($item->idmovimiento)->count() > 0)
                                                    {{ number_format($this->buscarutilidad($this->buscarventa($item->idmovimiento)->first()->idventa), 2) }}
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="8">

                                    </td>
                                </tr>
                                @if ($this->verificarpermiso() == true)
                                    <tr>
                                        <td colspan="7" class="align-middle text-center">
                                            <p class="text-uppercase text-sm">
                                                <b>TOTAL UTILIDAD</b>
                                            </p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-uppercase ps-0">
                                                <b>{{ number_format($utilidad, 2) }}</b>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8">

                                        </td>
                                    </tr>
                                    @foreach ($listacarteras as $cartera)
                                        @if ($cartera->totales != 0)
                                            <tr>
                                                <td colspan="7">
                                                    <p class="text-uppercase text-sm">
                                                        <b>Total en Cartera:
                                                            {{ ucwords(strtolower($cartera->nombre)) }}</b>
                                                    </p>
                                                </td>
                                                <td class="text-right">
                                                    <p class="text-uppercase ps-7">
                                                        <b>{{ number_format($cartera->totales, 2) }}</b>
                                                    </p>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td colspan="7">
                                            <p class="text-uppercase text-sm">
                                                <b>TOTAL INGRESOS</b>
                                            </p>
                                        </td>
                                        <td class="text-right">
                                            <p class="text-uppercase ps-7">
                                                <b>{{ number_format($ingreso, 2) }}</b>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">
                                            <p class="text-uppercase text-sm">
                                                <b>TOTAL EGRESOS</b>
                                            </p>
                                        </td>
                                        <td class="text-right">
                                            <p class="text-uppercase ps-7">
                                                <b>{{ number_format($egreso, 2) }}</b>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">
                                            <p class="text-uppercase text-sm">
                                                <b>TOTAL INGRESOS - EGRESOS</b>
                                            </p>
                                        </td>
                                        <td class="text-right">
                                            <p class="text-uppercase ps-7">
                                                <b>{{ number_format($ingreso - $egreso, 2) }}</b>
                                            </p>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="7">

                                        </td>
                                    </tr>

                                    @foreach ($listacarteras as $cartera)
                                        @if ($cartera->totales != 0)
                                            <tr>
                                                <td colspan="6">
                                                    <p class="text-uppercase text-sm">
                                                        <b>Total en Cartera:
                                                            {{ ucwords(strtolower($cartera->nombre)) }}
                                                        </b>
                                                    </p>
                                                </td>
                                                <td class="text-right">
                                                    <p class="text-uppercase ps-7">
                                                        <b>{{ number_format($cartera->totales, 2) }}
                                                        </b>
                                                    </p>

                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td colspan="6">
                                            <p class="text-uppercase text-sm">
                                                <b>TOTAL INGRESOS</b>
                                            </p>
                                        </td>
                                        <td class="text-right">
                                            <p class="text-uppercase ps-7">
                                                <b>{{ number_format($ingreso, 2) }}</b>
                                            </p>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="6">
                                            <p class="text-uppercase text-sm">
                                                <b>TOTAL EGRESOS</b>
                                            </p>
                                        </td>
                                        <td class="text-right">
                                            <p class="text-uppercase ps-7">
                                                <b>{{ number_format($egreso, 2) }}</b>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <p class="text-uppercase text-sm">
                                                <b>TOTAL INGRESOS - EGRESOS</b>
                                            </p>
                                        </td>
                                        <td class="text-right">
                                            <p class="text-uppercase ps-7">
                                                <b>{{ number_format($ingreso - $egreso, 2) }}</b>
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
