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
        //nombre de la sucursal name 
        $sucursal = OrderService::join("services as s","s.order_service_id", "order_services.id")
        ->join("sucursals as su","su.id", "s.sucursal_id")
        ->select("su.*")
        ->where("order_services.id",$idOrdenServicio)
        ->first();
        //servicio
        $servicio = OrderService::join("services as s","s.order_service_id", "order_services.id")
        ->select("s.*")
        ->where("order_services.id",$idOrdenServicio)
        ->first();
        //nombre de cliente
        $cliente = $this->get_client($idOrdenServicio);
       
        $pdf = PDF::loadView('livewire.pdf.imprimirOrdenprueba', compact('data','sucursal', 'cliente','servicio'));
        /* $pdf->setPaper("A4", "landscape"); //orientacion y tamaño */

        return $pdf->stream('OrdenTrServicio.pdf');  //visualizar
        /* return $pdf->download('ordenServicio.pdf');  //descargar */
        
    }
    // Obtiene el cliente de una órden de servicio
    public function get_client($code)
    {
        $client = Service::join("mov_services as ms", "ms.service_id", "services.id")
        ->join("movimientos as m", "m.id", "ms.movimiento_id")
        ->join("cliente_movs as cm", "cm.movimiento_id", "m.id")
        ->join("clientes as c", "c.id", "cm.cliente_id")
        ->select("c.*")
        ->where("services.order_service_id", $code)
        ->first();
        return $client;
    }
   
}
