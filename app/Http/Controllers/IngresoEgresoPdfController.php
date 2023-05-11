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

class ExportIngresosController extends Controller
{

   

    public function printPdf()
    {
        
        
        $pdf = PDF::loadView('livewire.pdf.reporteingresos',
        compact('ingresos','ingresossumatotal',
                'sucursal',
                'caja',
                'fromDate',
                'toDate',
                'nombreempresa',
                'logoempresa'
            
            ));



        return $pdf->stream('Reporte_Ingresos.pdf'); 
    }
}
