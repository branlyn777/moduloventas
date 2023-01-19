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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Ventas</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white"> Movimientos </h6>
    </nav>
@endsection


@section('Reportescollapse')
    nav-link
@endsection


@section('Reportesarrow')
    true
@endsection


@section('movimientosnav')
    "nav-link active"
@endsection


@section('Reportesshow')
    "collapse show"
@endsection

@section('movimientosli')
    "nav-item active"
@endsection


<div>
    <div class="d-lg-flex" style="margin-bottom: 2.3rem">
        <h5 class="text-white" style="font-size: 16px">Movimientos Diarios </h5>

    </div>

    <div class="card">
        <div class="card-body">

            <div class="row">

                <div class="col-12 col-sm-6 col-md-2">

                    @can('Reporte_Movimientos_General')
                        <div class="form-group">
                            <b class="">Sucursal</b>
                            <select wire:model="sucursal" class="form-select">
                                @foreach ($sucursales as $item)
                                    <option wire:key="item-{{ $item->id }}" value="{{ $item->id }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                                <option value="TODAS">TODAS</option>
                            </select>
                        </div>
                    @endcan

                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="form-group">
                        <b class="">Caja</b>
                        <select wire:model="caja" class="form-select">
                            @foreach ($cajas as $item)
                                <option wire:key="item-{{ $item->id }}" value="{{ $item->id }}">
                                    {{ $item->nombre }}
                                </option>
                            @endforeach
                            <option value="TODAS">TODAS</option>

                        </select>

                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="form-group">

                        <b class="">Fecha inicial</b>

                        <input type="date" wire:model="fromDate" class="form-control">
                        @error('fromDate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="form-group">
                        <b class="">Fecha Final</b>
                        <input type="date" wire:model="toDate" class="form-control">
                        @error('toDate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="form-group">
                        <b style="color: #ffffff;">|</b>
                        <button
                            wire:click="generarpdf({{ $totalesIngresosV }}, {{ $totalesIngresosS }}, {{ $totalesIngresosIE }}, {{ $totalesEgresosV }}, {{ $totalesEgresosIE }}, {{ $op_sob_falt }})"
                            class="btn btn-warning form-control">
                            <i class="fas fa-print"></i> Generar PDF
                        </button>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="form-group">
                        <b style="color: #ffffff;">|</b>
                        <button wire:click="$emit('show-modaltotales')" class="btn btn-success form-control">
                            Mostrar Totales
                        </button>
                    </div>
                </div>
            </div>







        </div>
    </div>

    










    @if($totalesIngresosV->count() > 0)
    <br>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table style="width: 100%">

                        <thead>
                            <tr>
                                <th class="text-uppercase text-sm text-center">#</th>
                                <th class="text-uppercase text-sm">FECHA</th>
                                <th class="text-uppercase text-sm">DETALLE</th>
                                <th class="text-uppercase text-sm">INGRESO</th>
                                <th class="text-uppercase text-sm">
                                    @if (Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                        UTILIDAD
                                    @endif
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($totalesIngresosV as $p)
                                <tr>
                                    <td class="text-sm text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-sm">
                                        {{ \Carbon\Carbon::parse($p->movcreacion)->format('d/m/Y H:i') }}
                                    </td>
                                    <td>
                                        <div class="accordion-1">
                                            <div class="">
                                                <div class="row">
                                                    <div class="col-md-12 mx-auto">
                                                        <div class="accordion" id="accordionRental">

                                                            <div class="accordion-item mb-3">
                                                                <h6 class="accordion-header" id="headingOne">
                                                                    <button style="width: 510px;"
                                                                        class="accordion-button border-bottom font-weight-bold collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapseOne{{ $loop->iteration }}"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapseOne{{ $loop->iteration }}">

                                                                        <div class="text-sm">
                                                                            {{ $p->idventa }},{{ $p->tipoDeMovimiento }},{{ $p->ctipo == 'CajaFisica' ? 'Efectivo' : $p->ctipo }},({{ $p->nombrecartera }})
                                                                        </div>

                                                                        
                                                                        <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3"
                                                                            aria-hidden="true"></i>
                                                                        <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3"
                                                                            aria-hidden="true"></i>
                                                                    </button>
                                                                </h6>
                                                                <div id="collapseOne{{ $loop->iteration }}"
                                                                    class="accordion-collapse collapse"
                                                                    aria-labelledby="headingOne"
                                                                    data-bs-parent="#accordionRental" style="">
                                                                    <div class="accordion-body text-sm">


                                                                        <table class="table text-dark">
                                                                            <thead>
                                                                                <tr>
                                                                                    <td>
                                                                                        <p class="text-sm mb-0 text-center">
                                                                                            <b>Nombre</b>
                                                                                        </p>
                                                                                    </td>
                                                                                    <td>
                                                                                        <p class="text-sm mb-0">
                                                                                            <b>Precio Original</b>
                                                                                        </p>
                                                                                    </td>
                                                                                    <td>
                                                                                        <p class="text-sm mb-0">
                                                                                            <b>Desc/Rec</b>
                                                                                        </p>
                                                                                    </td>
                                                                                    <td>
                                                                                        <p class="text-sm mb-0">
                                                                                            <b>Precio V</b>
                                                                                        </p>
                                                                                    </td>
                                                                                    <td>
                                                                                        <p class="text-sm mb-0">
                                                                                            <b>Cantidad</b>
                                                                                        </p>
                                                                                    </td>
                                                                                    <td>
                                                                                        <p class="text-sm mb-0">
                                                                                            <b>Total</b>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($p->detalle as $item)
                                                                                    <tr>
                                                                                        <td>
                                                                                            {{ substr($item->nombre, 0, 17) }}
                                                                                        </td>
                                                                                        <td>
                                                                                            {{ number_format($item->po, 2) }}
                                                                                        </td>
                                                                                        <td>
                                                                                            @if ($item->po - $item->pv == 0)
                                                                                                {{ $item->po - $item->pv }}
                                                                                            @else
                                                                                                {{ ($item->po - $item->pv) * -1 }}
                                                                                            @endif
                                                                                        </td>
                                                                                        <td>
                                                                                            {{ number_format($item->pv, 2) }}
                                                                                        </td>
                                                                                        <td>
                                                                                            {{ $item->cant }}
                                                                                        </td>
                                                                                        <td class="text-right">
                                                                                            {{ number_format($item->pv * $item->cant, 2) }}
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
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-success text-sm">
                                            {{ number_format($p->importe, 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                            <span class="badge badge-sm bg-gradient-primary text-sm">
                                                {{ number_format($p->utilidadventa, 2) }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            {{-- @foreach ($totalesIngresosS as $p)
                                <tr>
                                    <td class="text-sm text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-sm text-center">
                                        {{ \Carbon\Carbon::parse($p->movcreacion)->format('d/m/Y H:i') }}
                                    </td>

                                    <td class="text-sm text-center">
                                        <b>{{ $p->idordenservicio }},{{ $p->tipoDeMovimiento }},
                                            {{ $p->nombrecategoria }}
                                            ,{{ $p->ctipo == 'CajaFisica' ? 'Efectivo' : $p->ctipo }},({{ $p->nombrecartera }})</b>
                                    </td>
                                    <td class="text-sm text-right">
                                        {{ number_format($p->importe, 2) }}
                                    </td>
                                    <td>

                                    </td>
                                    <td class="text-sm text-right">
                                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                        <span class="badge badge-sm bg-gradient-primary text-sm">
                                            {{ number_format($p->utilidadservicios, 2) }}
                                        </span>
                                        @endif
                                    </td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="text-sm text-center">
                                        {{ ucwords(strtolower($p->solucion)) }}
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach --}}
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    @endif

    

 

    

    @if($totalesEgresosV->count() > 0)
    <br>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-sm text-center">#</th>
                                <th class="text-uppercase text-sm">FECHA</th>
                                <th class="text-uppercase text-sm text-center">DETALLE</th>
                                <th class="text-uppercase text-sm">INGRESO</th>
                                <th class="text-uppercase text-sm">EGRESO</th>
                                <th class="text-uppercase text-sm">
                                    @if (Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                        UTILIDAD
                                    @endif
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($totalesEgresosV as $p)
                                <tr>
                                    <td class="text-sm">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-sm text-center">
                                        {{ \Carbon\Carbon::parse($p->movcreacion)->format('d/m/Y H:i') }}
                                    </td>

                                    <td class="text-sm text-center">
                                        <b>{{ $p->tipoDeMovimiento }},Devolución,{{ $p->ctipo == 'CajaFisica' ? 'Efectivo' : $p->ctipo }},{{ $p->nombrecartera }}</b>
                                    </td>
                                    <td>

                                    </td>
                                    <td class="text-sm text-right">
                                        <span class="badge badge-sm bg-gradient-success text-sm">
                                            {{ number_format($p->importe, 2) }}
                                        </span>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif


    @if($totalesIngresosIE->count() > 0)
        <br>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-sm text-center">#</th>
                                <th class="text-sm">FECHA</th>
                                <th class="text-sm" style="width: 510px;">DETALLE</th>
                                <th class="text-sm">INGRESO</th>
                                <th class="text-sm">
                                    @if (Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                        UTILIDAD
                                    @endif
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($totalesIngresosIE as $m)
                            <tr>
                                <td class="text-center text-sm">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-sm">
                                    {{ \Carbon\Carbon::parse($m->movcreacion)->format('d/m/Y H:i') }}
                                </td>

                                <td class="text-sm">
                                    <div style="width: 510px;">
                                        <b>{{ $m->ctipo == 'CajaFisica' ? 'Efectivo' : $m->ctipo }},({{ $m->nombrecartera }})</b>
                                    </div>
                                </td>
                                <td class="text-sm">
                                    <span class="badge badge-sm bg-gradient-success text-sm">
                                        {{ number_format($m->importe, 2) }}
                                    </span>
                                </td>
                                <td>

                                </td>

                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-sm">
                                    {{ $m->coment }}
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    

    @if($totalesEgresosIE->count() > 0)
    <br>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-sm text-center">#</th>
                                <th class="text-uppercase text-sm">FECHA</th>
                                <th class="text-uppercase text-sm">DETALLE</th>
                                <th class="text-uppercase text-sm">EGRESO</th>
                                <th class="text-uppercase text-sm">
                                    @if (Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                        UTILIDAD
                                    @endif
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($totalesEgresosIE as $st)
                                <tr>
                                    <td class="text-sm">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-sm">
                                        {{ \Carbon\Carbon::parse($st->movcreacion)->format('d/m/Y H:i') }}
                                    </td>

                                    <td class="text-sm">
                                        <b>{{ $st->ctipo == 'CajaFisica' ? 'Efectivo' : $st->ctipo }},({{ $st->nombrecartera }})</b>
                                    </td>
                                    <td class="text-sm text-right">
                                        <span class="badge badge-sm bg-gradient-danger text-sm">
                                            {{ number_format($st->importe, 2) }}
                                        </span>
                                    </td>
                                    <td>

                                    </td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="text-sm text-center">
                                        {{ $st->coment }}
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <br>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive p-0">
                <table style="width: 100%">
                    <tr>
                        <td colspan="6">
        
                        </td>
                    </tr>
                    {{-- SUBTOTAL OPERACIONES --}}
                    <tr>
                        <td colspan="3">
                            <h5 class="text-dark text-center" style="font-size: 1rem!important;">
                                <p class="text-sm mb-0">
                                    <b> Totales.- </b>
                                </p>
                            </h5>
                        </td>
                        <td class="text-right">
                            <p class="text-sm mb-0">
                                <b>{{ number_format($subtotalesIngresos, 2) }}</b>
                            </p>
                        </td>
                        <td class="text-right">
                            <p class="text-sm mb-0">
                                <b>{{ number_format($EgresosTotales, 2) }}</b>
                            </p>
                        </td>
                        <td class="text-right">
                            <p class="text-sm mb-0">
                                @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                    <b>{{ number_format($totalutilidadSV, 2) }}</b>
                                @endif
                            </p>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>





    @include('livewire.reportemovimientoresumen.modaltotales')
    @include('livewire.reportemovimientoresumen.modalDetailsr')

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('show-modalR', Msg => {
            $('#modal-detailsr').modal('show')
        })
        window.livewire.on('hide-modalR', Msg => {
            $('#modal-detailsr').modal('hide')
            noty(Msg)
        })
        window.livewire.on('tigo-delete', Msg => {
            noty(Msg)
        })

        window.livewire.on('show-modaltotales', Msg => {
            $('#modaltotales').modal('show')
        })

        //Llamando a una nueva pestaña donde estará el pdf modal
        window.livewire.on('opentap', Msg => {
            var win = window.open('report/pdfmovdiaresumen');
            // Cambiar el foco al nuevo tab (punto opcional)
            //win.focus();

        });
    });
</script>
