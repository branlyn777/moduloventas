<?php

namespace App\Http\Controllers;

use App\Models\OrderService;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Service;
use App\Models\User;

class ImprimirController extends Controller
{
    public function print($idOrdenServicio)
    {
        $data = $idOrdenServicio;
        
        $pdf = PDF::loadView('livewire.pdf.imprimirOrdenprueba', compact('data'));
        /* $pdf->setPaper("A4", "landscape"); //orientacion y tamaño */

        return $pdf->stream('OrdenTrServicio.pdf');  //visualizar
        /* return $pdf->download('ordenServicio.pdf');  //descargar */
        
    }
}
