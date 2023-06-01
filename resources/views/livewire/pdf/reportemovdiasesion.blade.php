<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movimiento Diario General-Resumen</title>



    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css') }}">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">

    <style>
        .estilostable {
            width: 100%;
            font-size: 12px;
            border-spacing: 0px;
            color: black;
            margin: auto;
            border-collapse: collapse;
            border: 0.5px solid rgb(204, 204, 204);
        }

        .estilostable .tablehead {
            background-color: #dbd4d4;
            font-size: 10px;
        }

        .estilostable2 {
            width: 100%;
            font-size: 9px;
            border-spacing: 0px;
            color: black;
        }

        .estilostable2 .tablehead {
            background-color: white;
        }

        .fnombre {
            border: 0.5px solid rgb(204, 204, 204);
        }

        .filarow {
            border: 0.5px solid rgb(204, 204, 204);
            width: 20px;
            text-align: center;
        }

        .filarowpp {
            border: 0.5px solid rgb(204, 204, 204);
            width: 53px;
            text-align: center;
            font-size: 8px;
        }

        .filarownombre {
            border: 0.5px solid rgb(204, 204, 204);
            width: 150px;
        }

        .filarowx {
            border: 0.5px solid rgb(255, 255, 255);
            width: 100%;
            text-align: center;
        }
    </style>
</head>

