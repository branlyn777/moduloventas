<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\CarteraMov;
use App\Models\Company;
use Barryvdh\DomPDF\Facade as PDF;

use App\Models\Movimiento;


class IngresoEgresoPdfController extends Controller
{
    public function printPdf($mov, $nombre)
    {
        

        $carteramov = CarteraMov::where('movimiento_id', $mov)->first();
        $tipoMovimiento = $carteramov->type;
        $fecha = $carteramov->created_at;
        $motivo = $carteramov->comentario;
        $movimiento=Movimiento::find($mov);
        $importe=$movimiento->import;
        $nombreempresa = Company::find(1)->name;
        $logoempresa = Company::find(1)->image;
        $nombrepersona = $nombre;
        $nombreusuario=$movimiento->usermov->name;



        $pdf = PDF::loadView(
            'livewire.pdf.reciboingresosegresos',
            compact(
                'tipoMovimiento',
                'nombrepersona',
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
