<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .mayus {
            text-transform: uppercase;
        }
        .tablestyle {
            border-spacing: 10px 20px;
        }

    </style>
</head>

<body>
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td class="text-center" style="width: 33%;">

                    <img src="{{ asset('storage/iconos/' . $logoempresa) }}" alt="" class="invoice-logo" height="100px">
                </td>
                <td class="text-center" style="width: 33%;">

                </td>
                <td class="text-center mayus" style="font-size: 15px; width: 33%;">
                    Cochabamba, {{ $dia_mes_actual }}
                </td>
            </tr>
        </tbody>

    </table>

    {{-- <hr style="height:1px;border:none;color:rgb(189, 188, 188);background-color:rgb(0, 0, 0);" /> --}}

    <table style="width: 100%;">
        <tbody>
            <tr>
                <td style="font-size: 15px; width: 30%;">
                    Señor(es):
                    {{ ucwords(strtolower($detalles_extra->nombrecliente)) }}
                    <br>
                    Nit: {{ ucwords(strtolower($detalles_extra->nitcliente)) }}
                    <br>
                    Presente.-
                </td>
                <td class="text-center" style="width: 30%;">

                </td>
                <td class="text-center" style="font-size: 14px; width: 35%; background-color: rgb(255, 255, 109); text-align: center; border-radius: 7px;">
                    <h5 class="card-title" style="font-size: 17px">COTIZACION DE SERVICIO</h5>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="row">

        <div class="card-body text-center">
            {{-- <h5 class="card-title" style="font-size: 17px">COTIZACION DE SERVICIO</h5> --}}

        </div>
        <br>

        <div>

            <table style="font-size: 15px; width: 100%;">
                <tbody>
                    <tr>
                        <td style="text-align: center;">
                            <b>{{ strtoupper($detalles_extra->nombrecategoria) }}
                                {{ strtoupper($datos_servicio->marca) }}
                                {{ $detalles_extra->detalle }}</b>

                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

        <br>
        <br>



        <table style="width: 100%">
            <thead style="background-color: black; color: white;">
                <tr>
                    <th style="height: 35px; text-align: left;">
                        <b>DESCRIPCION</b>
                    </th>
                    <th style="width: 120px;">
                       <b>TOTAL</b>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding-top: 13px;">
                        {{ strtoupper($datos_servicio->diagnostico) }}
                    </td>
                    <td style="text-align: center; padding-top: 13px;">
                        {{ ucwords(strtolower($detalles_extra->precioservicio)) }} Bs
                    </td>
                </tr>
            </tbody>
        </table>



















        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <br>
        <br>
        <br>
        <br>

        <div class="mayus" style="font-size: 15px;">
            <b>Términos y Condiciones</b>
            <br>
            <br>

            Para dar comienzo a este servicio, se requiere la aprobación de la empresa y la entrega del equipo correspondiente para llevar a cabo el servicio solicitado.
            <br>
            <br>
            <b>Cotización válida por 30 dias</b>
        </div>
        <br>
        <br>


        <br>
        <br>
        <br>



        <hr style="height:1px; border:none ;background-color:rgb(0, 0, 0); width: 35%;" />

        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td class="text-center" style="font-size: 10px; width: 100%; text-align: center;">
                        Administrador
                        <br>
                        DPTO. TECNICO
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="mayus" style="font-size: 12px; text-align: center;">
        {{ $nombreempresa }} | Cochabamba, {{ $dia_mes_actual }}
    </div>
</body>

</html>
