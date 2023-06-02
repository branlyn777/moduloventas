<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Barryvdh\DomPDF\Facade as PDF;

use App\Models\Company;


class ExportMovDiaSesionController extends Controller
{
    public function reportPDFMovDiaSesion()
    {
        //Variables para la tbody
        $totalesIngresosV = session('totalesIngresosVentas');
      
        $totalesIngresosIE = session('totalesIngresosIE');
        $totalesEgresosIE = session('totalesEgresosIE');
        $movimiento = session('movimiento');
        $sobrante = session('sobrante');
        $faltante = session('faltante');
        $cierremonto = session('cierremonto');
    
        $recaudo = session('recaudop');



        $totalesIngresosV_suma = 0;
        $ingresos_venta = 0;
        $ingresos_servicios = 0;

        foreach ($totalesIngresosV as $valor) {
            if ($valor['ctipo'] == 'efectivo') {

                $totalesIngresosV_suma += +$valor['importe'];
            }
        }
      


        $totalesIngresosIE_suma = 0;
        foreach ($totalesIngresosIE as $valor) {
            if ($valor['ctipo'] == 'efectivo') {

                $totalesIngresosIE_suma += +$valor['importe'];
            }
        }

        $totalesEgresosIE_suma = 0;
        foreach ($totalesEgresosIE as $valor) {
            if ($valor['ctipo'] == 'efectivo') {

                $totalesEgresosIE_suma += +$valor['importe'];
            }
        }



        // $totalesEgresosIE_suma = array_sum(array_column($totalesEgresosIE, 'importe'));

        $nombreempresa = Company::find(1)->name;
        $logoempresa = Company::find(1)->horizontal_image;


        $pdf = PDF::loadView(
            'livewire.pdf.reportemovdiasesion',
            compact(
                'nombreempresa',
                'logoempresa',
                'totalesIngresosV',
        
                'totalesIngresosIE',
                'totalesEgresosIE',
                'totalesIngresosV_suma',
       
                'totalesIngresosIE_suma',
                'totalesEgresosIE_suma',
                'movimiento',
                'sobrante',
                'faltante',
                'cierremonto',
        
                'recaudo'
            )
        );

        return $pdf->stream('Reporte_Movimiento_Sesion.pdf');
    }
}
