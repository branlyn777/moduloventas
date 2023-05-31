<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Movimiento Diario Ventas</title>
    <style>
        .mytable table {
          width: 100%;
          border-collapse: collapse;
        }
        
        .mytable th {
          font-weight: bold;
          text-align: center;
        }
        
        .mytable thead th, td {
          border: 0.5px solid black;
          padding: 1px;
          font-size: 11px;
        }

        .mytable tbody tr, td {
          border: 0.5px solid black;
          padding: 1px;
          font-size: 11px;
        }









        
        .mytabletitle table {
          width: 100%;
          border-collapse: collapse;
          font-size: 10px;
        }
        .mytabletitle td {
            border: 0.5 solid rgb(255, 255, 255);
        }
        







        

        .text-center {
            text-align: center;
        }
        .text-right {
            padding-right: 7px;
            text-align: right;
        }
        .parrafo {
            font-size: 10px;
        }
    </style>
      
</head>
<body>

    <div class="text-center">
        <h4>Reporte Movimiento Diario Venta</h4>
    </div>

    <div class="mytabletitle">
        <table>
            <thead>
                <tr>
                    <th>SUCURSAL</th>
                    <th>CAJA</th>
                    <th>FECHA DESDE</th>
                    <th>FECHA HASTA</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center">
                    <td>
                        {{$datostablareporte['sucursal']}}
                    </td>
                    <td>
                        {{$datostablareporte['caja']}}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($datostablareporte['dateFrom'])->format('d/m/Y') }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($datostablareporte['dateTo'])->format('d/m/Y') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <p class="text-center parrafo">
        El rango de horas correspondientes a este reporte es desde las {{$datostablareporte['timeFrom']}} hasta las {{$datostablareporte['timeTo']}}
    </p>

    <div class="mytable">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>FECHA</th>
                    <th>CARTERA</th>
                    <th>CAJA</th>
                    <th>INGRESO(Bs)</th>
                    <th>EGRESO(Bs)</th>
                    <th>MOTIVO</th>
                    <th>UTILIDAD</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($d['fecha'])->format('d/m/Y H:i') }}
                    </td>
                    <td class="text-center">
                        {{$d['nombrecartera']}}
                    </td>
                    <td class="text-center">
                        {{$d['nombrecaja']}}
                    </td>
                    <td class="text-right">
                        @if($d['tipo'] == "INGRESO")
                            {{ number_format($d['importe'], 2, ',', '.') }}
                        @endif
                    </td>
                    <td class="text-right">
                        @if($d['tipo'] == "EGRESO")
                        {{ number_format($d['importe'], 2, ',', '.') }}
                        @endif
                    </td>
                    <td class="text-center">
                        {{$d['motivo']}}
                    </td>
                    <td class="text-right">
                        {{ number_format($d['utilidad'], 2, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-center">|</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        
                    </td>
                    <td class="text-center">
                        TOTAL
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td class="text-right">
                        {{ number_format($total_ingreso, 2, ',', '.') }}
                    </td>
                    <td class="text-right">
                        {{ number_format($total_egreso, 2, ',', '.') }}
                    </td>
                    <td>
                        
                    </td>
                    <td class="text-right">
                        {{ number_format($total_utilidad, 2, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>