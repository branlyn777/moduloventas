<?php

namespace App\Http\Livewire;

use App\Models\MovService;
use App\Models\ProcedenciaCliente;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ServiceController extends Component
{
    //Datos del Cliente
    public $client;
    //Guarda una lista de servicios de la Órden de Servicio
    public $list_services;

    public function mount()
    {

    }
    public function render()
    {
        
        if (session()->has('od') && is_numeric(session('od')))
        {
            // hacer algo si la variable de sesión existe y tiene un número como valor
            $this->client = $this->get_client(session('od'));
            $this->list_services = $this->get_service_order_detail(session('od'));
        }
        else
        {
            dd("Crear");
        }

        $asd = "";

        return view('livewire.servicio.service', [
            'asd' => $asd
        ])
        ->extends('layouts.theme.app')
        ->section('content');
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
    // Devuelve servicios de una orden de servicio
    public function get_service_order_detail($code)
    {
        $services = Service::join("mov_services as ms", "ms.service_id","services.id")
        ->join("movimientos as m", "m.id", "ms.movimiento_id")
        ->join('cat_prod_services as cps', 'cps.id', 'services.cat_prod_service_id')
        ->select("services.id as idservice","services.created_at as created_at", 
        DB::raw("0 as responsible_technician"), DB::raw("0 as receiving_technician"),
        "m.import as price_service","m.type as type","m.on_account as on_account","m.saldo as balance",
        "cps.nombre as name_cps",
        'services.marca as mark','services.detalle as detail',
        'services.falla_segun_cliente as client_fail')
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
        return $technician->user_name;
    }
    //Muestra una ventana modal para editar un servicio
    public function show_modal_service()
    {
        dd("Hola");
    }
}
