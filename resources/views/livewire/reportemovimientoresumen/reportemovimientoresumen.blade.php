<div>
    <div class="row mt-n6 ml-5">
        <div class="col-12 text-white">
            <h5 class="text-center text-white">
                Movimientos Diarios
            </h5>
        </div>
    </div>

    <ul class="row justify-content-start">
        <div class="col-sm-12 col-md-2">

            @can('Reporte_Movimientos_General')
                <div class="form-group">
                    <b class="text-white">Sucursal</b>
                    <select wire:model="sucursal" class="form-select">
                        @foreach ($sucursales as $item)
                            <option wire:key="item-{{ $item->id }}" value="{{ $item->id }}">{{ $item->name }}
                            </option>
                        @endforeach
                        <option value="TODAS">TODAS</option>

                    </select>

                </div>
            @endcan

        </div>
        <div class="col-sm-12 col-md-2">
            <div class="form-group">
                <b class="text-white">Caja</b>
                <select wire:model="caja" class="form-select">
                    @foreach ($cajas as $item)
                        <option wire:key="item-{{ $item->id }}" value="{{ $item->id }}">{{ $item->nombre }}
                        </option>
                    @endforeach
                    <option value="TODAS">TODAS</option>

                </select>

            </div>
        </div>
        <div class="col-sm-12 col-md-2">
            <div class="form-group">

                <b class="text-white">Fecha inicial</b>

                <input type="date" wire:model="fromDate" class="form-control">
                @error('fromDate')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-12 col-md-2">
            <div class="form-group">
                <b class="text-white">Fecha Final</b>
                <input type="date" wire:model="toDate" class="form-control">
                @error('toDate')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
        </div>
        <div class="col-sm-12 col-md-2">
            <div class="form-group">
                <b style="color: #5e72e4;">|</b>
                <button wire:click="generarpdf({{ $totalesIngresosV }}, {{ $totalesIngresosS }}, {{ $totalesIngresosIE }}, {{ $totalesEgresosV }}, {{ $totalesEgresosIE }}, {{ $op_sob_falt }})"
                    class="btn btn-secondary form-control">
                    <i class="fas fa-print"></i> Generar PDF
                </button>
            </div>
        </div>


    </ul>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-sm text-center">#</th>
                            <th class="text-uppercase text-sm">FECHA</th>
                            <th class="text-uppercase text-sm">DETALLE</th>
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

                        @foreach ($totalesIngresosV as $p)
                            <tr>
                                <td class="text-sm text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-sm px-4">
                                    {{ \Carbon\Carbon::parse($p->movcreacion)->format('d/m/Y H:i') }}
                                </td>
                                <td class="text-sm px-4">
                                    <b>{{ $p->idventa }},{{ $p->tipoDeMovimiento }},{{ $p->ctipo == 'CajaFisica' ? 'Efectivo' : $p->ctipo }},({{ $p->nombrecartera }})</b>
                                </td>
                                <td class="text-sm px-4">
                                    {{ number_format($p->importe, 2) }}
                                </td>
                                <td>

                                </td>
                                <td class="text-sm px-4">
                                    @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                        {{ number_format($p->utilidadventa, 3) }}
                                    @endif
                                </td>


                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <table style="width: 100%">
                                        <thead class="cabeza">
                                            <tr class="text-center">
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
                                                        <b>Precio Venta</b>
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
                                                <tr class="fila">
                                                    <td>
                                                        {{-- {{rtrim(mb_strimwidth($item['nombre'], 2, 2, '...', 'UTF-8'))}} --}}
                                                        {{-- {{$item['nombre']}} --}}
                                                        {{ substr($item->nombre, 0, 17) }}
                                                    </td>
                                                    <td class="text-sm px-4">
                                                        {{ number_format($item->po, 2) }}
                                                    </td>
                                                    <td class="text-sm px-4">
                                                        @if ($item->po - $item->pv == 0)
                                                            {{ $item->po - $item->pv }}
                                                        @else
                                                            {{ ($item->po - $item->pv) * -1 }}
                                                        @endif
                                                    </td>
                                                    <td class="text-sm px-4">
                                                        {{ number_format($item->pv, 2) }}
                                                    </td>
                                                    <td class="text-sm px-4">
                                                        <p class="text-sm px-3">
                                                            {{ $item->cant }}
                                                        </p>
                                                    </td>
                                                    <td class="text-sm px-4">
                                                        {{ number_format($item->pv * $item->cant, 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                        @foreach ($totalesIngresosS as $p)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($p->movcreacion)->format('d/m/Y H:i') }}
                                </td>

                                <td class="text-center">
                                    <b>{{ $p->idordenservicio }},{{ $p->tipoDeMovimiento }},
                                        {{ $p->nombrecategoria }}
                                        ,{{ $p->ctipo == 'CajaFisica' ? 'Efectivo' : $p->ctipo }},({{ $p->nombrecartera }})</b>
                                </td>
                                <td class="text-right">
                                    {{ number_format($p->importe, 2) }}
                                </td>
                                <td>

                                </td>
                                <td class="text-right">
                                    @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                        {{ number_format($p->utilidadservicios, 2) }}
                                    @endif
                                </td>

                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-center">
                                    {{ ucwords(strtolower($p->solucion)) }}
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach

                        @foreach ($totalesIngresosIE as $m)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($m->movcreacion)->format('d/m/Y H:i') }}
                                </td>

                                <td class="text-center">
                                    <b>{{ $m->ctipo == 'CajaFisica' ? 'Efectivo' : $m->ctipo }},({{ $m->nombrecartera }})</b>

                                </td>
                                <td class="text-right">
                                    {{ number_format($m->importe, 2) }}
                                </td>
                                <td>

                                </td>
                                <td>

                                </td>

                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-center">
                                    {{ $m->coment }}
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach


                        @foreach ($totalesEgresosV as $p)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($p->movcreacion)->format('d/m/Y H:i') }}
                                </td>

                                <td class="text-center">
                                    <b>{{ $p->tipoDeMovimiento }},Devolución,{{ $p->ctipo == 'CajaFisica' ? 'Efectivo' : $p->ctipo }},{{ $p->nombrecartera }}</b>
                                </td>
                                <td>

                                </td>
                                <td class="text-right">
                                    {{ number_format($p->importe, 2) }}
                                </td>
                                <td>

                                </td>

                            </tr>
                        @endforeach

                        @foreach ($totalesEgresosIE as $st)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($st->movcreacion)->format('d/m/Y H:i') }}
                                </td>

                                <td class="text-center">
                                    <b>{{ $st->ctipo == 'CajaFisica' ? 'Efectivo' : $st->ctipo }},({{ $st->nombrecartera }})</b>
                                </td>
                                <td>

                                </td>
                                <td class="text-right">
                                    {{ number_format($st->importe, 2) }}
                                </td>
                                <td>

                                </td>

                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-center">
                                    {{ $st->coment }}
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach


                    <tfoot>
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
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="row justify-content-center mt-3">
        <div class="card col-md-5">

            <div class="table-responsive">
                <table class="table align-items-center mb-0 table-borderless">
                    <tbody>

                        <tr>
                            <td>
                                <h5 class="text-center">Ingresos en Efectivo</h5>
                            </td>
                            <td class="ml-2">
                                <h5 class="text-center">{{ number_format($ingresosTotalesCF, 2) }}</h5>
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <h5 class="text-dark text-center"> Ingresos por Bancos</h5>
                            </td>
                            <td class="ml-2">
                                <h5 class="text-dark text-center">
                                    {{ number_format($this->ingresosTotalesNoCFBancos, 2) }}
                                </h5>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 class="text-dark text-center m-0">Ingresos Totales</h5>
                            </td>
                            <td>
                                <hr class="m-0 p-0" width="100%" style="background-color: black">
                                <h5 class="text-dark text-center m-0">{{ number_format($subtotalesIngresos, 2) }}
                                </h5>
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <h5 class="text-dark text-center"> Egresos Totales en Efectivo</h5>
                            </td>
                            <td>
                                <h5 class="text-dark text-center m-0">{{ number_format($EgresosTotalesCF, 2) }} </h5>


                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 class="text-dark text-center"> Saldo Ingresos/Egresos Totales </h5>
                            </td>
                            <td>
                                <hr class="m-0 p-0" width="100%" style="background-color: black">
                                <h5 class="text-dark text-center m-0"> {{ number_format($subtotalcaja, 2) }}</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5 class="text-dark text-center"> Saldo en Efectivo Hoy</h5>
                            </td>
                            <td>
                                <h5 class="text-dark text-center m-0"> {{ number_format($operacionesefectivas, 2) }}
                                </h5>
                            </td>
                        </tr>
                        {{-- <tr>
                            <td>
                                <h5 class="text-dark text-center mr-1"><b> Saldo por Operaciones en TigoMoney </b></h5>
                            </td>
    
                            <td>
                                <h5 class="text-dark text-center mr-1">{{ number_format($total,2)}} </h5>
                            </td>
    
                        </tr> --}}
                        <tr>
                            <td>
                                <h5 class="text-dark text-center"> Saldo Acumulado Dia Ant. </h5>
                            </td>
                            <td>
                                <h5 class="text-dark text-center m-0">{{ number_format($ops, 2) }} </h5>
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <h5 class="text-dark text-center"> Total Efectivo </h5>
                            </td>
                            <td>
                                <hr class="m-0 p-0" width="100%" style="background-color: black">
                                <h5 class="text-dark text-center"> {{ number_format($operacionesW, 2) }}</h5>
                            </td>
                        </tr>


            </div>
            <div class="table-responsive">
                <h5 class="text-center mt-3" style="border-bottom: 1px">
                    <b>Cuadro Resumen de Efectivo</b>
                </h5>
                <table class="table align-items-center mb-0">
                    <tbody>
                        @if ($caja != 'TODAS')
                            <tr style="height: 2rem"></tr>

                            <tr class="p-5">
                                <td>
                                    <h5 class="text-dark text-center"> Recaudo </h5>
                                </td>
                                <td>
                                    <h5 class="text-dark text-center m-0"> {{ number_format($op_recaudo, 2) }}</h5>

                                </td>

                            </tr>
                            <tr class="p-5">


                                @foreach ($op_sob_falt as $values)
                                    <td>
                                        <h5 class="text-dark text-center"> {{ $values->tipo_sob_fal }} </h5>
                                    </td>
                                    <td>
                                        <h5 class="text-dark text-center m-0"> {{ number_format($values->import, 2) }}
                                        </h5>

                                    </td>
                                @endforeach

                            </tr>
                            <tr class="p-5">
                                <td>
                                    <h5 class="text-dark text-center"> Nuevo Saldo Caja Fisica </h5>
                                </td>
                                <td>
                                    <h5 class="text-dark text-center m-0"> {{ number_format($operacionesZ, 2) }}</h5>

                                </td>

                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>






    </div>

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
        //Llamando a una nueva pestaña donde estará el pdf modal
        window.livewire.on('opentap', Msg => {
            var win = window.open('report/pdfmovdiaresumen');
            // Cambiar el foco al nuevo tab (punto opcional)
            //win.focus();

        });
    });
</script>
