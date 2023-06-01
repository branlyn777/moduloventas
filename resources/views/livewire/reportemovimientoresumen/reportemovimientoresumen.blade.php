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
    <div wire:loading>
        <div class="modal-backdrop fade show"></div>
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Cargando...</span>
        </div>
    </div>
    <div>
        <div class="d-lg-flex my-auto p-0 mb-3" style="margin-bottom: 2.3rem">
            <h5 class="text-white" style="font-size: 16px">Movimientos Diarios </h5>
            <div class="ms-auto my-auto mt-lg-1">
                <div class="ms-auto my-auto">


                    <button
                        wire:click="generarpdf({{ $totalesIngresosV }},{{$totalServicios}} ,{{ $totalesIngresosIE }}, {{ $totalesEgresosIE }}, {{ $totalesEgresosV }})"
                        class="btn btn-light mb-0 pe-6 ps-6">
                        <i class="fas fa-print"></i> Generar PDF
                    </button>


                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="row">

                    <div class="col">

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
                    <div class="col">
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
                    <div class="col">
                        <div class="form-group">
                            <b class="">Fecha inicial</b>
                            <input type="date" wire:model="fromDate" class="form-control">
                            @error('fromDate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <b class="">Fecha Final</b>
                            <input type="date" wire:model="toDate" class="form-control">
                            @error('toDate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col d-flex justify-content-center align-items-center mt-2">
                        <button wire:click="$emit('show-modaltotales')" class="btn btn-success form-control">
                            <i class="fas fa-coins"></i> Resumen de Operaciones
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <br>
        <div wire:loading wire:target="archivo">
            <div class="d-flex align-items-center">
                <strong>Cargando Archivo, Espere por
                    favor...</strong>
                <div class="spinner-border ms-auto"></div>
            </div>
        </div>
        <div class="card">

            <div class="card-body">


                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table main">
                            <thead>
                                <tr>
                                    <th class="w-85 text-xs">Descripción</th>
                                    <th class="w-5 text-xs text-center">Importe <br>en Bs.</th>
                                    <th class="text-end text-xs">Exp.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr data-bs-toggle="collapse" data-bs-target="#ingresos-detalle-ventas"
                                    class="accordion-toggle">
                                    <td class="w-85">Ingresos por Ventas</td>
                                    <td class="w-5 text-center">
                                        {{ number_format($totalesIngresosV->sum('importe'), 2) }}
                                    </td>
                                    <td class="text-end"><button class="btn btn-primary"><i
                                                class="fa fa-chevron-down"></i></button></td>
                                </tr>
                                <tr class="nohover">
                                    <td colspan="3" class="hiddenRow">
                                        <div class="accordian-body collapse" id="ingresos-detalle-ventas">
                                            <label>Detalle de ingresos</label>
                                            <div class="container">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-sm text-center">N°</th>
                                                                <th class="text-xs">Fecha</th>
                                                                <th class="text-xs text-left">Detalle</th>
                                                                <th class="text-xs ie">
                                                                    @if (Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                                                        Utilidad
                                                                    @endif
                                                                </th>
                                                                <th class="text-xs ie">Importe</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($totalesIngresosV as $p)
                                                                <tr>
                                                                    <td class="text-sm text-center no">
                                                                        {{ $loop->iteration }}
                                                                    </td>
                                                                    <td class="text-sm">
                                                                        {{ \Carbon\Carbon::parse($p->movcreacion)->format('d/m/Y') }}
                                                                        <br>
                                                                        {{ \Carbon\Carbon::parse($p->movcreacion)->format('H:i') }}
                                                                    </td>
                                                                    <td>
                                                                        <div class="accordion-1">
                                                                            <div class="">
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mx-auto">
                                                                                        <div class="accordion"
                                                                                            id="accordionRental">

                                                                                            <div
                                                                                                class="accordion-item mb-3">
                                                                                                <h6 class="accordion-header"
                                                                                                    id="headingOne">
                                                                                                    <button
                                                                                                        class="accordion-button border-bottom font-weight-bold collapsed"
                                                                                                        type="button"
                                                                                                        data-bs-toggle="collapse"
                                                                                                        data-bs-target="#collapseOne{{ $loop->iteration }}"
                                                                                                        aria-expanded="false"
                                                                                                        aria-controls="collapseOne{{ $loop->iteration }}">

                                                                                                        <div
                                                                                                            class="text-sm">
                                                                                                            COD.{{ $p->idventa }},{{ $p->ctipo == 'efectivo' ? 'Cobro realizado en efectivo' : 'Cobro realizado por transaccion de ' . $p->nombrecartera }}
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
                                                                                                    data-bs-parent="#accordionRental"
                                                                                                    style="">
                                                                                                    <div
                                                                                                        class="accordion-body text-sm">


                                                                                                        <table
                                                                                                            class="table text-dark">
                                                                                                            <thead>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                        <p
                                                                                                                            class="text-sm mb-0 text-center">
                                                                                                                            <b>Nombre</b>
                                                                                                                        </p>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <p
                                                                                                                            class="text-sm mb-0">
                                                                                                                            <b>Precio
                                                                                                                                Original</b>
                                                                                                                        </p>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <p
                                                                                                                            class="text-sm mb-0">
                                                                                                                            <b>Desc/Rec</b>
                                                                                                                        </p>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <p
                                                                                                                            class="text-sm mb-0">
                                                                                                                            <b>Precio
                                                                                                                                V</b>
                                                                                                                        </p>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <p
                                                                                                                            class="text-sm mb-0">
                                                                                                                            <b>Cantidad</b>
                                                                                                                        </p>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <p
                                                                                                                            class="text-sm mb-0">
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
                                                                                                                        <td
                                                                                                                            class="text-right">
                                                                                                                            {{ number_format($item->pv * $item->cant, 2) }}
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                    @if($item->devolution != "0")
                                                                                                                    <tr>
                                                                                                                        <td colspan="6" class="text-center">
                                                                                                                            <span class="text-sm text-danger">
                                                                                                                                {{ $item->devolution }}
                                                                                                                            </span>
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
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                                                            <span
                                                                                class="badge badge-sm bg-success text-sm">
                                                                                {{ number_format($p->utilidadventa, 2) }}
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <span
                                                                            class="badge badge-sm bg-primary text-sm">
                                                                            {{ number_format($p->importe, 2) }}
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                <tr data-bs-toggle="collapse" data-bs-target="#ingresos-detalle-servicios"
                                    class="accordion-toggle">
                                    <td class="w-85">Ingresos por Servicios</td>
                                    <td class="w-5 text-center">
                                        {{ number_format($totalServicios->sum('importe'), 2) }}
                                    </td>
                                    <td class="text-end"><button class="btn btn-primary"><i
                                                class="fa fa-chevron-down"></i></button></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="hiddenRow">
                                        <div class="accordian-body collapse" id="ingresos-detalle-servicios">
                                            <label>Detalle de ingresos por Servicios</label>
                                            <div class="container">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-sm text-center">N°</th>
                                                                <th class="text-xs">Fecha</th>
                                                                <th class="text-xs text-left">Detalle</th>
                                                                <th class="text-xs ie">Importe</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($totalServicios as $p)
                                                                <tr>
                                                                    <td class="text-sm text-center no">
                                                                        {{ $loop->iteration }}
                                                                    </td>
                                                                    <td class="text-sm">
                                                                        {{ \Carbon\Carbon::parse($p->movcreacion)->format('h:i:s') }}
                                                                        <br>
                                                                        {{ \Carbon\Carbon::parse($p->movcreacion)->format('d/m/y') }}
                                                                    </td>
                                                                    <td class="text-sm">

                                                                        {{ 'Orden N° ' . $p->order_id . ',Servicio de ' . $p->servicio_solucion }}{{ $p->ctipo == 'efectivo' ? '(Pago en efectivo)' : '(Pago por transaccion de ' . $p->cnombre . ')' }}
                                                                    </td>
                                                                    <td>
                                                                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                                                            <span
                                                                                class="badge badge-sm bg-success text-sm">
                                                                                {{ number_format($p->utilidadventa, 2) }}
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <span
                                                                            class="badge badge-sm bg-primary text-sm">
                                                                            {{ number_format($p->importe, 2) }}
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr data-bs-toggle="collapse" data-bs-target="#otros-ingresos"
                                    class="accordion-toggle">
                                    <td class="w-85">Otros Ingresos</td>
                                    <td class="w-5 text-center">
                                        {{ number_format($totalesIngresosIE->sum('importe'), 2) }}
                                    </td>
                                    <td class="text-end"><button class="btn btn-primary"><i
                                                class="fa fa-chevron-down"></i></button></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="hiddenRow">
                                        <div class="accordian-body collapse" id="otros-ingresos">

                                            <div class="container">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-sm text-center">N°</th>
                                                                <th class="text-xs">Fecha</th>
                                                                <th class="text-xs text-left">Detalle</th>
                                                                {{-- <th class="text-xs ie">
                                                                    @if (Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                                                        Utilidad
                                                                    @endif
                                                                </th> --}}
                                                                <th class="text-xs ie">Importe</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($totalesIngresosIE as $p)
                                                                <tr>
                                                                    <td class="text-sm text-center no">
                                                                        {{ $loop->iteration }}
                                                                    </td>
                                                                    <td class="text-sm">
                                                                        {{ \Carbon\Carbon::parse($p->movcreacion)->format('h:i:s') }}
                                                                        <br>
                                                                        {{ \Carbon\Carbon::parse($p->movcreacion)->format('d/m/y') }}
                                                                    </td>
                                                                    <td class="text-sm">

                                                                        {{ $p->carteramovtype . ',' . $p->coment }}
                                                                    </td>

                                                                    <td>
                                                                        <span
                                                                            class="badge badge-sm bg-primary text-sm">
                                                                            {{ number_format($p->importe, 2) }}
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr data-bs-toggle="collapse" data-bs-target="#egresos-detalle"
                                    class="accordion-toggle">
                                    <td class="w-85">Egresos</td>
                                    <td class="w-5 text-center">
                                        {{ number_format($totalesEgresosIE->sum('importe'), 2) }}
                                    </td>
                                    <td class="text-end"><button class="btn btn-primary"><i
                                                class="fa fa-chevron-down"></i></button></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="hiddenRow">
                                        <div class="accordian-body collapse" id="egresos-detalle">
                                            <div class="container">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-sm text-center">N°</th>
                                                                <th class="text-xs">Fecha</th>
                                                                <th class="text-xs text-left">Detalle</th>
                                                                {{-- <th class="text-xs ie">
                                                    @if (Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                                        Utilidad
                                                    @endif
                                                </th> --}}
                                                                <th class="text-xs ie">Importe</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($totalesEgresosIE as $p)
                                                                <tr>
                                                                    <td class="text-sm text-center no">
                                                                        {{ $loop->iteration }}
                                                                    </td>
                                                                    <td class="text-sm">
                                                                        {{ \Carbon\Carbon::parse($p->movcreacion)->format('h:i:s') }}
                                                                        <br>
                                                                        {{ \Carbon\Carbon::parse($p->movcreacion)->format('d/m/y') }}
                                                                    </td>
                                                                    <td class="text-sm">

                                                                        {{ $p->carteramovtype . ',' . $p->coment }}
                                                                    </td>

                                                                    <td>
                                                                        <span
                                                                            class="badge badge-sm bg-primary text-sm">
                                                                            {{ number_format($p->importe, 2) }}
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>


    </div>
    @include('livewire.reportemovimientoresumen.modaltotales')


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
