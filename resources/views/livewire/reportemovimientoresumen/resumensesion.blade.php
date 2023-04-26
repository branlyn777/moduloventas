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

            <div class="card mb-4 px-8">
                <div class="card-header">
                    <h5 class="mb-3 text-dark text-center mt-4" style="font-size: 20px"><b>INFORME DE SESION DE CAJA
                           </h5>

                </div>

               <h6>Fecha de Apertura:</h6>
               <h6>Fecha de Cierre:</h6>
               <h6>Responsable en Turno:</h6>
                <div class="card-body px-6 pt-5  border rounded-3 mb-6">
                    <div class="d-flex bd-highlight mb-3">
                        <div class="me-auto p-2 bd-highlight"><h6 class="text-lg">Saldo inicial de caja : </h6>
                        </div>

                        <div class="p-2 bd-highlight"><span> <b>{{ $movimiento->import }}</span></div>
                    </div>

                    @if ($totalesIngresosV->count() > 0)
                        <div class="d-flex bd-highlight mb-1">
                            <div class="me-auto p-2 bd-highlight"><h6 class="text-lg">Ventas Realizadas durante la
                                    Sesion: </h6>
                            </div>

                            <div class="p-2 bd-highlight"><span>
                                    <b>{{ number_format($totalesIngresosV->sum('importe'), 2) }}</span></div>
                        </div>

                      

                            <div class="table-responsive px-7">
    
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="col-1 text-sm">#</th>
                                            <th class="col-1 text-sm">Fecha</th>
                                            <th class="col-7 text-sm">Detalle</th>
                                            <th class="col-2 text-sm">Monto (Bs.)</th>
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
                                                <td scope="row" class="text-left align-middle">
                                                    {{ number_format($p->importe, 2) }}</td>
                                            </tr>
                                        @endforeach
    
                                    </tbody>
    
                                </table>
    
    
    
                            </div>
                    

                    @else
                        <div class="d-flex bd-highlight mb-3">
                            <div class="me-auto p-2 bd-highlight"><h6 class="text-lg">Ventas Realizadas durante la
                                    Sesion: </h6>
                            </div>

                            <div class="p-2 bd-highlight"><span> <b>0</span></div>
                        </div>
                    @endif

                    <div class="d-flex bd-highlight mb-3">
                        <div class="me-auto p-2 bd-highlight"><h6 class="text-lg">Servicios Cobrados durante la Sesion: </h6>
                        </div>

                        <div class="p-2 bd-highlight"><span>
                                <b>{{ number_format($totalesServicios->sum('importe'), 2) }}</span></div>
                    </div>
                    @if ($totalesServicios->count() > 0)

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

                    @endif


                    <div class="d-flex bd-highlight mb-3">
                        <div class="me-auto p-2 bd-highlight"><h6 class="text-lg">Otros Ingresos Cobrados durante la
                                Sesion: </h6>
                        </div>

                        <div class="p-2 bd-highlight"><span>
                                <b>{{ number_format($totalesIngresosIE->sum('importe'), 2) }}</span></div>
                    </div>
                    @if ($totalesIngresosIE->count() > 0)

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

                                                Ingreso
                                                {{ $p->ctipo == 'efectivo' ? ' en efectivo' : 'por transaccion de ' . $p->cnombre . ')' }}
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

                    @endif

                    <div class="d-flex bd-highlight mb-3">
                        <div class="me-auto p-2 bd-highlight"><h6 class="text-lg">Egresos Cobrados durante la
                                Sesion: </h6>
                        </div>

                        <div class="p-2 bd-highlight"><span>
                                <b>{{ number_format($totalesEgresosIE->sum('importe'), 2) }}</span></div>
                    </div>
                    @if ($totalesEgresosIE->count() > 0)

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

                                                Ingreso
                                                {{ $p->ctipo == 'efectivo' ? ' en efectivo' : 'por transaccion de ' . $p->cnombre . ')' }}
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

                    @endif

                    <div class="d-flex bd-highlight mb-3">
                        <div class="me-auto p-2 bd-highlight"><h6 class="text-lg">Operaciones Tigo : </h6>
                        </div>

                        <div class="p-2 bd-highlight"><span> <b>{{ number_format($operacionestigo, 2) }}</span></div>
                    </div>
                
                    <div class="d-flex bd-highlight mb-3">
                        <div class="me-auto p-2 bd-highlight"><h6 class="text-lg">Sobrante: </h6>
                        </div>

                        <div class="p-2 bd-highlight"><span> <b>{{ number_format($sobrante, 2) }}</span>
                        </div>
                    </div>
                    <div class="d-flex bd-highlight mb-3">
                        <div class="me-auto p-2 bd-highlight"><h6 class="text-lg">Faltante: </h6>
                        </div>

                        <div class="p-2 bd-highlight"><span> <b>{{ number_format($faltante, 2) }}</span>
                        </div>
                    </div>
              

               

                    <div class="d-flex bd-highlight mb-3">
                        <div class="me-auto p-2 bd-highlight"><h6 class="text-lg">Saldo Final de efectivo :
                            </h6>
                        </div>

                        <div class="p-2 bd-highlight"><span> <b>{{ number_format($totalsesion, 2) }}</span></div>
                    </div>

                    <div class="border rounded-3 p-3">
                        <h6 for="">Observaciones de la sesion:</h6>

                        <span>{{$cartera_mov->comentario}}</span>
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
