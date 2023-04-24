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
                <div class="card-header">
                    <h5 class="mb-3 text-dark text-center mt-2" style="font-size: 20px"><b>Informe de sesión de caja
                            <br> (12/04/2022-15/04/2023)</b></h5>

                </div>
                <div class="card-body p-4">
                    <label class="text-lg">Saldo inicial de caja : </label> <span> <b>451212.00</span>
                    <br>
                    <u><label class="text-lg">Ventas Realizadas durante la Sesion:</label></u>
                    @if ($totalesIngresosV->count() > 0)

                        <div class="table-responsive">

                            <table class="table table-bordered border-primary">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Detalle</th>
                                        <th scope="col">Bs</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($totalesIngresosV as $p)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td scope="row">{{ \Carbon\Carbon::parse($p->movcreacion)->format('d/m/Y H:i') }}</td>
                                            <td scope="row">
                                                <div class="accordion-1">
                                             
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
                                            </td>
                                            <td scope="row">{{ number_format($p->importe, 2) }}</td>
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
