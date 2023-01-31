<div>
    <div class="d-lg-flex" style="margin-bottom: 2.3rem">
        <h5 class="text-white" style="font-size: 16px">Reporte de Sesion </h5>

    </div>
    <div class="row justify-content-end">

        <div class="col-12 col-sm-6 col-md-2">
            <div class="form-group">

                <button class="btn btn-warning form-control">
                    <i class="fas fa-print"></i> Generar PDF
                </button>
            </div>
        </div>

    </div>


    <div class="modal-body">
        <div class="card mt-4 pt-4">
            <h5 class="text-center">
                <b class="mt-2">Detalle Sesion Caja Registradora</b>
            </h5>
            @if($totalesIngresosV->count()>0)
            <br>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="tablareporte">
                            <thead>
                                <tr>
                                    <th class="text-sm text-center">#</th>
                                    <th class="text-sm">FECHA</th>
                                    <th class="text-sm text-left">DETALLE</th>
                                    <th class="text-sm ie">INGRESO</th>
                                    <th class="text-sm ie">
                                        @if (Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                            UTILIDAD
                                        @endif
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($totalesIngresosV as $p)
                                    <tr>
                                        <td class="text-sm text-center no">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-sm fecha">
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
                                    </tr>
                                @endforeach
                             
                                @endif
                                @if ($totalesEgresosIE->isNotEmpty())
                                @foreach ($totalesEgresosIE as $item)
                                    <tr>
                                        <td class="text-sm text-center no">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-sm fecha">
                                            {{ \Carbon\Carbon::parse($p->movcreacion)->format('d/m/Y H:i') }}
                                        </td>
                                        <td>
                                            {{ $item->tipoDeMovimiento }},{{ $item->ctipo == 'efectivo' ? 'Efectivo' : $item->ctipo }},({{ $item->nombrecartera }})
    
                                            </td>
                                    </tr>
                                @endforeach
                           
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    
            <div class="">
                <table class="table">
                    <tbody>

                        <tr style="height: 2rem"></tr>

                        <tr class="p-5">
                            <td class="text-sm">
                                Total Ingresos
                            </td>
                            <td class="text-sm" style="float: right">
                                Bs. {{$totalesIngresosV->where('ctipo','efectivo')->sum('importe')+$totalesIngresosIE->where('ctipo','efectivo')->sum('importe')}}
                            </td>

                        </tr>

                        <tr class="p-5">
                            <td class="text-sm">
                                Total Egresos
                            </td>
                            <td class="text-sm" style="float: right">
                               <u> Bs. {{ $totalesEgresosIE->sum('importe')??0}}</u> 
                            </td>

                        </tr>
                        <tr class="p-5">
                            <td class="text-sm">
                                Saldo Total
                            </td>
                            <td class="text-sm" style="float: right">
                                Bs. {{$totalesIngresosV->where('ctipo','efectivo')->sum('importe')+$totalesIngresosIE->where('ctipo','efectivo')->sum('importe') -$totalesEgresosIE->sum('importe')??0}}
                            </td>

                        </tr>
                        <tr class="p-5">
                            <td class="text-sm">
                               Apertura Caja
                            </td>
                            <td class="text-sm" style="float: right">
                                Bs. {{ $movimiento->import}}
                            </td>

                        </tr>
                     
                        <tr class="p-5">



                            <td class="text-sm">
                                Sobrantes
                            </td>
                            <td class="text-sm" style="float: right">
                                Bs. {{$sobrante }}
                            </td>


                        </tr>
                        <tr class="p-5">



                            <td class="text-sm">
                                Faltantes
                            </td>
                            <td class="text-sm" style="float: right">
                               <u> Bs. {{$faltante}}</u> 
                            </td>


                        </tr>
                        <tr class="p-5">
                            <td class="text-sm">
                                Saldo al cierre de caja
                            </td>
                            <td class="text-sm" style="float: right">
                                Bs. {{$cierremonto }}
                            </td>

                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

















    </div>








</div>
