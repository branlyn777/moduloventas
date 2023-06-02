<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Caja;
use App\Models\Cartera;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Company;
use App\Models\User;
use App\Models\Sucursal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExportMovDiaResController extends Controller
{
    public function reportPDFMovDiaResumen()
    {
        //Variables para la tbody
        $totalesIngresosV = session('totalIngresosV');
        $totalesIngresosV_suma = 0;
        foreach ($totalesIngresosV as $value) {
            if ($value['ctipo'] == 'efectivo') {

                $totalesIngresosV_suma += +$value['importe'];
            }
        }



      
        $totalesIngresosIE = session('totalIngresosIE');
        $totalesIngresosIE_suma = 0;
        foreach ($totalesIngresosIE as $value) {
            if ($value['ctipo'] == 'efectivo') {

                $totalesIngresosIE_suma += +$value['importe'];
            }
        }

        $totalesEgresosV = session('totalEgresosV');
        $totalesEgresosIE = session('totalEgresosIE');


        //dd($totalesEgresosIE);

        $ingresosTotalesBancos = session('ingresosTotalesBancos');
        $operacionsob = session('operacionsob');
        $operacionfalt = session('operacionfalt');



        $totalesEgresosIE_suma = 0;
        foreach ($totalesEgresosIE as $valor) {
            if ($valor['ctipo'] == 'efectivo') {

                $totalesEgresosIE_suma += +$valor['importe'];
            }
        }


        //Variables para la tfoot
        $ingresosTotalesCF = session('ingresosTotalesCF'); //
        $op_recaudo = session('op_recaudo'); //
        $ingresosTotalesNoCFBancos = session('ingresosTotalesNoCFBancos');
        $total = session('total');
        $subtotalcaja = session('subtotalcaja');
        $operacionesefectivas = session('operacionesefectivas');
        $ops = session('ops');
        $operacionesW = session('operacionesW');

        $totalutilidadSV = session('totalutilidadSV');
        $EgresosTotalesCF = session('EgresosTotalesCF');
 
        $saldo_acumulado = session('saldo_acumulado');
        //dd(session('op_sob_falt'));
        $op_sob_falt = session('op_sob_falt');

        $operacionesZ = session('operacionesZ');

        $caracteristicas = session('caracteristicas');
        $total = session('total');

        $sucursal = $caracteristicas[0];
        $caja = $caracteristicas[1];
        $fromDate = $caracteristicas[2];
        $toDate = $caracteristicas[3];



        if ($caja != 'TODAS') {
            $caja = Caja::find($caja)->nombre;
        }


        $nombreempresa = Company::find(1)->name;
        $logoempresa = Company::find(1)->horizontal_image;

        $pdf = PDF::loadView(
            'livewire.pdf.reportemovdiaresumen',
            compact(
                'totalesIngresosV',
      
                'totalesIngresosIE',
                'totalesEgresosV',
                'totalesEgresosIE',
                'ingresosTotalesCF',
                'ingresosTotalesNoCFBancos',
     
                'saldo_acumulado',
                'EgresosTotalesCF',
                'op_sob_falt',
                'operacionesZ',
                'totalutilidadSV',
                'op_recaudo',
                'total',
                'subtotalcaja',
                'operacionesefectivas',
                'ops',
                'operacionesW',
          
                'caja',
                'fromDate',
                'toDate',
                'nombreempresa',
                'logoempresa',
                'ingresosTotalesBancos',
                'operacionsob',
                'operacionfalt',
                'total',
                'totalesEgresosIE_suma',
                'totalesIngresosV_suma',

                'totalesIngresosIE_suma'
            )
        );



        return $pdf->stream('Reporte_Movimiento_Diario_Resumen.pdf');
    }
}
