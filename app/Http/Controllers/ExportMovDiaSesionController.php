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

class ExportMovDiaSesionController extends Controller
{
    public function reportPDFMovDiaSesion()
    {
        //Variables para la tbody
        $totalesIngresosV = session('totalesIngresosV');
        $totalesIngresosIE = session('totalesIngresosIE');
        $totalesEgresosIE = session('totalesEgresosIE');
        $movimiento = session('movimiento');
        $sobrante = session('sobrante');
        $faltante = session('faltante');
        $cierremonto = session('cierremonto');
        $total = session('total');

        $totalesIngresosV_suma = 0;

        foreach ($totalesIngresosV as $v)
        {
            if($v['ctipo'] == "efectivo")
            {
                $totalesIngresosV_suma = $totalesIngresosV_suma + $v['importe'];
            }
        }

        $totalesIngresosIE_suma = 0;

        foreach ($totalesIngresosIE as $ie)
        {
            if($ie['ctipo'] == "efectivo")
            {
                $totalesIngresosIE_suma = $totalesIngresosIE_suma + $v['importe'];
            }
        }

        $totalesEgresosIE_suma = array_sum(array_column($totalesEgresosIE, 'importe'));

        $nombreempresa = Company::find(1)->name;
        $logoempresa = Company::find(1)->horizontal_image;

        $pdf = PDF::loadView('livewire.pdf.reportemovdiasesion',
        compact('nombreempresa',
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
        'total'));

        return $pdf->stream('Reporte_Movimiento_Sesion.pdf'); 
    }
}
