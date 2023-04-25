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
                <div class="card-body p-6">
                    <label class="text-lg">Saldo inicial de caja : </label> <span> <b>451212.00</span>
                    <br>
                    @if ($totalesIngresosV->count() > 0)
                    <label class="text-lg">Ventas Realizadas durante la Sesion:</label>

                        <div class="table-responsive">

                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th class="col-1">#</th>
                                        <th class="col-1">Fecha</th>
                                        <th class="col-7">Detalle</th>
                                        <th class="col-2">Bs</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($totalesIngresosV as $p)
                                        <tr>
                                            <th class="align-middle">{{ $loop->iteration }}</th>
                                            <td class="text-sm align-middle">
                                                {{ \Carbon\Carbon::parse($p->movcreacion)->format('d/m/Y H:i') }}</td>
                                            <td scope="row">
                                                <div class="accordion-1">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="accordion" id="accordionRental">

                                                                <div class="accordion-item mb-0">
                                                                    <h6 class="accordion-header" id="headingOne">
                                                                        <button
                                                                            class="accordion-button font-weight-bold collapsed"
                                                                            type="button" data-bs-toggle="collapse"
                                                                            data-bs-target="#collapseOne{{ $loop->iteration }}"
                                                                            aria-expanded="false"
                                                                            aria-controls="collapseOne{{ $loop->iteration }}">

                                                                            <h6 class="text-sm mx-0 py-0 my-0">
                                                                                {{ $p->tipoDeMovimiento }} cod.
                                                                                {{ $p->idventa }},cobro realizado en
                                                                                {{ $p->ctipo == 'CajaFisica' ? 'Efectivo' : $p->ctipo }}
                                                                            </h6>

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
                    <label class="text-lg">Ventas realizadas durante la Sesion: </label> <span>  (Sin registros) </span>
                    <br>
                    @endif
                    <label class="text-lg">Total Ventas : </label> <span> <b>154541.00</span>
                    <br>
                    @if ($totalesServicios->count() > 0)
                    <label class="text-lg">Servicios cobrados durante la Sesion:</label>

                        <div class="table-responsive">

                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th class="col-1">#</th>
                                        <th class="col-1">Fecha</th>
                                        <th class="col-7">Detalle</th>
                                        <th class="col-2">Bs</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($totalesServicios as $p)
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
                                                <span class="badge badge-sm bg-primary text-sm">
                                                    {{ number_format($p->importe, 2) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>



                        </div>
           
                        
                    @else
                    <label class="text-lg">Servicios cobrados durante la Sesion: </label> <span>  (Sin registros) </span>
                    <br>
                    @endif
                    <label class="text-lg">Total Cobro de Servicios : </label> <span> <b>154541.00</span>
                    <br>

                    @if ($totalesIngresosIE->count() > 0)
                    <label class="text-lg">Otros Ingresos cobrados durante la Sesion:</label>

                        <div class="table-responsive">

                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th class="col-1">#</th>
                                        <th class="col-1">Fecha</th>
                                        <th class="col-7">Detalle</th>
                                        <th class="col-2">Bs</th>
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

                                            Ingreso {{ $p->ctipo == 'efectivo' ? ' en efectivo' : 'por transaccion de ' . $p->cnombre . ')' }}
                                            </td>

                                            <td>
                                                <span class="badge badge-sm bg-primary text-sm">
                                                    {{ number_format($p->importe, 2) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>



                        </div>
           
                        
                    @else
                    <label class="text-lg">Ingresos cobrados durante la Sesion: </label> <span>  (Sin registros) </span>
                    <br>
                    @endif
                    <label class="text-lg">Total Otros Ingresos : </label> <span> <b>154541.00</span>
                        <br>
                        @if ($totalesEgresosIE->count() > 0)
                        <label class="text-lg">Egresos cobrados durante la Sesion:</label>

                        <div class="table-responsive">

                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th class="col-1">#</th>
                                        <th class="col-1">Fecha</th>
                                        <th class="col-7">Detalle</th>
                                        <th class="col-2">Bs</th>
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

                                            Ingreso {{ $p->ctipo == 'efectivo' ? ' en efectivo' : 'por transaccion de ' . $p->cnombre . ')' }}
                                            </td>

                                            <td>
                                                <span class="badge badge-sm bg-primary text-sm">
                                                    {{ number_format($p->importe, 2) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>



                        </div>
           
                        
                    @else
                    <label class="text-lg">Egresos cobrados durante la Sesion: </label> <span>  (Sin registros) </span>
                    <br>
                    @endif
                    <label class="text-lg">Total Egresos : </label> <span> <b>154541.00</span>
                    <br>
                    <label class="text-lg">Operaciones Tigo : </label> <span> <b>{{$operacionestigo}}</span>

                    <br>
                    <label class="text-lg">Diferencias de Caja : </label> <span> <b>{{$operacionestigo}}</span>

                    <br>

                    <label class="text-lg">Saldo final de Caja : </label> <span> <b></span>

                 <div class="border border-rounded p-2">
                    <h6 for="">Observaciones:</h6>
                    
                    <span>asfdjasdjfklajsdkfaksdfkadslfklja</span>
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
