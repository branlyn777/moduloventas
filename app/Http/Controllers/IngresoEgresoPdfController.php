<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\CarteraMov;
use App\Models\Company;
use Barryvdh\DomPDF\Facade as PDF;

use App\Models\Movimiento;


class IngresoEgresoPdfController extends Controller
{
    public function printPdf(Movimiento $mov, $nombre)
    {
        $carteramov = CarteraMov::where('movimiento_id', $mov->id)->first();
        $tipoMovimiento = $carteramov->type;
        $fecha = $carteramov->created_at;
        $motivo = $carteramov->comentario;
        $importe = $mov->import;
        $nombreempresa = Company::find(1)->name;
        $logoempresa = Company::find(1)->image;
        $nombrepersona = $nombre;



        $pdf = PDF::loadView(
            'livewire.pdf.reciboingresosegresos',
            compact(
                'tipoMovimiento',
                'fecha',
                'nombreusuario',
                'importe',
                'motivo',
                'nombreempresa',
                'logoempresa'

            )
        );

        return $pdf->stream('comprobante_ingresos_egresos.pdf');
    }
}