<body class="row">
    <table class="filarowx">
        <tbody>
            <tr class="filarowx">
                <td rowspan="2">
                    <img src="{{ asset('storage/iconos/' . $logoempresa) }}" height="50">
                </td>
                <td style="text-align: center;">
                    <h4><b>REPORTE DE MOVIMIENTO DIARIO</b></h4>
                </td>
                <td rowspan="2">
                    <img src="{{ asset('storage/blanco.jpg') }}" height="50">
                </td>
            </tr>
            <tr>
                <td class="text-center fuente">
                    {{ $nombreempresa }}
                </td>
            </tr>
        </tbody>
    </table>

    <br>

    <div class="">
        <table class="estilostable">
            <thead>
                <tr class="tablehead">
                    <th class="text-center">FECHA</th>
                    <th class="text-center">DETALLE</th>
                    <th style="text-align: right;">INGRESO(Bs)</th>
                    <th style="text-align: right;">EGRESO(Bs)</th>
                    <th style="text-align: right;">
                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                            UTILIDAD(Bs)
                        @endif
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" style="background-color: bisque;margin:auto;">Ventas</td>
                </tr>
                @foreach ($totalesIngresosV as $row)
                    <tr class="fuente">
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($row['movcreacion'])->format('d/m/Y H:i') }}
                        </td>
                        <td class="text-center">
                            {{ $row['idventa'] }} {{ $row['tipoDeMovimiento'] }}
                            {{ $row['ctipo'] == 'CajaFisica' ? 'Efectivo' : $row['ctipo'] }}
                            ({{ $row['nombrecartera'] }})
                        </td>
                        <td style="text-align: right;">
                            {{ $row['importe'] }}
                        </td>
                        <td>

                        </td>
                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                            <td style="text-align: right;">
                                {{ number_format($row['utilidadventa'], 2) }}
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <table class="estilostable2">
                                <thead>
                                    <tr>
                                        <td class="fnombre">
                                            Nombre
                                        </td>
                                        <td class="filarowpp">
                                            Precio Original
                                        </td>
                                        <td class="filarow">
                                            Desc/Rec
                                        </td>
                                        <td class="filarowpp">
                                            Precio Venta
                                        </td>
                                        <td class="filarow">
                                            Cantidad
                                        </td>
                                        <td class="filarow">
                                            Total
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($row['detalle'] as $item)
                                        <tr class="">
                                            <td class="filarownombre">
                                                {{-- {{rtrim(mb_strimwidth($item['nombre'], 2, 2, '...', 'UTF-8'))}} --}}
                                                {{-- {{$item['nombre']}} --}}
                                                {{ substr($item['nombre'], 0, 25) }}
                                            </td>
                                            <td class="filarow">
                                                {{ number_format($item['po'], 2) }}
                                            </td>
                                            <td class="filarow">
                                                @if ($item['po'] - $item['pv'] == 0)
                                                    {{ $item['po'] - $item['pv'] }}
                                                @else
                                                    {{ ($item['po'] - $item['pv']) * -1 }}
                                                @endif
                                            </td>
                                            <td class="filarow">
                                                {{ number_format($item['pv'], 2) }}
                                            </td>
                                            <td class="filarow">
                                                {{ $item['cant'] }}
                                            </td>
                                            <td class="filarow">
                                                {{ number_format($item['pv'] * $item['cant'], 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                        <td></td>
                        <td></td>
                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                            <td></td>
                        @endif
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" style="background-color: bisque;margin:auto;">Servicios</td>
                </tr>
                @foreach ($totalesIngresosS as $service)
                    <tr>
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($service['movcreacion'])->format('d/m/Y H:i') }}
                        </td>

                        <td class="text-center">

                            {{ 'Orden N° ' . $service['order_id'] . ',Servicio de ' . $service['servicio_solucion'] }}{{ $service['ctipo'] == 'efectivo' ? '(Pago en efectivo)' : '(Pago por transaccion de ' . $service['cnombre'] . ')' }}
                        </td>

                        <td style="text-align: right;">
                            <span class=" text-sm">
                                {{ number_format($service['importe'], 2) }}
                            </span>
                        </td>
                        <td>

                        </td>
                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                            <td style="text-align: right;">
                                {{ number_format($service['importe'], 2) }}
                            </td>
                        @endif
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" style="background-color: bisque;margin:auto;">Otros Ingresos</td>
                </tr>
                @foreach ($totalesIngresosIE as $ie)
                    <tr>
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($ie['movcreacion'])->format('d/m/Y H:i') }}
                        </td>

                        <td class="text-center">
                            {{ $ie['carteramovtype'] }} en
                            {{ $ie['ctipo'] == 'CajaFisica' ? 'Efectivo' : $ie['ctipo'] }}
                            ({{ $ie['nombrecartera'] }})
                        </td>
                        <td style="text-align: right;">
                            {{-- {{ $ie['importe'] }} --}}
                            {{ number_format($ie['importe'], 2) }}
                        </td>
                        <td>

                        </td>
                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                            <td style="text-align: right;">
                                {{ number_format($ie['importe'], 2) }}
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <td></td>
                        <td class="filarowpp">
                            {{ ucwords(strtolower($ie['coment'])) }}
                        </td>
                        <td></td>
                        <td></td>
                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                            <td></td>
                        @endif
                    </tr>
                @endforeach
                        <tr>
                            <td colspan="5" style="background-color: bisque;margin:auto;">Egresos</td>
                        </tr>
                @foreach ($totalesEgresosIE as $st)
                    <tr>
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($st['movcreacion'])->format('d/m/Y H:i') }}
                        </td>

                        <td class="text-center">
                            {{ $st['carteramovtype'] }} en
                            {{ $st['ctipo'] == 'CajaFisica' ? 'Efectivo' : $st['ctipo'] }}
                            ({{ $st['nombrecartera'] }})
                        </td>
                        <td>

                        </td>
                        <td style="text-align: right;">
                            {{ $st['importe'] }}
                        </td>
                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                            <td>

                            </td>
                        @endif
                    </tr>
                    <tr>
                        <td></td>
                        <td class="filarowpp">
                            {{ ucwords(strtolower($st['coment'])) }}
                        </td>
                        <td></td>
                        <td></td>
                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                            <td></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>

        </table>

        <br>



        <table class="estilostable" style="width: 300px">

            <thead>
                <tr class="tablehead">
                    <th class="text-center" colspan="2">Resumen de efectivo</th>

                </tr>

            </thead>
            <tbody>
                <tr>
                    <td>
                        Total Ingresos en efectivo
                    </td>
                    <td>
                        {{ number_format($totalesIngresosV_suma + $totalesIngresosIE_suma + $totalesIngresosS_suma, 2) }}
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 15px">
                        Ventas
                    </td>
                    <td>
                        {{ number_format($totalesIngresosV_suma, 2) }}
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 15px">
                        Servicios
                    </td>
                    <td>
                        {{ number_format($totalesIngresosS_suma, 2) }}
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 15px">
                        Otros Ingresos
                    </td>
                    <td>
                        {{ number_format($totalesIngresosIE_suma, 2) }}
                    </td>
                </tr>

                <tr>
                    <td>
                        Total Egresos en efectivo
                    </td>
                    <td>
                        {{ number_format($totalesEgresosIE_suma ?? 0, 2) }}
                    </td>

                </tr>

                <tr>
                    <td>
                        Saldo Total de efectivo
                    </td>
                    <td>
                        {{ number_format($totalesIngresosV_suma + $totalesIngresosS_suma + $totalesIngresosIE_suma - $totalesEgresosIE_suma ?? 0, 2) }}
                    </td>

                </tr>

                <tr>
                    <td>
                        Operaciones Tigo Money
                    </td>
                    <td>
                        {{ number_format($tigo_op, 2) }}
                    </td>

                </tr>


                <tr>
                    <td>
                        Apertura Caja
                    </td>
                    <td>
                        @if ($movimiento != null)
                            {{ number_format($movimiento['import'], 2) }}
                        @endif
                    </td>

                </tr>

                <tr>
                    <td>
                        Sobrantes
                    </td>
                    <td>
                        {{ number_format($sobrante, 2) }}
                    </td>


                </tr>
                <tr>
                    <td>
                        Faltantes
                    </td>
                    <td>
                        {{ number_format($faltante, 2) }}
                    </td>


                </tr>
                <tr>
                    <td>
                        Recaudo
                    </td>
                    <td>
                        {{ number_format($recaudo, 2) }}
                    </td>


                </tr>
                <tr>
                    @if ($cierremonto == 0)
                        <td>
                            Saldo antes del cierre de caja
                        </td>
                        <td>
                            Bs.
                            {{ number_format($totalesIngresosV_suma + $totalesIngresosS_suma + $totalesIngresosIE_suma - $totalesEgresosIE_suma + $tigo_op + $movimiento['import'] + $sobrante - $faltante ?? 0, 2) }}
                        </td>
                    @else
                        <td>
                            Saldo al cierre de caja
                        </td>
                        <td>
                            Bs. {{ $cierremonto }}
                        </td>
                    @endif

                </tr>

            </tbody>
        </table>




    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <table class="filarowx">
        <tbody>
            <tr class="filarowx">
                <td>

                </td>
                <td class="text-center">
                    <hr
                        style="height: 0.5px;
                    width: 150px;
                    background-color: rgb(0, 0, 0);">
                    Cajero
                </td>
                <td>

                </td>
                <td class="text-center">
                    <hr
                        style="height: 0.5px;
                    width: 150px;
                    background-color: rgb(0, 0, 0);">
                    Revisado por
                </td>
                <td>

                </td>
            </tr>
            {{-- <tr>
                <td class="text-center">
                    Soluciones Informáticas Emanuel
                </td>
            </tr> --}}
        </tbody>
    </table>


</body>

</html>
