<?php

namespace App\Http\Livewire;

use App\Models\ClienteMov;
use App\Models\Movimiento;
use App\Models\MovService;
use App\Models\OrderService;
use App\Models\Permission;
use App\Models\Service;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class OrderService2Controller extends Component
{   
    //Guarda el numero de paginacion de la tabla ordenes de servicio
    public $pagination;
    // Almacena la lista de usuarios tecnicos
    public $list_user_technicial;
    //Guarda el coódigo(id) de una orden de servicio
    public $id_order_service;
    //Guarda el id de un id de servicio
    public $id_service;


    //Guarda Información de un servicio
    public $s_client_name, $s_client_cell, $s_client_phone, $s_details, $s_cps, $s_mark, $s_model_detail, $s_solution, $s_id_user_technicial,
    $s_price,$s_cost, $s_cost_detail;

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
            $so->services = $this->get_service_order_detail($so->code);
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
    public function get_service_order_detail($code)
    {
        $services = Service::join("mov_services as ms", "ms.service_id","services.id")
        ->join("movimientos as m", "m.id", "ms.movimiento_id")
        ->join('cat_prod_services as cps', 'cps.id', 'services.cat_prod_service_id')
        ->select("services.id as idservice","services.created_at as created_at", DB::raw("0 as responsible_technician"), DB::raw("0 as receiving_technician"),
        "m.import as price_service","m.type as type","cps.nombre as name_cps",'services.marca as mark','services.detalle as detail','services.falla_segun_cliente as client_fail')
        ->where("services.order_service_id", $code)
        ->where("m.status", "ACTIVO")
        ->get();
        foreach ($services as $s)
        {
            //Obtener al tecnico responsable de un servicio
            $s->responsible_technician = $this->get_responsible_technician($s->idservice)->user_name;
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
        ->select("u.name as user_name","u.id as user_id")
        ->where("mov_services.service_id", $idservice)
        ->where("m.status", "ACTIVO")
        ->where("m.type", "<>", "PENDIENTE")
        ->orderBy("m.id", "desc")
        ->get();

        if($technician->count() > 0)
        {
            $technician = $technician->first();
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
    // Redirecciona para crear una Nueva Órden de Servicio Eliminando Variables de Sesion
    public function go_new_service_order()
    {
        session(["od" => null]);
        session(["clie" => null]);
        session(["tservice" => null]);
        $this->redirect("service");
    }
    // Muestra una ventana modal dependiendo del tipo del servicio
    public function filter_type($idservice, $type)
    {
        $this->id_service = $idservice;
        if($type == "PENDIENTE")
        {
            //Actualizando la lista de usuarios tecnicos para el servicio
            $permission = Permission::where('name', 'Aparecer_Lista_Servicios')->first();
            $this->list_user_technicial = $permission->usersWithPermission('Aparecer_Lista_Servicios');
            //Mostrando la ventana modal
            $this->emit("show-assign-technician");
        }
        else
        {
            if($type == "PROCESO")
            {
                //Actualizando la lista de usuarios tecnicos para el servicio
                $permission = Permission::where('name', 'Aparecer_Lista_Servicios')->first();
                $this->list_user_technicial = $permission->usersWithPermission('Aparecer_Lista_Servicios');

                $service = Service::find($idservice);
                //Actualizando las variables para ser mostrados en la ventana modal
                $client = $this->get_client($service->order_service_id);
                $this->s_client_name = $client->nombre;
                $this->s_client_cell = $client->celular;
                $this->s_client_phone = $client->telefono;

                $service = $this->get_details_Service($idservice);

                $this->s_cps = $service->name_cps;
                $this->s_mark = $service->mark;
                $this->s_model_detail = $service->detail;
                $this->s_solution = $service->solution;
                $this->s_price = $service->price_service;
                $this->s_cost = $service->cost;
                $this->s_cost_detail = $service->cost_detail;
                $this->s_id_user_technicial = $service->id_user_technicial;
                dd($service->id_user_technicial);
                //Mostrando la ventana modal
                $this->emit("show-terminated-service");
            }
        }
    }
    //Obtiene detalles de un servicio
    public function get_details_Service($idservice)
    {
        $services = Service::join("mov_services as ms", "ms.service_id","services.id")
        ->join("movimientos as m", "m.id", "ms.movimiento_id")
        ->join('cat_prod_services as cps', 'cps.id', 'services.cat_prod_service_id')
        ->select("services.created_at as created_at", "m.import as price_service","m.type as type",
        "cps.nombre as name_cps",'services.marca as mark','services.detalle as detail','services.solucion as solution', "m.user_id as id_user_technicial",
        'services.falla_segun_cliente as client_fail','services.costo as cost','services.detalle_costo as cost_detail')
        ->where("services.id", $idservice)
        ->first();
        return $services;
    }
    //Asigna un servicio a un usuario seleccionado
    public function select_responsible_technician(Service $service, $iduser)
    {
        //Buscando el movimiento PENDIENTE
        $motion_pending = MovService::join("movimientos as m","m.id","mov_services.movimiento_id")
        ->where("mov_services.service_id", $service->id)
        ->where("m.type", "PENDIENTE")
        ->select("m.*")
        ->first();
        $motion_pending->save();
        //Obteniendo un objeto de los datos del cliente
        $client = $this->get_client($service->order_service_id);
        //Creando el movimiento PROCESO
        $motion_process = Movimiento::create([
            'type' => 'PROCESO',
            'status' => 'ACTIVO',
            'import' => $motion_pending->import,
            'on_account' => $motion_pending->on_account,
            'saldo' => $motion_pending->saldo,
            'user_id' =>  $iduser,
        ]);
        MovService::create([
            'movimiento_id' => $motion_process->id,
            'service_id' => $service->id
        ]);
        ClienteMov::create([
            'movimiento_id' => $motion_process->id,
            'cliente_id' => $client->id
        ]);
        
        $motion = Movimiento::find($motion_pending->id);
        //Actualizando el estado del movimiento PENDIENTE
        $motion->update([
            'status' => 'INACTIVO'
        ]);
        $this->emit("hide-assign-technician");
    }
}
