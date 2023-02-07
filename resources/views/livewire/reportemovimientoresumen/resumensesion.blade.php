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
        <h6 class="font-weight-bolder mb-0 text-white"> Reporte Sesion Caja</h6>
    </nav>
@endsection


@section('Reportescollapse')
    nav-link
@endsection


@section('Reportesarrow')
    true
@endsection


@section('sesionesnav')
    "nav-link active"
@endsection


@section('Reportesshow')
    "collapse show"
@endsection

@section('sesionesli')
    "nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12">
            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 16px"><b>Reporte de Sesion</b></h5>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">
                    <div class="ms-auto my-auto">
                        <a href="javascript:void(0)" class="btn btn-success mb-0"
                            wire:click.prevent="generarpdf({{ $totalesIngresosV }},{{ $totalesIngresosIE }},{{ $totalesEgresosIE }})">
                            <i class="fas fa-print"></i> Generar PDF
                        </a>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body p-4">
                    <label style="font-size: 1rem;">Ventas</label>
                    @if ($totalesIngresosV->count() > 0)
                        <div class="table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-sm text-center">N°</th>
                                        <th class="text-uppercase text-sm ps-2 text-left">FECHA</th>
                                        <th class="text-uppercase text-sm ps-2 text-left">DETALLE</th>
                                        <th class="text-uppercase text-sm ps-3 text-left">INGRESO</th>
                                        <th class="text-uppercase text-sm ps-1 text-left">
                                            @if (Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                                UTILIDAD
                                            @endif
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($totalesIngresosV as $p)
                                        <tr class="text-left">
                                            <td class="text-sm mb-0 text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0 text-left">
                                                    {{ \Carbon\Carbon::parse($p->movcreacion)->format('d/m/Y H:i') }}
                                                </p>
                                            </td>
                                            <td>
                                                <div class="accordion-1">
                                                    <div class="">
                                                        <div class="row">
                                                            <div class="col-md-12 mx-auto">
                                                                <div class="accordion" id="accordionRental">

                                                                    <div class="accordion-item mb-3">
                                                                        <h6 class="accordion-header" id="headingOne">
                                                                            <button
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
                                                                            data-bs-parent="#accordionRental"
                                                                            style="">
                                                                            <div class="accordion-body text-sm">
                                                                                <table class="table text-dark">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <p class="text-sm mb-0">
                                                                                                    <b>Nombre</b>
                                                                                                </p>
                                                                                            </td>
                                                                                            <td>
                                                                                                <p class="text-sm mb-0">
                                                                                                    <b>Precio
                                                                                                        Original</b>
                                                                                                </p>
                                                                                            </td>
                                                                                            <td>
                                                                                                <p class="text-sm mb-0">
                                                                                                    <b>Desc/Rec</b>
                                                                                                </p>
                                                                                            </td>
                                                                                            <td>
                                                                                                <p class="text-sm mb-0">
                                                                                                    <b>Precio
                                                                                                        V</b>
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
                                            <td class="ie">
                                                <span class="badge badge-sm bg-primary text-sm">
                                                    {{ number_format($p->importe, 2) }}
                                                </span>
                                            </td>
                                            <td class="ie">
                                                @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                                    <span class="badge badge-sm bg-success text-sm">
                                                        {{ number_format($p->utilidadventa, 2) }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="m-4 text-center mt-4">(Sin registros de Ventas)</p>
                    @endif
                </div>
            </div>

            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <label style="font-size: 1rem;">Ingresos</label>
                    @if ($totalesIngresosIE->isNotEmpty())
                        @foreach ($totalesIngresosIE as $item)
                            <tr>
                                <td class="text-sm text-center no">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-sm fecha">
                                    {{ \Carbon\Carbon::parse($item->movcreacion)->format('d/m/Y H:i') }}
                                </td>
                                <td>
                                    {{ $item->tipoDeMovimiento }},{{ $item->ctipo == 'efectivo' ? 'Efectivo' : $item->ctipo }},({{ $item->nombrecartera }})

                                </td>

                                <td class="ie">
                                    <span class="badge badge-sm bg-primary text-sm">
                                        {{ number_format($item->importe, 2) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <p class="m-4 text-center">(Sin registros de Ingresos)</p>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <label style="font-size: 1rem;">Egresos</label>
                    @if ($totalesEgresosIE->isNotEmpty())
                        @foreach ($totalesEgresosIE as $item)
                            <tr>
                                <td class="text-sm text-center no">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-sm fecha">
                                    {{ \Carbon\Carbon::parse($item->movcreacion)->format('d/m/Y H:i') }}
                                </td>
                                <td>
                                    {{ $item->tipoDeMovimiento }},{{ $item->ctipo == 'efectivo' ? 'Efectivo' : $item->ctipo }},({{ $item->nombrecartera }})

                                </td>
                                <td class="ie">
                                    <span class="badge badge-sm bg-danger text-sm">
                                        {{ number_format($item->importe, 2) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <p class="m-4 text-center">(Sin registros de Egresos)</p>
                    @endif
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card p-1 bg-white">
                        <table class="table align">
                            <tbody>

                                <tr style="height: 2rem"></tr>

                                <tr class="p-5">
                                    <td class="text-sm text-center">
                                        Total Ingresos
                                    </td>
                                    <td class="text-sm-4 text-end pe-8" style="float: center">
                                        {{ number_format($totalesIngresosV->where('ctipo', 'efectivo')->sum('importe') + $totalesIngresosIE->where('ctipo', 'efectivo')->sum('importe'), 2) }}
                                    </td>
                                </tr>

                                <tr class="p-5">
                                    <td class="text-sm text-center">
                                        Total Egresos
                                    </td>
                                    <td class="text-sm text-end pe-8" style="float: center">
                                        {{ number_format($totalesEgresosIE->sum('importe') ?? 0, 2) }}
                                    </td>
                                </tr>
                                
                                <tr class="p-5">
                                    <td class="text-sm text-center">
                                        Saldo
                                    </td>
                                    <td class="text-sm text-end pe-8" style="float: center">
                                        {{ number_format($totalesIngresosV->where('ctipo', 'efectivo')->sum('importe') + $totalesIngresosIE->where('ctipo', 'efectivo')->sum('importe') - $totalesEgresosIE->sum('importe') ?? 0, 2) }}
                                    </td>
                                </tr>

                                <tr class="p-5">
                                    <td class="text-sm text-center">
                                        Apertura Caja
                                    </td>
                                    <td class="text-sm text-end pe-8" style="float: center">
                                        {{ number_format($movimiento->import, 2) }}
                                    </td>
                                </tr>

                                <tr class="p-5">
                                    <td class="text-sm text-center">
                                        Sobrantes
                                    </td>
                                    <td class="text-sm text-end pe-8" style="float: center">
                                        {{ number_format($sobrante, 2) }}
                                    </td>
                                </tr>

                                <tr class="p-5">
                                    <td class="text-sm text-center">
                                        Faltantes
                                    </td>
                                    <td class="text-sm text-end pe-8" style="float: center">
                                        {{ number_format($faltante, 2) }}
                                    </td>
                                </tr>

                                <tr class="p-5">
                                    <td class="text-sm text-center">
                                        Saldo al cierre de caja
                                    </td>
                                    <td class="text-sm text-end pe-8" style="float: center">
                                        Bs. {{ $cierremonto }}
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        //Llamando a una nueva pestaña donde estará el pdf modal
        window.livewire.on('opentap', Msg => {
            var win = window.open('report/pdfmovdiasesion');
            // Cambiar el foco al nuevo tab (punto opcional)
            //win.focus();
        });
    });
</script>
