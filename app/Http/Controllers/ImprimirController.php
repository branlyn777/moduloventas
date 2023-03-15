<?php

namespace App\Http\Controllers;

use App\Models\MovService;
use App\Models\OrderService;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ImprimirController extends Controller
{
    public function print($idOrdenServicio)
    {
        $servicios = $this->service_order_detail($idOrdenServicio);

        $data = $idOrdenServicio;

        //orden de servicio
        $orden_servicio= OrderService::find($idOrdenServicio);
        //nombre de la sucursal name 
        $sucursal = OrderService::join("services as s", "s.order_service_id", "order_services.id")
            ->join("sucursals as su", "su.id", "s.sucursal_id")
            ->select("su.*")
            ->where("order_services.id", $idOrdenServicio)
            ->first();
        //servicio
        $servicio = OrderService::join("services as s", "s.order_service_id", "order_services.id")
            ->select("s.*")
            ->where("order_services.id", $idOrdenServicio)
            ->first();
        //nombre de cliente
        $cliente = $this->get_client($idOrdenServicio);
        //usuarios
        // $usuario = User::find()

        $pdf = PDF::loadView('livewire.pdf.imprimirOrdenprueba', compact('servicios','data', 'sucursal', 'cliente', 'servicio','orden_servicio'));
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
    // Obtiene servicios de una orden de servicio
    public function service_order_detail($code)
    {
        $services = Service::join("mov_services as ms", "ms.service_id","services.id","services.id")
        ->join("movimientos as m", "m.id", "ms.movimiento_id",)
        ->join('cat_prod_services as cps', 'cps.id', 'services.cat_prod_service_id')
        ->select("services.id as idservice","services.created_at as created_at", DB::raw("0 as responsible_technician"), DB::raw("0 as receiving_technician"),
        "m.import as price_service","m.on_account as cambio","m.saldo as sal","m.type as type","m.status as ts","cps.nombre as name_cps",
        'services.marca as mark','services.falla_segun_cliente as fall','services.solucion as servi','services.fecha_estimada_entrega as entrega',
        'services.diagnostico as diag','services.created_at as inicio','services.detalle as detail','services.falla_segun_cliente as client_fail')
        ->where("services.order_service_id", $code)
        ->where("m.status", "ACTIVO")
        ->get();
        foreach ($services as $s)
        {
            //Obtener al tecnico responsable de un servicio
            $s->responsible_technician = $this->get_responsible_technician($s->idservice);
            //Obtener al técnico receptor de un servicio
            $s->receiving_technician = $this->get_receiving_technician($s->idservice);
        }
        return $services;
    }
    // Obtener Técnico Responsable a travéz del id de un servicio
    public function get_responsible_technician($idservice)
    {
        $technician = MovService::join("movimientos as m", "m.id","mov_services.movimiento_id")
        ->join("users as u", "u.id", "m.user_id")
        ->select("u.name as user_name")
        ->where("mov_services.service_id", $idservice)
        ->where("m.status", "ACTIVO")
        ->where("m.type", "<>", "PENDIENTE")
        ->orderBy("m.id", "desc")
        ->get();

        if($technician->count() > 0)
        {
            $technician = $technician->first()->user_name;
        }
        else
        {
            $technician = "No Asignado";
        }

        return $technician;
    }
    // Obtiene Técnico Receptor a travéz del id de un servicio
    public function get_receiving_technician($idservice)
    {
        $technician = MovService::join("movimientos as m", "m.id","mov_services.movimiento_id")
        ->join("users as u", "u.id", "m.user_id")
        ->select("u.name as user_name")
        ->where("mov_services.service_id", $idservice)
        ->where("m.type","PENDIENTE")
        ->first();
        return $technician->user_name;
    }
}
