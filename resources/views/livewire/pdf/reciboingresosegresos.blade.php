<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de {{ $tipoMovimiento }}</title>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .cajaestilo {
            background-color: #fdfdfd;
            border-radius: 15px;
            border: 1px solid #5a5a5a;
            padding: 10px;

            margin: auto;
        }
        .filarowx{
            margin-top: 6rem;
            border: 0.5px solid rgb(255, 255, 255);
            width: 100%;
            text-align: center;
        }
    </style>

</head>

<body>


    <div class="cajaestilo">
        <table style="width: 100%;">
            <tr class="mb-4">
                <td style="padding-left: 2px;margin-top: 2px;width: 33%;">
                    <img src="{{ asset('storage/iconos/' . $logoempresa) }}" height="50px">
                </td>
                <td style="width: 34%;">
                    <center>
                        <span style="font-size: 20px; font-weight:bold;">Recibo de Caja</span>
                        <p style="font-size: 14px; font-weight:bold;">{{ $nombreempresa }}</p>
                    </center>
                </td>
                <td style="width: 33%;">

                </td>

            </tr>
            <tr>
                <td>
                    <b>Fecha:</b> {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}
                    <br>
                    <b>Monto Bs.</b>:{{ $importe }}
                </td>
                <td>

                </td>
                <td>
                    <b>Recibido por:</b>{{ $nombreusuario }}
                    <br>
                    @if ($tipoMovimiento == 'INGRESO')
                        <b>Pago efectuado por:</b> {{ $nombrepersona }}
                    @else
                        <b>Pago efectuado a:</b> {{ $nombrepersona }}
                    @endif
                </td>


            </tr>


        </table>

        <div>
            <p style="border-radius: 11px;border: 1px solid #5a5a5a; padding-left: 1.8%; padding-top: 0.4rem; padding-bottom: 3rem">
                <b>Por Concepto de:</b> {{ $motivo == '' ? S / N : $motivo }}
            </p>
        </div>
        <table class="filarowx">
            <tbody>
                <tr class="filarowx">
                    <td>
                        
                    </td>
                    <td class="text-center">
                        <hr style="height: 0.5px;
                        width: 150px;
                        background-color: rgb(0, 0, 0);">
                        RECIBIDO POR
                    </td>
                    <td>
                        
                    </td>
                    <td class="text-center">
                        <hr style="height: 0.5px;
                        width: 150px;
                        background-color: rgb(0, 0, 0);">
                       ENTREGADO POR
                    </td>
                    <td>
                        
                    </td>
                </tr>
      
            </tbody>
        </table>
    </div>
</body>

</html>
