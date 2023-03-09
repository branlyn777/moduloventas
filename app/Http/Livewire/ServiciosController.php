<?php

namespace App\Http\Livewire;

use App\Models\ClienteMov;
use App\Models\Movimiento;
use App\Models\MovService;
use App\Models\OrderService;
use App\Models\CatProdService;
use App\Models\Cliente;
use App\Models\ProcedenciaCliente;
use App\Models\TypeWork;
use App\Models\User;
use App\Models\Service;
use App\Models\SubCatProdService;
use Carbon\Carbon;
use DateTime;
use Dompdf\Renderer\Text;
use Exception;
use FontLib\TrueType\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ServiciosController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $user, $cedula, $celular, $telefono, $orderservice, $hora_entrega,
        $movimiento, $typeworkid, $detalle, $categoryid, $from, $usuariolog, $catprodservid, $marc, $typeservice,
        $falla_segun_cliente, $diagnostico, $solucion, $saldo, $on_account, $import, $fecha_estimada_entrega,
        $search, $selected_id, $pageTitle, $service, $type_service, $procedencia, $cliente,
        $opciones, $estatus, $userId, $sucursal;
    private $pagination = 5;


    //Variables para un servico rápido
    public $fs_kind_of_team, $fs_mark, $fs_team_status, $fs_solution, $fs_import, $fs_technical_support, $service_order_id;
    //Guarda el id del cliente para el servicio
    public $client_id;

    public $name_client;


    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        //Servicio Rapido
        $this->fs_kind_of_team = "Elegir";
        $this->fs_technical_support = "Elegir";


        //-------------------



        $this->pageTitle = 'Detalle de la orden de servicio Noº: ';

        $this->categoryid = 'Elegir';
        $this->typeworkid = 'Elegir';
        $this->catprodservid = 'Elegir';
        $this->celular = '';
        $this->selected_id = 0;
        $this->marc = '';
        $this->diagnostico = 'Revisión';
        $this->solucion = 'Revisión';
        $this->typeservice = 'NORMAL';
        $this->type_service = 'NORMAL';
        $this->saldo = 0;
        $this->on_account = 0;
        $this->import = 0;
        $this->opciones = '';
        $this->from = Carbon::parse(Carbon::now())->format('d-m-Y  H:i');
        $this->fecha_estimada_entrega = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->estatus = '';
        $this->procedencia = "1";
        $this->userId = 0;
        $this->hora_entrega = Carbon::parse(Carbon::now())->format('H:i');
        $this->usuariolog = Auth()->user()->name;
        if (!empty(session('od'))) {
            $this->orderservice = session('od');
        }
        if (!empty(session('clie'))) {
            $this->cliente = session('clie');
        }
        if (!empty(session('tservice'))) {
            $this->typeservice = session('tservice');
            $this->type_service = session('tservice');
        }
    }
    public function render()
    {
        $client = [];
        if (strlen($this->search) > 0)
        {
            $client = Cliente::distinct()
            ->where("clientes.estado","ACTIVO")
            ->where(function ($query) {
            $query->where('clientes.nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('clientes.cedula', 'like', '%' . $this->search . '%');
            })
            ->paginate(30);
        }





        $user = User::find(Auth()->user()->id);
        foreach ($user->sucursalusers as $usersuc)
        {
            if ($usersuc->estado == 'ACTIVO')
            {
                $this->sucursal = $usersuc->sucursal->id;
            }
        }
        
        $services = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
            ->join('cat_prod_services as cat', 'cat.id', 'services.cat_prod_service_id')
            ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
            ->join('cliente_movs as cliemov', 'mov.id', 'cliemov.movimiento_id')
            ->join('clientes as c', 'c.id', 'cliemov.cliente_id')
            ->select('services.*', 'mov.type as tipo', 'mov.import as import', 'mov.saldo as saldo', 'mov.on_account as on_account', 'cat.nombre as category')->where('services.order_service_id',  $this->orderservice)
            ->where('mov.status',  'ACTIVO')
            ->orderBy('services.id', 'desc')
            ->paginate($this->pagination);

        $users = User::join('model_has_roles as mr', 'users.id', 'mr.model_id')
            ->join('roles as r', 'r.id', 'mr.role_id')
            ->join('role_has_permissions as rp', 'r.id', 'rp.role_id')
            ->join('permissions as p', 'p.id', 'rp.permission_id')
            ->join('sucursal_users as suu', 'users.id', 'suu.user_id')
            ->join('sucursals as suc', 'suc.id', 'suu.sucursal_id')
            ->where('p.name', 'Recepcionar_Servicio')
            ->where('suc.id', $this->sucursal)
            ->where('users.status','ACTIVE')
            /* ->where('r.name', 'TECNICO')
            ->orWhere('r.name', 'SUPERVISOR_TECNICO')
            ->where('p.name', 'Orden_Servicio_Index')
            ->orWhere('r.name', 'ADMIN')
            ->where('p.name', 'Orden_Servicio_Index') */
            ->select('users.*')
            ->orderBy('name', 'asc')
            ->distinct()
            ->get();
            
            if($this->userId == 0)
            {
                $this->userId = Auth()->user()->id;
            }
            

        $typew = TypeWork::orderBy('name', 'asc')->get();
        $dato1 = CatProdService::orderBy('nombre', 'asc')->get();

        if ($this->catprodservid != 'Elegir') {
            $marca = SubCatProdService::where('cat_prod_service_id', $this->catprodservid)
                ->orderBy('name', 'asc')
                ->get();
        } else {
            $marca = [];
        }


        $fs_marks = [];
        if($this->fs_kind_of_team != "Elegir")
        {
            $fs_marks = SubCatProdService::where('cat_prod_service_id', $this->fs_kind_of_team)
            ->orderBy('name', 'asc')
            ->get();
        }


        if ((strlen($this->import)) != 0 && (strlen($this->on_account) != 0))
            $this->saldo = $this->import - $this->on_account;
        elseif ((strlen($this->on_account) == 0))
            $this->saldo = $this->import;
        elseif ((strlen($this->import) == 0))
            $this->saldo = 0;

        

        return view('livewire.servicio.component', [
            'data' => $services,
            'work' => $typew,
            'cate' => $dato1,
            'marcas' => $marca,
            'fs_marks' => $fs_marks,
            'users' => $users,
            'client' => $client,
            'procedenciaClientes' => ProcedenciaCliente::orderBy('id', 'asc')->get()

        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    public function ResetSession()
    {
        /* $this->cliente = '';
        $this->orderservice = ''; */
        session(['od' => null]);
        session(['clie' => null]);
        session(['tservice' => null]);
        $this->redirect('orderservice');
    }
    //Store de Agregar Servicio
    public function Store()
    {
        if ($this->on_account <= $this->import) {
            $rules = [
                'typeworkid' => 'required|not_in:Elegir',
                'catprodservid' => 'required|not_in:Elegir',
                'marc' => 'required',
                'detalle' => 'required',
                'falla_segun_cliente' => 'required',
                'diagnostico' => 'required',
                'solucion' => 'required',
                'import' => 'required',
                'on_account' => 'required',
                'fecha_estimada_entrega' => 'required'
            ];
            $messages = [
                'typeworkid.required' => 'El Tipo de Trabajo es requerido',
                'typeworkid.not_in' => 'Seleccine una opción distinto a Elegir',
                'catprodservid.required' => 'El Tipo de Equipo es requerido',
                'catprodservid.not_in' => 'Seleccine una opción distinto a Elegir',
                'marc.required' => 'La Marca/Modelo es requerida',
                'detalle.required' => 'El Estado del Equipo es requerido',
                'falla_segun_cliente.required' => 'La Falla es requerida',
                'diagnostico.required' => 'El Diagnostico es requerido',
                'solucion.required' => 'La Solución es requerida',
                'import.required' => 'El Saldo es requerido',
                'on_account.required' => 'Si no desea ingresar nada ingrese "0"',
                'fecha_estimada_entrega.required' => 'La Fecha es requerida'
            ];

            $this->validate($rules, $messages);
        } else {
            $rules = [
                'typeworkid' => 'required|not_in:Elegir',
                'catprodservid' => 'required|not_in:Elegir',
                'marc' => 'required',
                'detalle' => 'required',
                'falla_segun_cliente' => 'required',
                'diagnostico' => 'required',
                'solucion' => 'required',
                'import' => 'required',
                'on_account' => 'required',
                'on_account' => 'required_with:import|lt:import',
                'import' => 'required_with:on_account',
                'fecha_estimada_entrega' => 'required'
            ];
            $messages = [
                'typeworkid.required' => 'El Tipo de Trabajo es requerido',
                'typeworkid.not_in' => 'Seleccine una opción distinto a Elegir',
                'catprodservid.required' => 'El Tipo de Equipo es requerido',
                'catprodservid.not_in' => 'Seleccine una opción distinto a Elegir',
                'marc.required' => 'La Marca/Modelo es requerida',
                'detalle.required' => 'El Estado del Equipo es requerido',
                'falla_segun_cliente.required' => 'La Falla es requerida',
                'diagnostico.required' => 'El Diagnostico es requerido',
                'solucion.required' => 'La Solución es requerida',
                'import.required' => 'El Saldo es requerido',
                'on_account.required' => 'Si no desea ingresar nada ingrese "0"',
                'import.required_with' => 'Ingrese un monto válido',
                'on_account.required_with' => 'Ingrese un monto válido.',
                'on_account.lt' => 'A cuenta no puede ser mayor al total',
                'fecha_estimada_entrega.required' => 'La Fecha es requerida'
            ];

            $this->validate($rules, $messages);
        }

        

        DB::beginTransaction();
        try {

            if ($this->orderservice == 0) {
                $neworder = OrderService::create([
                    'type_service' => $this->typeservice,
                ]);
            } else {
                $neworder = OrderService::find($this->orderservice);
            }

            $from = Carbon::parse($this->fecha_estimada_entrega)->format('Y-m-d') . " " . $this->hora_entrega . ':00';
            $newservice = Service::create([
                'type_work_id' => $this->typeworkid,
                'cat_prod_service_id' => $this->catprodservid,
                'marca' => $this->marc,
                'detalle' => $this->detalle,
                'falla_segun_cliente' => $this->falla_segun_cliente,
                'diagnostico' => $this->diagnostico,
                'solucion' => $this->solucion,
                'fecha_estimada_entrega' => $from,
                'order_service_id' => $neworder->id,
                'sucursal_id' => $this->sucursal
            ]);
            /* $services->update([
                'sucursal_id' => $this->sucursal
            ]); */
            $mv = Movimiento::create([
                'type' => 'PENDIENTE',
                'status' => 'ACTIVO',
                'import' => $this->import,
                'on_account' => $this->on_account,
                'saldo' => $this->saldo,
                'user_id' => $this->userId
                /* 'user_id' => Auth()->user()->id */
            ]);

            MovService::create([
                'movimiento_id' => $mv->id,
                'service_id' => $newservice->id
            ]);
            ClienteMov::create([
                'movimiento_id' => $mv->id,
                'cliente_id' => $this->cliente->id
            ]);

            DB::commit();

            
            
            $this->orderservice = $neworder->id;
            session(['od' => $this->orderservice]);
            $this->resetUI();
            $this->emit('modal-selected', 'Servicio Registrado Correctamente');
        } catch (Exception $e) {
            DB::rollback();
            $this->emit('item-error', 'ERROR' . $e->getMessage());
        }
        session(['tservice' => $this->typeservice]);
    }
    public function Edit(Service $service)
    {
        $movimiento_Serv = Service::join('mov_services as ms', 'ms.service_id', 'services.id')
            ->join('movimientos as m', 'ms.movimiento_id', 'm.id')
            ->select('m.on_account as on_account', 'm.saldo as saldo', 'm.import as import', 'm.type', 'm.user_id as user_id')
            ->where('services.id', $service->id)
            ->where('m.status', 'ACTIVO')
            ->get()->first();

        $this->selected_id = $service->id;
        $this->typeworkid = $service->type_work_id;
        $this->catprodservid = $service->cat_prod_service_id;
        $this->marc = $service->marca;
        $this->detalle = $service->detalle;
        $this->falla_segun_cliente = $service->falla_segun_cliente;
        $this->diagnostico = $service->diagnostico;
        $this->solucion = $service->solucion;
        $this->fecha_estimada_entrega = substr($service->fecha_estimada_entrega, 0, 10);
        $this->hora_entrega = substr($service->fecha_estimada_entrega, 11, 14);
        $this->import = $movimiento_Serv->import;
        $this->on_account = $movimiento_Serv->on_account;
        $this->saldo = $movimiento_Serv->saldo;
        $this->userId = $movimiento_Serv->user_id;
        $this->opciones = $movimiento_Serv->type;
        $this->emit('modal-show', 'show modal!');

        $servicioss = Service::find($this->selected_id);
        foreach ($servicioss->movservices as $mm) {
            if ($mm->movs->status == 'ACTIVO') {
                $this->estatus = $mm->movs->type;
            }
        }
    }
    public function ChangeTypeService()
    {
        if ($this->orderservice != 0) {
            $Ordservice = OrderService::find($this->orderservice);
            $Ordservice->type_service = $this->type_service;
            $Ordservice->save();
        }
        $Ordservice = OrderService::find($this->orderservice);
        session(['tservice' => $this->type_service]);
        $this->typeservice = $this->type_service;
        /* $this->type_service = session('tservice'); */

        $this->emit('tipoServ-updated', 'Servicio Actualizado');
    }
    //Update de Servicios
    public function Update()
    {
        if ($this->on_account <= $this->import) {
            $rules = [
                'typeworkid' => 'required|not_in:Elegir',
                'catprodservid' => 'required|not_in:Elegir',
                'marc' => 'required',
                'detalle' => 'required',
                'falla_segun_cliente' => 'required',
                'diagnostico' => 'required',
                'solucion' => 'required',
                'import' => 'required',
                'on_account' => 'required',
                'fecha_estimada_entrega' => 'required'
            ];
            $messages = [
                'typeworkid.required' => 'El Tipo de Trabajo es requerido',
                'typeworkid.not_in' => 'Seleccine una opción distinto a Elegir',
                'catprodservid.required' => 'El Tipo de Equipo es requerido',
                'catprodservid.not_in' => 'Seleccine una opción distinto a Elegir',
                'marc.required' => 'La Marca/Modelo es requerida',
                'detalle.required' => 'El Estado del Equipo es requerido',
                'falla_segun_cliente.required' => 'La Falla es requerida',
                'diagnostico.required' => 'El Diagnostico es requerido',
                'solucion.required' => 'La Solución es requerida',
                'import.required' => 'El Saldo es requerido',
                'on_account.required' => 'Si no desea ingresar nada ingrese "0"',
                'fecha_estimada_entrega.required' => 'La Fecha es requerida'
            ];

            $this->validate($rules, $messages);
        } else {
            $rules = [
                'typeworkid' => 'required|not_in:Elegir',
                'catprodservid' => 'required|not_in:Elegir',
                'marc' => 'required',
                'detalle' => 'required',
                'falla_segun_cliente' => 'required',
                'diagnostico' => 'required',
                'solucion' => 'required',
                'import' => 'required',
                'on_account' => 'required',
                'on_account' => 'required_with:import|lt:import',
                'import' => 'required_with:on_account',
                'fecha_estimada_entrega' => 'required'
            ];
            $messages = [
                'typeworkid.required' => 'El Tipo de Trabajo es requerido',
                'typeworkid.not_in' => 'Seleccine una opción distinto a Elegir',
                'catprodservid.required' => 'El Tipo de Equipo es requerido',
                'catprodservid.not_in' => 'Seleccine una opción distinto a Elegir',
                'marc.required' => 'La Marca/Modelo es requerida',
                'detalle.required' => 'El Estado del Equipo es requerido',
                'falla_segun_cliente.required' => 'La Falla es requerida',
                'diagnostico.required' => 'El Diagnostico es requerido',
                'solucion.required' => 'La Solución es requerida',
                'import.required' => 'El Saldo es requerido',
                'on_account.required' => 'Si no desea ingresar nada ingrese "0"',
                'import.required_with' => 'Ingrese un monto válido',
                'on_account.required_with' => 'Ingrese un monto válido.',
                'on_account.lt' => 'A cuenta no puede ser mayor al total',
                'fecha_estimada_entrega.required' => 'La Fecha es requerida'
            ];

            $this->validate($rules, $messages);
        }

        DB::beginTransaction();
        /* dd($this->hora_entrega); */
        try {
            $from = Carbon::parse($this->fecha_estimada_entrega)->format('Y-m-d') . " " . $this->hora_entrega;
            $service = Service::find($this->selected_id);

            $service->update([
                'type_work_id' => $this->typeworkid,
                'cat_prod_service_id' => $this->catprodservid,
                'marca' => $this->marc,
                'detalle' => $this->detalle,
                'falla_segun_cliente' => $this->falla_segun_cliente,
                'diagnostico' => $this->diagnostico,
                'solucion' => $this->solucion,
                'fecha_estimada_entrega' => $from,
            ]);
            foreach ($service->movservices as $mm) {
                $mm->movs->update([
                    'import' => $this->import,
                    'on_account' => $this->on_account,
                    'saldo' => $this->saldo,
                    'user_id' => $this->userId
                ]);
            }


            $servicioss = Service::find($this->selected_id);
            foreach ($servicioss->movservices as $mm) {
                if ($mm->movs->status == 'ACTIVO') {
                    $this->estatus = $mm->movs->type;
                }
            }

            if ($this->estatus == 'TERMINADO' && $this->opciones == 'PENDIENTE') {
                foreach ($servicioss->movservices as $mm) {
                    if ($mm->movs->type == 'TERMINADO' || $mm->movs->type == 'PROCESO') {
                        $ClienteMov = ClienteMov::find($mm->movs->climov->id);
                        $ClienteMov->delete();
                        $movServ = MovService::find($mm->id);
                        $movServ->delete();
                        $movim = Movimiento::find($mm->movs->id);
                        $movim->delete();
                    }
                    if ($mm->movs->type == 'PENDIENTE') {
                        $movimi = Movimiento::find($mm->movs->id);
                        $movimi->status = 'ACTIVO';
                        $movimi->save();
                    }
                }
            } elseif ($this->estatus == 'TERMINADO' && $this->opciones == 'PROCESO') {
                foreach ($servicioss->movservices as $mm) {
                    if ($mm->movs->type == 'TERMINADO') {
                        $ClienteMov = ClienteMov::find($mm->movs->climov->id);
                        $ClienteMov->delete();
                        $movServ = MovService::find($mm->id);
                        $movServ->delete();
                        $movim = Movimiento::find($mm->movs->id);
                        $movim->delete();
                    }
                    if ($mm->movs->type == 'PROCESO') {
                        $movimi = Movimiento::find($mm->movs->id);
                        $movimi->status = 'ACTIVO';
                        $movimi->save();
                    }
                }
            } elseif ($this->estatus == 'PROCESO' && $this->opciones == 'PENDIENTE') {
                foreach ($servicioss->movservices as $mm) {
                    if ($mm->movs->type == 'PROCESO') {
                        $ClienteMov = ClienteMov::find($mm->movs->climov->id);
                        $ClienteMov->delete();
                        $movServ = MovService::find($mm->id);
                        $movServ->delete();
                        $movim = Movimiento::find($mm->movs->id);
                        $movim->delete();
                    }
                    if ($mm->movs->type == 'PENDIENTE') {
                        $movimi = Movimiento::find($mm->movs->id);
                        $movimi->status = 'ACTIVO';
                        $movimi->save();
                    }
                }
            } elseif ($this->estatus == 'ABANDONADO' && $this->opciones == 'TERMINADO') {
                foreach ($servicioss->movservices as $mm) {
                    if ($mm->movs->type == 'ABANDONADO') {
                        $ClienteMov = ClienteMov::find($mm->movs->climov->id);
                        $ClienteMov->delete();
                        $movServ = MovService::find($mm->id);
                        $movServ->delete();
                        $movim = Movimiento::find($mm->movs->id);
                        $movim->delete();
                    }
                    if ($mm->movs->type == 'TERMINADO') {
                        $movimi = Movimiento::find($mm->movs->id);
                        $movimi->status = 'ACTIVO';
                        $movimi->save();
                    }
                }
                $servicioss->fecha_estimada_entrega = new DateTime("now");
                $servicioss->save();
            } elseif ($this->estatus == 'ABANDONADO' && $this->opciones == 'PROCESO') {
                foreach ($servicioss->movservices as $mm) {
                    if ($mm->movs->type == 'ABANDONADO'  || $mm->movs->type == 'TERMINADO') {
                        $ClienteMov = ClienteMov::find($mm->movs->climov->id);
                        $ClienteMov->delete();
                        $movServ = MovService::find($mm->id);
                        $movServ->delete();
                        $movim = Movimiento::find($mm->movs->id);
                        $movim->delete();
                    }
                    if ($mm->movs->type == 'PROCESO') {
                        $movimi = Movimiento::find($mm->movs->id);
                        $movimi->status = 'ACTIVO';
                        $movimi->save();
                    }
                }
                $servicioss->fecha_estimada_entrega = new DateTime("now");
                $servicioss->save();
            } elseif ($this->estatus == 'ABANDONADO' && $this->opciones == 'PENDIENTE') {
                foreach ($servicioss->movservices as $mm) {
                    if ($mm->movs->type == 'ABANDONADO'  || $mm->movs->type == 'TERMINADO' || $mm->movs->type == 'PROCESO') {
                        $ClienteMov = ClienteMov::find($mm->movs->climov->id);
                        $ClienteMov->delete();
                        $movServ = MovService::find($mm->id);
                        $movServ->delete();
                        $movim = Movimiento::find($mm->movs->id);
                        $movim->delete();
                    }
                    if ($mm->movs->type == 'PENDIENTE') {
                        $movimi = Movimiento::find($mm->movs->id);
                        $movimi->status = 'ACTIVO';
                        $movimi->save();
                    }
                }
                $servicioss->fecha_estimada_entrega = new DateTime("now");
                $servicioss->save();
            }



            DB::commit();
            $this->resetUI();
            $this->emit('service-updated', 'Servicio Actualizado');
        } catch (Exception $e) {
            DB::rollback();
            $this->emit('item-error', 'ERROR' . $e->getMessage());
        }
    }
    protected $listeners = [
        'deleteRow' => 'Destroy',
        'selectclient' => 'select_client'
    ];

    public function Destroy(Service $service)
    {
        foreach($service->movservices as $mm){
            $movCliente = ClienteMov::find($mm->movs->climov->id);
            $movCliente->delete();
            $movService = MovService::find($mm->id);
            $movService->delete();
            $movimiento = Movimiento::find($mm->movs->id);
            $movimiento->delete();
            $service->delete();
        }
        

        if ($this->orderservice  != 0) {
            $neworder = OrderService::find($this->orderservice);
            if ($neworder->services->count() == 0) {
                $neworder->delete();
                session(['od' => 0]);
                session(['clie' => ""]);
                $this->orderservice = 0;
                $this->cliente = "";
            }
        }

        $this->resetUI();
        $this->emit('service-deleted', 'Servicio Eliminado');
    }
    public function resetUI()
    {
        $this->categoryid = 'Elegir';
        $this->typeworkid = 'Elegir';
        $this->catprodservid = 'Elegir';
        $this->selected_id = 0;
        /* $this->typeservice = 'NORMAL'; */
        $this->saldo = 0;
        $this->on_account = 0;
        $this->import = 0;
        $this->from = Carbon::parse(Carbon::now())->format('d-m-Y  H:i');
        $this->fecha_estimada_entrega = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->hora_entrega = Carbon::parse(Carbon::now())->format('H:i');
        $this->cedula = '';
        $this->celular = '';
        $this->telefono = '';
        $this->detalle = '';
        $this->falla_segun_cliente = '';        
        $this->marc = '';
        // $this->reset(['nit']);
        $this->resetValidation();
        $this->diagnostico = 'Revisión';
        $this->solucion = 'Revisión';
        $this->userId = 0;
    }
    //Muestra una ventana modal para el servicio rápido
    public function ShowModalFastService()
    {
        $this->emit("show-fastservice");
    }
    //Guarda un servicio Rápido
    public function SaveFastService()
    {
        //Busacndo el tipo de trabajo para Servicio Rápido, creandolo si no existe
        $type_work = TypeWork::where("type_works.name","Servicio Rápido")->get();
        if($type_work->count() > 0)
        {
            $type_work = $type_work->first();
        }
        else
        {
            $type_work = TypeWork::create([
                'name' => "Servicio Rápido"
            ]);
        }


        DB::beginTransaction();
        try
        {
            //Creando la orden de Servicio
            $order_service = OrderService::create([
                'type_service' => "Rápido",
            ]);
            //Creando el servicio
            $service = Service::create([
                'type_work_id' => $type_work->id,
                'cat_prod_service_id' => $this->fs_kind_of_team,
                'marca' => $this->fs_mark,
                'detalle' => $this->fs_team_status,
                'falla_segun_cliente' => "Servicio Rápido",
                'diagnostico' => "Servicio Rápido",
                'solucion' => $this->fs_solution,
                'fecha_estimada_entrega' => Carbon::parse(Carbon::now())->format('Y-m-d  H:i'),
                'order_service_id' => $order_service->id,
                'sucursal_id' => $this->idsucursal()
            ]);


            //PONIENDO EL SERVICIO EN PENDIENTE
            $motion_pending = Movimiento::create([
                'type' => 'PENDIENTE',
                'status' => 'INACTIVO',
                'import' => $this->fs_import,
                'on_account' => 0,
                'saldo' => $this->fs_import,
                'user_id' => $this->fs_technical_support
            ]);

            MovService::create([
                'movimiento_id' => $motion_pending->id,
                'service_id' => $service->id
            ]);
            ClienteMov::create([
                'movimiento_id' => $motion_pending->id,
                'cliente_id' => $this->clienteanonimo_id()
            ]);

            //PONIENDO EL SERVICIO EN PROCESO
            $motion_process = Movimiento::create([
                'type' => 'PROCESO',
                'status' => 'INACTIVO',
                'import' => $motion_pending->import,
                'on_account' => $motion_pending->on_account,
                'saldo' => $motion_pending->saldo,
                'user_id' =>  $motion_pending->user_id,
            ]);
            MovService::create([
                'movimiento_id' => $motion_process->id,
                'service_id' => $service->id
            ]);
            ClienteMov::create([
                'movimiento_id' => $motion_process->id,
                'cliente_id' => $this->clienteanonimo_id()
            ]);


            //PONIENDO EL SERVICIO EN TERMINADO
            $motion_terminated = Movimiento::create([
                'type' => 'TERMINADO',
                'status' => 'ACTIVO',
                'import' => $motion_process->import,
                'on_account' => $motion_process->on_account,
                'saldo' => $motion_process->saldo,
                'user_id' =>  $motion_process->user_id,
            ]);
            MovService::create([
                'movimiento_id' => $motion_terminated->id,
                'service_id' => $service->id
            ]);
            ClienteMov::create([
                'movimiento_id' => $motion_terminated->id,
                'cliente_id' => $this->clienteanonimo_id()
            ]);
            DB::commit();


            $this->service_order_id = $order_service->id;
            $this->emit("crear-comprobante");

            // $this->emit("hide-fastservice");
            $this->redirect('orderservice');
            // $this->emit("hide-fastservice");
        }
        catch (Exception $e)
        {
            DB::rollback();
            dd($e->getMessage());
            // $this->emit('item-error', 'ERROR' . $e->getMessage());
        }
    }
    //Obtener el Id de la Sucursal donde esta el Usuario
    public function idsucursal()
    {
        $idsucursal = User::join("sucursal_users as su","su.user_id","users.id")
        ->select("su.sucursal_id as id","users.name as n")
        ->where("users.id",Auth()->user()->id)
        ->where("su.estado","ACTIVO")
        ->get()
        ->first();
        return $idsucursal->id;
    }
    //Obtener el id de un cliente anónimo, si no existe creará uno
    public function clienteanonimo_id()
    {
        $client = Cliente::select('clientes.nombre as nombrecliente','clientes.id as idcliente')
        ->where('clientes.nombre','Cliente Anónimo')
        ->get();
        
        if($client->count() > 0)
        {
            return $client->first()->idcliente;
        }
        else
        {
            $procedencia = ProcedenciaCliente::where('procedencia_clientes.procedencia','Venta')
            ->get();
            if($procedencia->count() > 0)
            {
                $cliente_anonimo = Cliente::create([
                    'nombre' => "Cliente Anónimo",
                    'procedencia_cliente_id' => $procedencia->first()->id
                ]);
                return $cliente_anonimo->id;
            }
            else
            {
                $procedencia = ProcedenciaCliente::create([
                    'procedencia' => "Venta"
                ]);
                $cliente_anonimo = Cliente::create([
                    'nombre' => "Cliente Anónimo",
                    'procedencia_cliente_id' => $procedencia->id
                ]);
                return $cliente_anonimo->id;
            }
        }
    }
    //Selecciona un cliente para el servicio
    public function select_client($idcliente, $celular, $telefono)
    {
        $client = Cliente::find($idcliente);

        if($client->celular != $celular && $celular != "")
        {
            $client->update([
                'celular' => $celular
            ]);
        }
        if($client->telefono != $telefono && $telefono != "")
        {
            $client->update([
                'telefono' => $telefono
            ]);
        }
        $this->search = "";
        $this->cliente = $client;
        $this->emit("hide-modalclient");
    }
    //Selecciona y crea un Cliente
    public function create_select_client()
    {
        $rules = [
            'cedula' => 'nullable|max:10',
            'celular' => 'nullable|digits:8',
            'telefono' => 'nullable|digits:7',
            'procedencia' => 'required|not_in:Elegir',
        ];
        $messages = [
            'cedula.max' => 'La cédula debe tener máximo 10 digitos',
            'celular.digits' => 'El celular debe tener 8 numeros',
            'telefono.digits' => 'El telefono debe tener 7 numeros',
            'procedencia.required' => 'Seleccione la sucursal del usuario',
            'procedencia.not_in' => 'Seleccione una sucursal distinto a Elegir',
        ];
        $this->validate($rules, $messages);

        if($this->cedula == "")
        {
            $this->cedula = 0;
        }
        if($this->celular == "")
        {
            $this->celular = 0;
        }
        if($this->telefono == "")
        {
            $this->telefono = 0;
        }


        $client = Cliente::create([
            'nombre' => $this->search,
            'cedula' => $this->cedula,
            'celular' => $this->celular,
            'telefono' => $this->telefono,
            'procedencia_cliente_id' => $this->procedencia
        ]);

        $this->search = "";
        $this->cedula = "";
        $this->celular = "";
        $this->telefono = "";
        $this->cliente = $client;
        $this->emit("hide-modalclient");

    }
}
