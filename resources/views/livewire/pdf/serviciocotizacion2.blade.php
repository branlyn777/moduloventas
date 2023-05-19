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
                <td class="text-center mayus" style="font-size: 15px; width: 33%;">
                    EL ROI
                    <br>
                    78965469
                    <br>
                    Avenida Melchor Perez de Olguin y Avenida Capitan Victor Ustáriz
                </td>
                <td class="text-center" style="width: 33%;">

                </td>
                <td style="width: 33%; text-align: right;">

                    <img src="{{ asset('storage/iconos/elroi.jpg') }}" alt="" class="invoice-logo" height="100px">
                </td>
            </tr>
        </tbody>

    </table>

    <hr style="height:1px;border:none;color:rgb(189, 188, 188);background-color:rgb(0, 0, 0);" />

    <table style="width: 100%;">
        <tbody>
            <tr>
                <td style="font-size: 15px; width: 30%;">
                    Señor(es);
                    <br>
                    {{ ucwords(strtolower($detalles_extra->nombrecliente)) }}
                    <br>
                    Nit: {{ ucwords(strtolower($detalles_extra->nitcliente)) }}
                    <br>
                    Presente.-
                </td>
                <td class="text-center" style="width: 30%;">

                </td>
                <td class="text-center" style="font-size: 14px; width: 35%; ">
                    Cochabamba, {{ $dia_mes_actual }}
                    <br>
                    {{-- I.T.No: 6952/3913 --}}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="row">

        <div class="card-body text-center">
            <h5 class="card-title" style="font-size: 17px">COTIZACION DE SERVICIO</h5>

        </div>
        <div style="padding-left: 17px;">
            <p style="font-size: 16px;">Saludos</p>
            <p style="font-size: 15px;">
                De mi mayor consideración, y a petición del interesado le hacemos llegar la cotización del servicio e
                información adicional adjunta, en relación al servicio prestado por personal de nuestra empresa, al
                igual que el
                detalle de costos y materiales empleados descritos a continuación:
            </p>
        </div>

        <div style="padding-left: 57px;">

            <table class="table table-striped tablestyle" style="font-size: 15px;">
                <tbody>
                    <tr>
                        <td class="text-center">
                            {{ strtoupper($detalles_extra->nombrecategoria) }}
                            {{ strtoupper($datos_servicio->marca) }}
                            {{ $detalles_extra->detalle }}

                        </td>
                    </tr>
                    <tr>
                        <td><b>Cotización: </b> {{ ucwords(strtolower($datos_servicio->diagnostico)) }}</td>
                    </tr>
                    <tr>
                        <td><b>Precio Servicio:</b> {{ ucwords(strtolower($detalles_extra->precioservicio)) }} Bs</td>
                    </tr>
                </tbody>
            </table>

        </div>

        <div style="padding-left: 17px;">
            <p style="font-size: 15px;">
                Para veracidad de la misma firmamos al pie del documento tanto los responsables como el personal
                encargado
                de la supervisión y control de calidad de nuestra Empresa.
                Sin más que decir me despido,
                Atentamente
            </p>
        </div>
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

        <br>
        <div class="mayus" style="font-size: 15px;"">
            EL ROI | Cochabamba, {{ $dia_mes_actual }}
        </div>

    </div>
</body>

</html>
