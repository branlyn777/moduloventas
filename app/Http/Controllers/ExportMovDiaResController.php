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
        $totalesIngresosS = session('totalIngresosS');
        $totalesIngresosIE = session('totalIngresosIE');
        $totalesEgresosV = session('totalEgresosV');
        $totalesEgresosIE = session('totalEgresosIE');

        $ingresosTotalesBancos = session('ingresosTotalesBancos');
        $operacionsob = session('operacionsob');
        $operacionfalt = session('operacionfalt');
      


        //Variables para la tfoot
        $ingresosTotalesCF = session('ingresosTotalesCF');//
        $op_recaudo = session('op_recaudo');//
        $ingresosTotalesNoCFBancos = session('ingresosTotalesNoCFBancos');
        $total = session('total');
        $subtotalcaja = session('subtotalcaja');
        $operacionesefectivas = session('operacionesefectivas');
        $ops = session('ops');
        $operacionesW = session('operacionesW');
        $EgresosTotales = session('EgresosTotales');
        $totalutilidadSV = session('totalutilidadSV');
        $EgresosTotalesCF = session('EgresosTotalesCF');
        $operaciones_tigo = session('op_tigo');
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

        
        if($sucursal != 'TODAS')
        {
            //$sucursal = Sucursal::find($sucursal)->name." - ".Sucursal::find($sucursal)->adress;
            $sucursal = Sucursal::find($sucursal)->name;
        }
        
        if($caja != 'TODAS')
        {
            $caja = Caja::find($caja)->nombre;
        }


        $nombreempresa = Company::find(1)->name;
        $logoempresa = Company::find(1)->horizontal_image;

        $pdf = PDF::loadView('livewire.pdf.reportemovdiaresumen',
        compact('totalesIngresosV','totalesIngresosS','totalesIngresosIE','totalesEgresosV','totalesEgresosIE',
                'ingresosTotalesCF',
                'ingresosTotalesNoCFBancos',
                'operaciones_tigo',
                'EgresosTotales',
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
                'sucursal',
                'caja',
                'fromDate',
                'toDate',
                'nombreempresa',
                'logoempresa',
                'ingresosTotalesBancos',
                'operacionsob',
                'operacionfalt',
                'total',
            ));



        return $pdf->stream('Reporte_Movimiento_Diario_Resumen.pdf'); 
    }
}
