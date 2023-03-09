<?php

namespace App\Http\Livewire;

use App\Models\MovService;
use App\Models\OrderService;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class OrderService2Controller extends Component
{   
    //Guarda el numero de paginacion de la tabla ordenes de servicio
    public $pagination;

    use WithPagination;
    public function paginationView()
    {
        return "vendor.livewire.bootstrap";
    }
    public function mount()
    {
        $this->pagination = 20;
    }
    public function render()
    {
        //Consulta para obtener la lista de órdenes de servicio ordenados por fecha de creación
        $service_orders = OrderService::select(
            "order_services.id as code",
            "order_services.created_at as reception_date",
            DB::raw("0 as services"),
            DB::raw("0 as client")
        )
        ->where("order_services.status", "ACTIVO")
        ->orderBy("order_services.id", "desc")
        ->paginate($this->pagination);

        






        foreach ($service_orders as $so)
        {
            //Obtener los servicios de la orden de servicio
            $so->services = $this->service_order_detail($so->code);
            //Obtener el nombre del cliente
            $so->client = $this->get_client($so->code);
        }



        return view("livewire.order_service.orderservice2", [
            "service_orders" => $service_orders,
        ])
        ->extends("layouts.theme.app")
        ->section("content");
    }
    // Obtiene servicios de una orden de servicio
    public function service_order_detail($code)
    {
        $services = Service::join("mov_services as ms", "ms.service_id","services.id")
        ->join("movimientos as m", "m.id", "ms.movimiento_id")
        ->select("services.id as idservice","services.created_at as created_at", DB::raw("0 as responsible_technician"), DB::raw("0 as receiving_technician"),
        "m.import as price_service","m.type as type")
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
        ->orderBy("m.id", "desc")
        ->first();
        return $technician->user_name;
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
    // Obtiene el cliente de una órden de servicio
    public function get_client($code)
    {
        $client = Service::join("mov_services as ms", "ms.service_id", "services.id")
        ->join("movimientos as m", "m.id", "ms.movimiento_id")
        ->join("cliente_movs as cm", "cm.movimiento_id", "m.id")
        ->join("clientes as c", "c.id", "cm.cliente_id")
        ->select("c.nombre as name_client")
        ->where("services.order_service_id", $code)
        ->first();
        return $client->name_client;
    }
    // Redirecciona para crear una Nueva Órden de Servicio Eliminando Variables de Sesion
    public function go_new_service_order()
    {
        session(["od" => null]);
        session(["clie" => null]);
        session(["tservice" => null]);
        $this->redirect("service");
    }
}
