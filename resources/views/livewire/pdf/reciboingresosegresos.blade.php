<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de {{$tipoMovimiento}}</title>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .cajaestilo{
            background-color: #fdfdfd;
            border-radius: 15px;
            border: 1px solid #5a5a5a;
            padding: 10px;
            text-align:center;
            margin:auto;
        }
    </style>

</head>

<body>

    
    <div class="cajaestilo">
        <table style="width: 100%;">
            <tr class="text-center">
                <td style="padding-left: 10px; width: 33%;">
                    <img src="{{ asset('storage/iconos/' . $logoempresa) }}" class="invoice-logo" height="70px">
                </td>
                <td colspan="2" style="width: 34%;">
                    <center>
                        <span style="font-size: 20px; font-weight:bold;">Recibo de Caja {{$tipoMovimiento}}</span>
                        <p style="font-size: 14px; font-weight:bold;">{{$nombreempresa}}</p>
                    </center>
                </td>
                <td style="width: 33%;">
            
                </td>
               
            </tr>
            <tr>
                <td style="width: 35%;">
                    <b>Fecha:</b> {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y H:i') }}
                    <br>
                    <b>Atendido por:</b> {{$nombreusuario}}
                    <br>
                    @if ($tipoMovimiento== 'INGRESO')
                    <b>Recibido de:</b> {{$nombrepersona}}
                    <br>
                    @else
                    <b>Pagado a:</b> {{$nombrepersona}}
                    <br>
                    @endif
                    <b>Atendido por:</b> {{$nombreusuario}}
                    <br>
                    <b>Monto Bs.</b>:{{$importe}}
                </td>
            </tr>
        </table>
    
        <div>
            <table style="width: 100%;">
                <thead class="text-white" style="background: #3d3d3d; color: aliceblue; ">
                    <tr>
                        <th>CONCEPTO</th>
                        
                    </tr>
                </thead>
                <tbody style="background-color: rgb(255, 255, 255)">
                 
                    <tr>
                        <td>
                            {{ $motivo }}
                        </td>
                    
                    </tr>
            
                    <tr style="background: #e4e0e0 ">
                        <td>

                        </td>
                        <td>
                            <hr style="margin: 2px; color: black">
                            <b>Firma del cajero(a)</b>
                        </td>
                    
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</body>

</html>