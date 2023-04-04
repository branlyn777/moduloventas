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

class OrderServiceController extends Component
{   
    //Guarda el numero de paginacion de la tabla ordenes de servicio
    public $pagination;
    //Guarda una lista de posibles usuarios tecnicos responsables
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
    //Guarda un tipo de servcio (PENDIENTE, PROCESO, TERMINADO, ENTREGADO) para la ventana modal detalle servicio
    public $status_service;
    //Guarda el mensaje que se vera en un toast
    public $message_toast;

    //Variebles para los filtros
    public $search, $search_all, $status_service_table;
    

    //Guarda Información de un servicio
    public $s_client_name, $s_client_cell, $s_client_phone, $s_details, $s_cps, $s_mark, $s_model_detail, $s_solution, $s_id_user_technicial,
    $s_price,$s_cost, $s_cost_detail, $s_on_account, $s_id_wallet, $s_type_work, $s_fail_client, $s_diagnostic, $s_balance, $s_id_type_work,
    $s_id_category, $s_estimated_delivery_date, $s_estimated_delivery_time, $s_name_type_work, $s_name_user_technicial, $s_name_type_service;

    use WithPagination;
    public function paginationView()
    {
        return "vendor.livewire.bootstrap";
    }
    public function mount()
    {
        $this->status_service_table = "PENDIENTE";
        $this->search_all = false;
        $this->pagination = 20;
        //Obteniendo el id de la sucursal del usuario autenticado
        $this->id_branch = SucursalUser::where("user_id", Auth()->user()->id)->where("estado", "ACTIVO")->first()->sucursal_id;
        //Guarda true si el usuario realizó corte de caja
        $this->box_status = false;
    }
    public function render()
    {
        if(strlen($this->search) == 0)
        {
            if($this->status_service_table == "TODOS")
            {
                //Consulta para obtener la lista de órdenes de servicio ordenados por fecha de creación
                $service_orders = OrderService::select(
                    "order_services.id as code",
                    "order_services.created_at as reception_date",
                    DB::raw("0 as services"),
                    DB::raw("0 as client"),
                    DB::raw("0 as number")
                )
                ->where("order_services.status", "ACTIVO")
                ->orderBy("order_services.id", "desc")
                ->paginate($this->pagination);
            }
            else
            {
                $service_orders = Service::join("mov_services as ms","ms.service_id","services.id")
                ->join("movimientos as m","m.id","ms.movimiento_id")
                ->join("order_services as os","os.id","services.order_service_id")
                ->select(
                        "os.id as code",
                        "os.created_at as reception_date",
                        "m.type as estado_movimiento",
                        DB::raw("0 as services"),
                        DB::raw("0 as client"),
                        DB::raw("0 as number")
                    )
                ->where("m.type", $this->status_service_table)
                ->where("os.status", "ACTIVO")
                ->where("m.status", "ACTIVO")
                ->distinct()
                ->orderBy("os.id", "desc")
                ->paginate($this->pagination);

            }
        }
        else
        {
            // Poniendo el numero de la paginacion en 1 cuando empieze a buscar
            if(strlen($this->search) == 1 || strlen($this->search) == 2)
            {
                $this->gotoPage(1);
            }
            //Consulta para obtener la lista de órdenes de servicio ordenados por fecha de creación
            $service_orders = Service::join("order_services as os","os.id","services.order_service_id")
            ->join("mov_services as ms","ms.service_id", "services.id")
            ->join("movimientos as m","m.id", "ms.movimiento_id")
            ->join("cliente_movs as cm","cm.movimiento_id", "m.id")
            ->join("clientes as c","c.id", "cm.cliente_id")
            ->select(
                "os.id as code",
                "os.created_at as reception_date",
                DB::raw("0 as services"),
                DB::raw("0 as client"),
                DB::raw("0 as number")
            )
            ->where("os.status", "ACTIVO")
            ->where("os.id", $this->search)
            ->when($this->search_all, function($query) {
                return $query->orWhere('c.nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('c.celular', 'like', '%' . $this->search . '%')
                    ->orWhere('c.telefono', 'like', '%' . $this->search . '%')
                    ->orWhere('services.detalle', 'like', '%' . $this->search . '%');
            })
            ->distinct()
            ->orderBy("os.id", "desc")
            ->paginate(200);

        }
        $row_number = ($service_orders->currentPage() - 1) * $service_orders->count();
        foreach ($service_orders as $so)
        {
            if(strlen($this->search) == 0)
            {
                if($this->status_service_table == "TODOS")
                {
                    //Obtener los servicios de la orden de servicio
                    $so->services = $this->get_service_order_detail($so->code);
                }
                else
                {
                    //Obtener los servicios de la orden de servicio
                    $so->services = $this->get_service_order_detail_type($so->code,$this->status_service_table);
                }
                //Obtener el nombre del cliente
                $so->client = $this->get_client($so->code);
    
                //Poniendo la numeración para la paginación
                $row_number++;
                $so->number = $row_number;
            }
            else
            {
                //Obtener los servicios de la orden de servicio
                $so->services = $this->get_service_order_detail($so->code);
                //Obtener el nombre del cliente
                $so->client = $this->get_client($so->code);
    
                //Poniendo la numeración para la paginación
                $row_number++;
                $so->number = $row_number;
            }

        }
        return view("livewire.order_service.orderservice", [
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
                //Si el servicio es PENDIENTE no tendrá un técnico responsable
                $s->responsible_technician = "No Asignado";
            }
            //Obtener al técnico receptor de un servicio
            $s->receiving_technician = $this->get_receiving_technician($s->idservice);
        }
        return $services;
    }
    // Devuelve servicios específicos de una orden de servicio (PENDIENTE, PROCESO, TERMINADO, ENTREGADO, ANULADO)
    public function get_service_order_detail_type($code, $type)
    {
        $services = Service::join("mov_services as ms", "ms.service_id","services.id")
        ->join("movimientos as m", "m.id", "ms.movimiento_id")
        ->join('cat_prod_services as cps', 'cps.id', 'services.cat_prod_service_id')
        ->select("services.id as idservice","services.created_at as created_at", DB::raw("0 as responsible_technician"), DB::raw("0 as receiving_technician"),
        "m.import as price_service","m.type as type","cps.nombre as name_cps",'services.marca as mark','services.detalle as detail','services.falla_segun_cliente as client_fail')
        ->where("services.order_service_id", $code)
        ->where("m.status", "ACTIVO")
        ->where("m.type", $type)
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
        ->select("u.*","m.type as type")
        ->where("mov_services.service_id", $idservice)
        ->where("m.status", "ACTIVO")
        ->whereNotIn("m.type", ["PENDIENTE", "ENTREGADO"])
        ->orderBy("m.id", "desc")
        ->get();

        if($technician->count() == 0)
        {
            $technician = MovService::join("movimientos as m", "m.id","mov_services.movimiento_id")
            ->join("users as u", "u.id", "m.user_id")
            ->select("u.*","m.type as type")
            ->where("mov_services.service_id", $idservice)
            ->where("m.type", "TERMINADO")
            ->orderBy("m.id", "desc")
            ->get();
            if($technician->count() == 0)
            {
                $technician = MovService::join("movimientos as m", "m.id","mov_services.movimiento_id")
                ->join("users as u", "u.id", "m.user_id")
                ->select("u.*","m.type as type")
                ->where("mov_services.service_id", $idservice)
                ->where("m.type", "PENDIENTE")
                ->orderBy("m.id", "desc")
                ->get();
            }
        }

        return $technician = $technician->first();
    }
    // Obtiene nombre Técnico Receptor a travéz del id de un servicio
    public function get_receiving_technician($idservice)
    {
        $technician = MovService::join("movimientos as m", "m.id","mov_services.movimiento_id")
        ->join("users as u", "u.id", "m.user_id")
        ->select("u.name as user_name")
        ->where("mov_services.service_id", $idservice)
        ->where("m.type","PENDIENTE")
        ->first();
        if($technician)
        {
            return $technician->user_name;
        }
        return $idservice;

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
                if($this->s_cost == "0")
                {
                    $this->s_cost = "";
                }
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
                else
                {
                    if($type == "ALMACENADO")
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

            //Actualizando la lista de usuarios tecnicos para el servicio
            $permission = Permission::where('name', 'Aparecer_Lista_Servicios')->first();
            $this->list_user_technicial = $permission->usersWithPermission('Aparecer_Lista_Servicios');

            //Obteniendo detalles del servicio para actualizar las varibles antes de editar
            $service = $this->get_details_Service($service->id);
            
            
            //Actualizando las listas de los distintos combos para editar
            $this->list_type_work = TypeWork::where("status","ACTIVE")->orderBy("name", "asc")->get();
            $this->list_category = CatProdService::where("estado","ACTIVO")->orderBy("nombre", "asc")->get();
            $this->list_marks = SubCatProdService::where("status", "ACTIVE")->orderBy('name', 'asc')->get();
            $this->emit('marks-loaded', $this->list_marks); /* Emitiendo para que un evento JavaScript carge todas las marcas en un input con buscador id="product-input" */


            $this->s_cps = $service->name_cps;

            $this->s_mark = $service->mark;
            $this->s_model_detail = $service->detail;
            $this->s_fail_client = $service->client_fail;
            $this->s_diagnostic = $service->diagnostic;
            $this->s_solution = $service->solution;
            $this->s_price = $service->price_service;
            $this->s_on_account = $service->on_account;
            $this->s_balance = $service->balance;
            if( $service->cost == "0.00")
            {
                $this->s_cost = "";
            }
            else
            {
                $this->s_cost = $service->cost;
            }
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
            //Actualizando la lista de usuarios tecnicos para el servicio
            $permission = Permission::where('name', 'Aparecer_Lista_Servicios')->first();
            $this->list_user_technicial = $permission->usersWithPermission('Aparecer_Lista_Servicios');

            $this->s_id_user_technicial = $this->get_responsible_technician($service->id)->id;


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
                $this->list_wallets = Cartera::where("estado", "ACTIVO")
                ->where("tipo","<>", "Sistema")
                ->where("tipo","<>", "Telefono")
                ->orwhere("caja_id", 1)
                ->orderBy("id","asc")
                ->get();

                $this->s_id_wallet = $this->list_wallets->where("tipo","efectivo")->first()->id;
            }
            if( $service->cost == "0.00")
            {
                $this->s_cost = "";
            }
            else
            {
                $this->s_cost = $service->cost;
            }
            $this->s_cost_detail = $service->cost_detail;

            //Obteniendo detalles del servicio para actualizar las varibles antes de editar el servicio TERMINADO
            $service = $this->get_details_Service($service->id);
            $this->s_price = $service->price_service;
            $this->s_on_account = $service->on_account;
            $this->s_balance = $service->balance;

            $this->emit("show-edit-service-deliver");
        }
    }
    //Obtiene detalles de un servicio
    public function get_details_Service($idservice)
    {
        $services = Service::join("mov_services as ms", "ms.service_id","services.id")
        ->join("movimientos as m", "m.id", "ms.movimiento_id")
        ->join("cat_prod_services as cps", "cps.id", "services.cat_prod_service_id")
        ->join("type_works as tw","tw.id","services.type_work_id")
        ->select("services.created_at as created_at", "m.import as price_service","m.type as type","m.on_account as on_account","m.saldo as balance", "m.id as idmotion",
        "cps.nombre as name_cps","services.marca as mark","services.detalle as detail","services.solucion as solution", "m.user_id as id_user_technicial",
        "services.falla_segun_cliente as client_fail","services.costo as cost","services.detalle_costo as cost_detail","services.diagnostico as diagnostic",
        "m.saldo as balance","tw.id as idtypework", "tw.name as name_typework","cps.id as idcategory", "services.fecha_estimada_entrega as estimated_delivery_date", "services.id as idservice")
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
        $rules = [
            's_price' => 'required'
        ];
        if ($this->s_cost != null)
        {
            $rules['s_cost_detail'] = 'required';
        }
        $messages = [
            's_price.required'=> 'Precio Requerido',
            's_cost_detail.required'=> 'Detalla el motivo del costo'
        ];
        $this->validate($rules, $messages);
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
    // Entrega un Servicio (Pasa un Servicio de TERMINADO a ENTREGADO)
    public function deliver_service(Service $service)
    {
        $rules = [
            's_price' => 'required'
        ];
        $messages = [
            's_price.required'=> 'Precio Requerido'
        ];
        $this->validate($rules, $messages);
        if($this->s_on_account == "")
        {
            $this->s_on_account = 0;
        }
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





        //Buscando el movimiento ALMACENADO (en caso de que el servicio este ALMACENADO)
        $motion_storage = MovService::join("movimientos as m","m.id","mov_services.movimiento_id")
        ->where("mov_services.service_id", $service->id)
        ->where("m.type", "ALMACENADO")
        ->where("m.status", "ACTIVO")
        ->select("m.*")
        ->get();

        if($motion_storage->count() > 0)
        {
            $motion = Movimiento::find($motion_storage->first()->id);
            //Actualizando el estado del movimiento ALMACENADO
            $motion->update([
                'status' => 'INACTIVO'
            ]);
            $motion->save();
        }
        else
        {
            //Buscando el movimiento TERMINADO
            $motion_terminated = MovService::join("movimientos as m","m.id","mov_services.movimiento_id")
            ->where("mov_services.service_id", $service->id)
            ->where("m.type", "TERMINADO")
            ->select("m.*")
            ->first();

            $motion = Movimiento::find($motion_terminated->id);
            //Actualizando el estado del movimiento TERMINADO
            $motion->update([
                'status' => 'INACTIVO'
            ]);
            $motion->save();
        }




        








        //Actualizando el saldo de cartera
        $wallet = Cartera::find($this->s_id_wallet);
        $balance_wallet = $wallet->saldocartera + $this->s_price + $this->s_on_account;
        $wallet->update([
            'saldocartera' => $balance_wallet
        ]);
        $wallet->save();


        $this->emit("hide-deliver-service");
    }
    // Muestra una ventana modal con los detalles de un servicio
    public function show_modal_detail(Service $service)
    {
        $this->id_order_service = $service->order_service_id;
        $this->id_service = $service->id;

        $this->s_name_type_service = OrderService::find($service->order_service_id)->type_service;

        //Obteniendo detalles del cliente
        $client = $this->get_client($service->order_service_id);
        $this->s_client_name = $client->nombre;
        $this->s_client_cell = $client->celular;
        $this->s_client_phone = $client->telefono;

        //Obteniendo detalles del servicio
        $service = $this->get_details_Service($service->id);
        $this->status_service = $service->type;
        
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
        $this->s_name_type_work = $service->name_typework;
        $this->s_estimated_delivery_date = Carbon::parse($service->estimated_delivery_date)->format('d-m-Y H:i');
        // $this->s_name_user_technicial = $this->get_responsible_technician($service->idservice)->name;

        $this->emit("show-detail-service");
    }
    // Redirige para modificar una Orden de Servicio
    public function modify_order_service(OrderService $orderservice)
    {
        session(['clie' => $this->get_client($orderservice->id)]);
        session(['od' => $orderservice->id]);
        session(['tservice' => $orderservice->type_service]);
        $this->redirect('service');
    }
    // Actualiza detalles generales de un servicio ENTREGADO
    public function update_service_deliver()
    {
        $rules = [
            's_price' => 'required'
        ];
        if ($this->s_cost != null)
        {
            $rules['s_cost_detail'] = 'required';
        }
        $messages = [ 
            's_price.required' => 'Campo Requerido',
            's_cost_detail.required' => 'Detalla el motivo del costo'        
        ];
        $this->validate($rules, $messages);
        if($this->s_on_account == "")
        {
            $this->s_on_account = 0;
        }
        // Actualizando saldo, a cuenta, precio y usuario técnico del servicio
        $motion_deliver = Movimiento::find($this->get_details_Service($this->id_service)->idmotion);
        //Guardando el precio del servicio anterior
        $previous_price = $motion_deliver->import;
        //Actualizando
        $motion_deliver->update([
            'saldo' => $this->s_price - $this->s_on_account,
            'on_account' => $this->s_on_account,
            'import' => $this->s_price,
        ]);
        $motion_deliver->save();


        


        //Cambiando el tipo de pago
        $movement_wallet = CarteraMov::where("cartera_movs.movimiento_id",$motion_deliver->id)->first();
        //Guardando el id de la cartera anterior
        $walletid = $movement_wallet->cartera_id;
        //Actualizando
        $movement_wallet->update([
            'cartera_id' => $this->s_id_wallet
        ]);
        $movement_wallet->save();


        
        //Disminuyendo
        $wallet_previus = Cartera::find($walletid);
        $balance_wallet = $wallet_previus->saldocartera - $previous_price;
        $wallet_previus->update([
            'saldocartera' => $balance_wallet
        ]);
        $wallet_previus->save();

        if($this->s_cost == null)
        {
            $this->s_cost = "0";
        }
        $service = Service::find($this->id_service);
        $service->update([
            'costo' => $this->s_cost,
            'detalle_costo' => $this->s_cost_detail
        ]);
        $service->save();
        //Buscando el movimiento TERMINADO inactivo (Que es donde se almacena el id del técnico responsable)
        $motion_terminated = MovService::join("movimientos as m","m.id","mov_services.movimiento_id")
        ->select("m.*")
        ->where("mov_services.service_id",$this->id_service)
        ->where("m.type","TERMINADO")
        ->first();
        $motion_terminated = Movimiento::find($motion_terminated->id);
        $motion_terminated->update([
            'user_id' => $this->s_id_user_technicial
        ]);
        $motion_terminated->save();




         //Aumentando
         $wallet = Cartera::find($this->s_id_wallet);
         $balance_wallet = $wallet->saldocartera + $this->s_price + $this->s_on_account;
         $wallet->update([
             'saldocartera' => $balance_wallet
         ]);
         $wallet->save();

        $this->emit("hide-edit-service-deliver");
    }
    protected $listeners = [
        'updateservice' => 'update_service',
        'annularservice' => 'annular_service',
        'deleteservice' => 'delete_service',
        'storeservice' => 'storage_service'
    ];
    // Actualiza detalles generales de un servicio
    public function update_service($mark)
    {
        $rules = [
            's_model_detail' => 'required',
            's_fail_client' => 'required',
            's_diagnostic' => 'required',
            's_solution' => 'required',
            's_price' => 'required',
            's_on_account' => 'required'
        ];
        if ($this->s_cost != null)
        {
            $rules['s_cost_detail'] = 'required';
        }
        $messages = [
            's_model_detail.required' => 'Campo Requerido',   
            's_fail_client.required' => 'Campo Requerido',   
            's_diagnostic.required' => 'Campo Requerido',   
            's_solution.required' => 'Campo Requerido',   
            's_price.required' => 'Campo Requerido',   
            's_on_account.required' => 'Campo Requerido',
            's_cost_detail.required' => 'Detalla el motivo del costo'        
        ];
        $this->validate($rules, $messages);
        //Buscando la Marca seleccionada
        $mark_selected = SubCatProdService::where("name", $mark)->first();
        //Creando una nueva marca si no existe
        if(!$mark_selected) 
        {
            SubCatProdService::create([
                'name' => ucwords(strtolower($mark)),
                'cat_prod_service_id' => $this->s_id_category
            ]);
        }
        // Actualizando saldo, a cuenta, precio y usuario técnico del servicio
        $motion = Movimiento::find($this->get_details_Service($this->id_service)->idmotion);
        $motion->update([
            'saldo' => $this->s_price - $this->s_on_account,
            'on_account' => $this->s_on_account,
            'import' => $this->s_price,
            'user_id' => $this->s_id_user_technicial,
        ]);
        $motion->save();

        $service = Service::find($this->id_service);
        $service->update([
            'detalle' => $this->s_model_detail,
            'marca' => ucwords(strtolower($mark)),
            'falla_segun_cliente' => $this->s_fail_client,
            'diagnostico' => $this->s_diagnostic,
            'solucion' => $this->s_solution,
            'costo' => $this->s_cost,
            'detalle_costo' => $this->s_cost_detail,
            'fecha_estimada_entrega' => $this->s_estimated_delivery_date . " " . $this->s_estimated_delivery_time,
            'cat_prod_service_id' => $this->s_id_category,
            'type_work_id' => $this->s_id_type_work
        ]);
        $service->save();
        $this->emit("hide-edit-service");
    }
    // Anula una orden de servico
    public function annular_service(OrderService $orderservice)
    {
        foreach ($orderservice->services as $s)
        {
            //Verificando que la orden de servicio no tenga servicios con estado TERMINADO o ENTREGADO
            foreach ($s->movservices as $mm)
            {
                if(($mm->movs->status == 'ACTIVO') && ($mm->movs->type == 'TERMINADO' || $mm->movs->type == 'ENTREGADO'))
                {
                    $this->emit('delivered-finished');
                    return;
                }
            }
            //Si la orden de servicio cumple con la condición anterior se anula todo
            foreach ($s->movservices as $mm)
            {
                if ($mm->movs->status == 'ACTIVO')
                {
                    $mm->movs->update([
                        'type' => 'ANULADO',
                        'status' => 'INACTIVO'
                    ]);
                    $mm->movs->save();
                }
            }
        }
        $orderservice->update([
            'status' => 'INACTIVO'
        ]);
        $orderservice->save();
        $this->message_toast = "¡Todos los servicios de la Órden N: " . $orderservice->id . " fueron anulados!";
        $this->emit("message-toast");
    }
    // Elimina totalmente un servicio con sus tablas relacionadas
    public function delete_service(OrderService $orderservice)
    {
        DB::beginTransaction();
        try
        {
            $delete = true;
            foreach ($orderservice->services as $s)
            {
                foreach ($s->movservices as $mm)
                {
                    if(($mm->movs->status == 'ACTIVO') && ($mm->movs->type == 'TERMINADO' || $mm->movs->type == 'ENTREGADO'))
                    {
                        $delete = false;
                        break;
                    }
                }
                if($delete)
                {
                    foreach ($s->movservices as $mm)
                    {
                        $mm->movs->climov->delete();
                        $movimiento = $mm->movs;
                        $mm->delete();
                        $movimiento->delete();
                    }
                    $s->delete();
                }
            }

            if($delete)
            {
                $orderservicebackup = $orderservice;
                $orderservice->delete();
                $this->message_toast = "¡Todos los servicios de la Órden N: " . $orderservicebackup->id . " fueron eliminados!";
                $this->emit("message-toast");
            }
            else
            {
                $this->emit("delivered-finished");
            }

            DB::commit();

        }
        catch (Exception $e)
        {
            DB::rollback();
            dd($e->getMessage());
            $this->emit('item-error', 'ERROR' . $e->getMessage());
        }
    }
    // Almacena un servicio (Pasa un Servicio de TERMINADO a ALMACENADO)
    public function storage_service(Service $service)
    {
        //Obteniendo información del servicio
        $motion_terminated = $this->get_details_Service($service->id);

        $motion_storage = Movimiento::create([
            'type' => 'ALMACENADO',
            'status' => 'ACTIVO',
            'import' => $motion_terminated->price_service,
            'on_account' => $motion_terminated->on_account,
            'saldo' => $motion_terminated->balance,
            'user_id' => Auth()->user()->id,
        ]);
        MovService::create([
            'movimiento_id' => $motion_storage->id,
            'service_id' => $service->id
        ]);
        //Obteniendo un objeto de los datos del cliente
        $client = $this->get_client($service->order_service_id);
        ClienteMov::create([
            'movimiento_id' => $motion_storage->id,
            'cliente_id' => $client->id
        ]);


        //Buscando el movimiento TERMINADO
        $motion_terminated = MovService::join("movimientos as m","m.id","mov_services.movimiento_id")
        ->where("mov_services.service_id", $service->id)
        ->where("m.type", "TERMINADO")
        ->select("m.*")
        ->first();

        $motion = Movimiento::find($motion_terminated->id);
        //Actualizando el estado del movimiento TERMINADO
        $motion->update([
            'status' => 'INACTIVO'
        ]);
        $motion->save();
    }
}
