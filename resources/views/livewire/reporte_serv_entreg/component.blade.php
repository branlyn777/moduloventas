<div>
    <div class="row">
        <div class="col-12">
            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class=" text-white" style="font-size: 16px">{{ $componentName }}</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        {{-- <a class="btn btn-warning btn-block {{ count($data) < 1 ? 'disabled' : '' }}"
                            href="{{ url('reporteServicEntreg/pdf' . '/' . $reportType . '/' . $dateFrom . '/' . $dateTo . '/' . $sucursal . '/' . $sumaEfectivo . '/' . $sumaBanco . '/' . $caja) }}"
                            target="_blank" style='font-size:18px'>Generar PDF</a> --}}

                        <a class="btn btn-success mb-0 text-white" type="button"
                            href="{{ url('reporteServicEntreg/pdf' . '/' . $reportType . '/' . $dateFrom . '/' . $dateTo . '/' . $sucursal . '/' . $sumaEfectivo . '/' . $sumaBanco . '/' . $caja) }}">Generar
                            PDF</a>

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @if (@Auth::user()->hasPermissionTo('Filtrar_sucursal_Reporte_Servicio'))
                            <div class="col-12 col-sm-6 col-md-2">
                                <h6>Elige la sucursal</h6>
                                <div class="form-group">
                                    <select wire:model="sucursal" class="form-control" style="font-size: 90%">
                                        <option value="0">Todos</option>
                                        @foreach ($sucursales as $suc)
                                            <option value="{{ $suc->id }}">{{ $suc->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <div class="col-12 col-sm-6 col-md-2">
                            <h6>Elige la caja</h6>
                            <div class="form-group">
                                <select wire:model="caja" class="form-control" style="font-size: 90%">
                                    <option value="Todos">Todos</option>
                                    @foreach ($cajas as $cajSu)
                                        <option value="{{ $cajSu->id }}">{{ $cajSu->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-2">
                            <h6>Elige el tipo de reporte</h6>
                            <div class="form-group">
                                <select wire:model="reportType" class="form-control">
                                    <option value="0">Servicios del día</option>
                                    <option value="1">Servicios por fecha</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-2">
                            <h6>Fecha desde</h6>
                            <div class="form-group">
                                <input @if ($reportType == 0) disabled @endif type="date"
                                    wire:model="dateFrom" class="form-control" placeholder="Click para elegir">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-2">
                            <h6>Fecha hasta</h6>
                            <div class="form-group">
                                <input @if ($reportType == 0) disabled @endif type="date"
                                    wire:model="dateTo" class="form-control" placeholder="Click para elegir">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="table-th text-withe text-center">#</th>
                                    <th class="table-th text-withe text-center">FECHA</th>
                                    <th class="table-th text-withe text-center">CLIENTE</th>
                                    <th class="table-th text-withe text-center">ORDEN</th>
                                    <th class="table-th text-withe text-center">DETALLE</th>
                                    @if (@Auth::user()->hasPermissionTo('Ver_Costo_Reportes_Entregados'))
                                        <th class="table-th text-withe text-center">UTILIDAD</th>
                                    @endif
                                    <th class="table-th text-withe text-center">IMPORTE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($data) < 1)
                                    <tr>
                                        <td colspan="9">
                                            <h5 class="text-center">Sin Resultados</h5>
                                        </td>
                                    </tr>
                                @endif

                                @foreach ($data as $d)
                                    <tr class="tablaserviciostr">
                                        {{-- # --}}
                                        <td width="2%">
                                            <h6 class="table-th text-withe text-center"
                                                style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                {{ $loop->iteration }}</h6>
                                        </td>
                                        {{-- FECHA --}}
                                        @foreach ($d->movservices as $movser)
                                            @if ($movser->movs->type == 'ENTREGADO' && $movser->movs->status == 'ACTIVO')
                                                <td class="text-center">
                                                    <h6
                                                        style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                        {{ \Carbon\Carbon::parse($movser->movs->created_at)->format('d/m/Y H:i') }}
                                                    </h6>
                                                </td>
                                            @endif
                                        @endforeach
                                        {{-- CLIENTE --}}
                                        <td class="text-center">
                                            <h6
                                                style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                {{ $d->movservices[0]->movs->climov->client->nombre }}</h6>
                                        </td>
                                        {{-- NÚMERO DE ORDEN --}}
                                        <td class="text-center">
                                            <h6
                                                style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                {{ $d->order_service_id }}</h6>
                                        </td>

                                        {{-- DETALLE --}}
                                        <td class="text-center">
                                            <h6
                                                style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                {{ $d->categoria->nombre }} {{ $d->marca }}
                                                {{ $d->detalle }}</h6>
                                        </td>
                                        {{-- COSTO --}}
                                        @if (@Auth::user()->hasPermissionTo('Ver_Costo_Reportes_Entregados'))
                                            <td class="text-center">
                                                <h6
                                                    style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                    {{ number_format($d->utilidad, 2) }}</h6>
                                            </td>
                                        @endif
                                        {{-- IMPORTE --}}
                                        <td class="text-center">
                                            @if ($d->movservices[0]->movs->status == 'ACTIVO')
                                                <h6
                                                    style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                    {{ number_format($d->movservices[0]->movs->import, 2) }}
                                                </h6>
                                            @else
                                                @if ($d->movservices[1]->movs->status == 'ACTIVO')
                                                    <h6
                                                        style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                        {{ number_format($d->movservices[1]->movs->import, 2) }}
                                                    </h6>
                                                @else
                                                    @if ($d->movservices[2]->movs->status == 'ACTIVO')
                                                        <h6
                                                            style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                            {{ number_format($d->movservices[2]->movs->import, 2) }}
                                                        </h6>
                                                    @else
                                                        @if ($d->movservices[3]->movs->status == 'ACTIVO')
                                                            <h6
                                                                style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                                {{ number_format($d->movservices[3]->movs->import, 2) }}
                                                            </h6>
                                                        @else
                                                            <h6
                                                                style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                                {{ number_format($d->movservices[3]->movs->import, 2) }}
                                                            </h6>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($caja != 'Todos')
                                    @if (count($movbancarios) > 1)
                                        <tr>
                                            <td colspan="9">
                                                <h5 class="text-center"
                                                    style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                    Servicios entregados y pagados por banco
                                                </h5>
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach ($movbancarios as $d)
                                        <tr>
                                            {{-- # --}}
                                            <td width="2%">
                                                <h6 class="table-th text-withe text-center"
                                                    style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                    {{ $loop->iteration + $contador }}</h6>
                                            </td>
                                            {{-- FECHA --}}
                                            {{-- @foreach ($d->movservices as $movser) --}}
                                            {{-- @if ($d->type == 'ENTREGADO' && $d->status == 'ACTIVO') --}}
                                            <td class="text-center">
                                                <h6
                                                    style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                    {{ \Carbon\Carbon::parse($d->creacion_Mov)->format('d/m/Y') }}
                                                </h6>
                                            </td>
                                            {{-- @endif --}}
                                            {{-- @endforeach --}}
                                            {{-- CLIENTE --}}
                                            <td class="text-center">
                                                <h6
                                                    style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                    {{ $d->nomCli }}</h6>
                                            </td>
                                            {{-- NÚMERO DE ORDEN --}}
                                            <td class="text-center">
                                                <h6
                                                    style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                    {{ $d->orderId }}</h6>
                                            </td>

                                            {{-- DETALLE --}}
                                            <td class="text-center">
                                                <h6
                                                    style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                    {{ $d->nomCat }} {{ $d->marca }}
                                                    {{ $d->detalle }}
                                                </h6>
                                            </td>
                                            {{-- COSTO --}}
                                            @if (@Auth::user()->hasPermissionTo('Ver_Costo_Reportes_Entregados'))
                                                <td class="text-center">
                                                    <h6
                                                        style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                        {{ number_format($d->utilidad, 2) }}</h6>
                                                </td>
                                            @endif
                                            {{-- IMPORTE --}}
                                            <td class="text-center">
                                                <h6
                                                    style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                    {{ number_format($d->import, 2) }}</h6>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>

                                <tr class="tablaserviciostr">
                                    <td colspan="2" class="text-left">
                                        <span
                                            style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0"><b>EFECTIVO</b></span>
                                    </td>
                                    @if (@Auth::user()->hasPermissionTo('Ver_Costo_Reportes_Entregados'))
                                        <td class="text-right" colspan="4">
                                            <span
                                                style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                {{ number_format($sumaUtilidad, 2) }} bs.
                                            </span>
                                        </td>
                                    @endif
                                    <td class="text-right" colspan="5">
                                        <span
                                            style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                            {{ number_format($sumaEfectivo, 2) }} bs.
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-left">
                                        <span
                                            style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0"><b>TRANSFERENCIA
                                                BANCARIA /T.DEBITO</b></span>
                                    </td>
                                    @if (@Auth::user()->hasPermissionTo('Ver_Costo_Reportes_Entregados'))
                                        <td class="text-right" colspan="4">
                                            <span
                                                style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                {{ number_format($sumaUtilidadBanco, 2) }} bs.
                                            </span>
                                        </td>
                                    @endif
                                    <td class="text-right" colspan="5">
                                        <span
                                            style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                            {{ number_format($sumaBanco, 2) }} bs.
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="text-left">
                                        <span
                                            style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0"><b>TOTALES</b></span>
                                    </td>
                                    @if (@Auth::user()->hasPermissionTo('Ver_Costo_Reportes_Entregados'))
                                        <td class="text-right" colspan="4">
                                            <span
                                                style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0"><strong>
                                                    @if ($caja != 'Todos')
                                                        {{-- {{ number_format($sumaCosto + $sumaCostoEfectivo, 2) }} bs. --}}
                                                        {{ number_format($sumaUtilidadTotal, 2) }} bs.
                                                    @else
                                                        {{ number_format($sumaUtilidadTotal, 2) }} bs.
                                                    @endif
                                                </strong></span>
                                        </td>
                                    @else
                                        <td class="text-right" colspan="3">
                                        </td>
                                    @endif
                                    <td class="text-right" colspan="0">
                                        <span
                                            style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0"><strong>
                                                @php
                                                    $mytotal = 0;
                                                @endphp
                                                @foreach ($data as $d)
                                                    @foreach ($d->movservices as $mv)
                                                        @if ($mv->movs->status == 'ACTIVO')
                                                            @php
                                                                $mytotal = $sumaBanco + $sumaEfectivo;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                                {{ number_format($mytotal, 2) }} bs.
                                            </strong>
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>



        </div>
        @include('livewire.reportes_tigo.sales-detail')
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr(document.getElementsByClassName('flatpickr'), {
            enableTime: false,
            dateFormat: 'Y-m-d',
            locale: {
                firstDayofweek: 1,
                weekdays: {
                    shorthand: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                    longhand: [
                        "Domingo",
                        "Lunes",
                        "Martes",
                        "Miércoles",
                        "Jueves",
                        "Viernes",
                        "Sábado",
                    ],
                },
                months: {
                    shorthand: [
                        "Ene",
                        "Feb",
                        "Mar",
                        "Abr",
                        "May",
                        "Jun",
                        "Jul",
                        "Ago",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dic",
                    ],
                    longhand: [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre",
                    ],
                },
            }
        })

        //eventos
        window.livewire.on('show-modal', msg => {
            $('#modalDetails').modal('show')
            noty(msg)
        });

    })
</script>
