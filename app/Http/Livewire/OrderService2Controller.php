<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\CarteraMov;
use App\Models\CatProdService;
use App\Models\ClienteMov;
use App\Models\Movimiento;
use App\Models\MovService;
use App\Models\OrderService;
use App\Models\Permission;
use App\Models\Service;
use App\Models\SubCatProdService;
use App\Models\SucursalUser;
use App\Models\TypeWork;
use App\Models\User;
use Carbon\Carbon;
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
    //Guarda el id de la sucursal del usuario autenticado
    public $id_branch;
    //Guarda true o false dependiendo si el usuario aperturo caja
    public $box_status;
    //Guarda una lista con todas las carteras que esten en el corte de caja
    public $list_wallets;
    //Guarda una lista de tipos de Trabajo
    public $list_type_work;
    //Guarda una lista de categorias de equipos
    public $list_category;
    //Guarda una lista de las marcas de los productos
    public $list_marks;

    //Guarda Información de un servicio
    public $s_client_name, $s_client_cell, $s_client_phone, $s_details, $s_cps, $s_mark, $s_model_detail, $s_solution, $s_id_user_technicial,
    $s_price,$s_cost, $s_cost_detail, $s_on_account, $s_id_wallet, $s_type_work, $s_fail_client, $s_diagnostic, $s_balance, $s_id_type_work,
    $s_id_category, $s_estimated_delivery_date, $s_estimated_delivery_time;

    use WithPagination;
    public function paginationView()
    {
        return "vendor.livewire.bootstrap";
    }
    public function mount()
    {
        $this->pagination = 20;
        //Obteniendo el id de la sucursal del usuario autenticado
        $this->id_branch = SucursalUser::where("user_id", Auth()->user()->id)->where("estado", "ACTIVO")->first()->sucursal_id;
        $this->box_status = false;
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
    // Devuelve servicios de una orden de servicio
    public function get_service_order_detail($code)
    {
        $services = Service::join("mov_services as ms", "ms.service_id","services.id")
        ->join("movimientos as m", "m.id", "ms.movimiento_id")
        ->join('cat_prod_services as cps', 'cps.id', 'services.cat_prod_service_id')
        ->select("services.id as idservice","services.created_at as created_at", DB::raw("0 as responsible_technician"), DB::raw("0 as receiving_technician"),
        "m.import as price_service","m.type as type","cps.nombre as name_cps",'services.marca as mark','services.detalle as detail','services.falla_segun_cliente as client_fail')
        ->where("services.order_service_id", $code)
        ->where("m.status", "ACTIVO")
        ->orderBy("services.id","asc")
        ->get();
        foreach ($services as $s)
        {
            if($s->type != "PENDIENTE")
            {
                //Obtener al tecnico responsable de un servicio
                $s->responsible_technician = $this->get_responsible_technician($s->idservice)->name;
            }
            else
            {
                //Obtener al tecnico responsable de un servicio
                $s->responsible_technician = "No Asignado";
            }
            //Obtener al técnico receptor de un servicio
            $s->receiving_technician = $this->get_receiving_technician($s->idservice);
        }
        return $services;
    }
    // Devuelve un objeto de un Usuario Técnico Responsable o Recepcionista a travéz del id de un servicio
    public function get_responsible_technician($idservice)
    {
        $technician = MovService::join("movimientos as m", "m.id","mov_services.movimiento_id")
        ->join("users as u", "u.id", "m.user_id")
        ->select("u.*")
        ->where("mov_services.service_id", $idservice)
        ->where("m.status", "ACTIVO")
        ->orderBy("m.id", "desc")
        ->get();
        return $technician = $technician->first();
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
    public function filter_type(Service $service, $type)
    {
        $this->id_order_service = $service->order_service_id;
        $this->id_service = $service->id;
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
            $client = $this->get_client($service->order_service_id);
            $this->s_client_name = $client->nombre;
            $this->s_client_cell = $client->celular;
            $this->s_client_phone = $client->telefono;
            if($type == "PROCESO")
            {
                //Actualizando la lista de usuarios tecnicos para el servicio
                $permission = Permission::where('name', 'Aparecer_Lista_Servicios')->first();
                $this->list_user_technicial = $permission->usersWithPermission('Aparecer_Lista_Servicios');

                $service = $this->get_details_Service($service->id);

                $this->s_cps = $service->name_cps;
                $this->s_mark = $service->mark;
                $this->s_model_detail = $service->detail;
                $this->s_solution = $service->solution;
                $this->s_price = $service->price_service;
                $this->s_cost = $service->cost;
                $this->s_cost_detail = $service->cost_detail;
                $this->s_id_user_technicial = $this->get_responsible_technician($service->idservice)->id;
                //Mostrando la ventana modal
                $this->emit("show-terminated-service");
            }
            else
            {
                if($type == "TERMINADO")
                {
                    $service = $this->get_details_Service($service->id);
                    $this->s_price = $service->price_service;
                    $this->s_on_account = $service->on_account;

                    $box = Caja::join('carteras as car', 'cajas.id', 'car.caja_id')
                    ->join('cartera_movs as cartmovs', 'car.id', 'cartmovs.cartera_id')
                    ->join('movimientos as mov', 'mov.id', 'cartmovs.movimiento_id')
                    ->where('cajas.estado', 'Abierto')
                    ->where('mov.user_id', Auth()->user()->id)
                    ->where('mov.status', 'ACTIVO')
                    ->where('mov.type', 'APERTURA')
                    ->where('cajas.sucursal_id', $this->id_branch)
                    ->select('cajas.*')
                    ->first();
                    if($box)
                    {
                        $this->box_status = true;
                        $this->list_wallets = Cartera::where("caja_id", $box->id)
                        ->where("estado", "ACTIVO")
                        ->where("tipo","<>", "Sistema")
                        ->where("tipo","<>", "Telefono")
                        ->orwhere("caja_id", 1)
                        ->orderBy("id","asc")
                        ->get();

                        $this->s_id_wallet = $this->list_wallets->where("tipo","efectivo")->first()->id;
                    }


                    $this->emit("show-deliver-service");
                }
            }
        }
    }
    // Muestra una ventana modal para editar dependiendo del tipo de servicio
    public function filter_edit(Service $service, $type)
    {
        $this->id_order_service = $service->order_service_id;
        $this->id_service = $service->id;
        if($type != "ENTREGADO")
        {
            $client = $this->get_client($service->order_service_id);
            $this->s_client_name = $client->nombre;
            $this->s_client_cell = $client->celular;
            $this->s_client_phone = $client->telefono;


            $this->list_type_work = TypeWork::where("status","ACTIVE")->orderBy('name', 'asc')->get();
            $this->list_category = CatProdService::where("estado","ACTIVO")->orderBy('nombre', 'asc')->get();
            $this->list_marks = SubCatProdService::where("status", "ACTIVE")->orderBy('name', 'asc')->get();
            //Actualizando la lista de usuarios tecnicos para el servicio
            $permission = Permission::where('name', 'Aparecer_Lista_Servicios')->first();
            $this->list_user_technicial = $permission->usersWithPermission('Aparecer_Lista_Servicios');

            $service = $this->get_details_Service($service->id);
            
            $this->s_cps = $service->name_cps;

            $this->s_mark = $service->mark;
            $this->s_model_detail = $service->detail;
            $this->s_fail_client = $service->client_fail;
            $this->s_diagnostic = $service->diagnostic;
            $this->s_solution = $service->solution;
            $this->s_price = $service->price_service;
            $this->s_on_account = $service->on_account;
            $this->s_balance = $service->balance;
            $this->s_cost = $service->cost;
            $this->s_cost_detail = $service->cost_detail;
            $this->s_id_type_work = $service->idtypework;
            $this->s_id_category = $service->idcategory;
            $this->s_estimated_delivery_date = Carbon::parse($service->estimated_delivery_date)->format('Y-m-d');
            $this->s_estimated_delivery_time = Carbon::parse($service->estimated_delivery_date)->format('H:i');
            $this->s_id_user_technicial = $this->get_responsible_technician($service->idservice)->id;

            $this->emit("show-edit-service");
        }
        else
        {
            dd("Servicio entregado");
        }
    }
    //Obtiene detalles de un servicio
    public function get_details_Service($idservice)
    {
        $services = Service::join("mov_services as ms", "ms.service_id","services.id")
        ->join("movimientos as m", "m.id", "ms.movimiento_id")
        ->join("cat_prod_services as cps", "cps.id", "services.cat_prod_service_id")
        ->join("type_works as tw","tw.id","services.type_work_id")
        ->select("services.created_at as created_at", "m.import as price_service","m.type as type","m.on_account as on_account","m.saldo as balance",
        "cps.nombre as name_cps","services.marca as mark","services.detalle as detail","services.solucion as solution", "m.user_id as id_user_technicial",
        "services.falla_segun_cliente as client_fail","services.costo as cost","services.detalle_costo as cost_detail","services.diagnostico as diagnostic",
        "m.saldo as balance","tw.id as idtypework","cps.id as idcategory", "services.fecha_estimada_entrega as estimated_delivery_date", "services.id as idservice")
        ->where("services.id", $idservice)
        ->where("m.status","ACTIVO")
        ->first();
        return $services;
    }
    //Asigna servicio a técnico (Pasa un Servicio de PENDIENTE A PROCESO)
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
        $motion->save();
        $this->emit("hide-assign-technician");
    }
    //Termina un servicio (Pasa un Servicio de PROCESO A TERMINADO)
    public function terminated_service(Service $service)
    {
        //Buscando el movimiento PROCESO
        $motion_process = MovService::join("movimientos as m","m.id","mov_services.movimiento_id")
        ->where("mov_services.service_id", $service->id)
        ->where("m.type", "PROCESO")
        ->select("m.*")
        ->first();

        //CREANDO EL SERVICIO EN TERMINADO
        $motion_terminated = Movimiento::create([
            'type' => 'TERMINADO',
            'status' => 'ACTIVO',
            'import' => $this->s_price,
            'on_account' => $motion_process->on_account,
            'saldo' => $motion_process->saldo,
            'user_id' =>  $this->s_id_user_technicial,
        ]);
        MovService::create([
            'movimiento_id' => $motion_terminated->id,
            'service_id' => $service->id
        ]);
        //Obteniendo un objeto de los datos del cliente
        $client = $this->get_client($service->order_service_id);
        ClienteMov::create([
            'movimiento_id' => $motion_terminated->id,
            'cliente_id' => $client->id
        ]);
        $motion = Movimiento::find($motion_process->id);
        //Actualizando el estado del movimiento PROCESO
        $motion->update([
            'status' => 'INACTIVO'
        ]);
        $motion->save();
        //Actualizando el servicio
        $service->update([
            'solucion' => $this->s_solution,
            'costo' => $this->s_cost,
            'detalle_costo' => $this->s_cost_detail
        ]);
        $service->save();
        //Cerrando la ventana modal
        $this->emit("hide-terminated-service");
    }
    //Entrega un Servicio (Pasa un Servicio de TERMINADO a ENTREGADO)
    public function deliver_service(Service $service)
    {
        $motion_deliver = Movimiento::create([
            'type' => 'ENTREGADO',
            'status' => 'ACTIVO',
            'import' => $this->s_price,
            'on_account' => $this->s_on_account,
            'saldo' => $this->s_price - $this->s_on_account,
            'user_id' => Auth()->user()->id,
        ]);
        CarteraMov::create([
            'type' => 'INGRESO',
            'tipoDeMovimiento' => 'SERVICIOS',
            'comentario' => '',
            'cartera_id' => $this->s_id_wallet,
            'movimiento_id' => $motion_deliver->id
        ]);
        MovService::create([
            'movimiento_id' => $motion_deliver->id,
            'service_id' => $service->id
        ]);
        //Obteniendo un objeto de los datos del cliente
        $client = $this->get_client($service->order_service_id);
        ClienteMov::create([
            'movimiento_id' => $motion_deliver->id,
            'cliente_id' => $client->id
        ]);


        //Buscando el movimiento PROCESO
        $motion_terminated = MovService::join("movimientos as m","m.id","mov_services.movimiento_id")
        ->where("mov_services.service_id", $service->id)
        ->where("m.type", "TERMINADO")
        ->select("m.*")
        ->first();

        $motion = Movimiento::find($motion_terminated->id);
        //Actualizando el estado del movimiento PROCESO
        $motion->update([
            'status' => 'INACTIVO'
        ]);
        $motion->save();

        $this->emit("hide-deliver-service");
    }
    protected $listeners = [
    'updateorderservice' => 'update_order_service',
    ];
    //Actualiza detalles generales de un servicio
    public function update_order_service($mark)
    {

        dd($mark . " : ". $this->s_price);
        // $service->update([
        //     'detalle' => '',
        //     'marca' => '',
        //     'falla_segun_cliente' => '',
        //     'diagnostico' => '',
        //     'solucion' => '',
        //     'costo' => '',
        //     'detalle_costo' => '',
        //     'fecha_estimada_entrega' => '',
        //     'cat_prod_service_id' => '',
        //     'type_work_id' => '',
        //     'sucursal_id' => ''
        // ]);
        // $service->save();
    }
}
