<?php

namespace App\Http\Livewire;

use App\Models\MovService;
use App\Models\Service;
use App\Models\Sucursal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReporteServiciosCostosController extends Component
{
    public $listasucursales, $sucursal_id, $dateFrom, $dateTo, $estado;

    public function mount()
    {
        $this->listasucursales = Sucursal::all();
        $this->sucursal_id = $this->idsucursal();
        $this->dateFrom = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->dateTo = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->estado = "TODOS";
    }

    public function render()
    {

        if($this->estado == "TODOS")
        {
            $lista_servicios = Service::join("cat_prod_services as c","c.id","services.cat_prod_service_id")
            ->join("type_works as t","t.id","services.type_work_id")
            ->join("mov_services as ms","ms.service_id","services.id")
            ->join("movimientos as m","m.id","ms.movimiento_id")
            ->select("services.order_service_id as codigo","services.costo as costo_servicio","services.created_at as fecha_creacion",
            "t.name as tipo_trabajo","services.marca as marca_producto","services.detalle as detalle_producto","services.detalle_costo as detalle_costo",
            DB::raw('0 as estado_servicio'),DB::raw('0 as fecha_entrega'),
            "c.nombre as categoria_servicio","services.falla_segun_cliente as falla_segun_cliente","services.id as idservicio")
            ->where("services.costo",">", 0)
            ->where("m.status", "ACTIVO")
            ->whereBetween('services.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
            ->get();
        }
        else
        {
            $lista_servicios = Service::join("cat_prod_services as c","c.id","services.cat_prod_service_id")
            ->join("type_works as t","t.id","services.type_work_id")
            ->join("mov_services as ms","ms.service_id","services.id")
            ->join("movimientos as m","m.id","ms.movimiento_id")
            ->select("services.order_service_id as codigo","services.costo as costo_servicio","services.created_at as fecha_creacion",
            "t.name as tipo_trabajo","services.marca as marca_producto","services.detalle as detalle_producto","services.detalle_costo as detalle_costo",
            DB::raw('0 as estado_servicio'),DB::raw('0 as fecha_entrega'),
            "c.nombre as categoria_servicio","services.falla_segun_cliente as falla_segun_cliente","services.id as idservicio")
            ->where("services.costo",">", 0)
            ->where("m.status", "ACTIVO")
            ->where("m.type", $this->estado)
            ->whereBetween('services.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
            ->get();
        }



        


        $total_costo = 0;
        foreach($lista_servicios as $s)
        {
            $datos = MovService::join("movimientos as m","m.id","mov_services.movimiento_id")
            ->select("m.type as estado_servicio","m.created_at as fecha_entrega")
            ->where("mov_services.service_id",$s->idservicio)
            ->where("m.status", "ACTIVO")
            ->first();



            $s->estado_servicio = $datos->estado_servicio;
            $s->fecha_entrega = $datos->fecha_entrega;

            


            $total_costo = $total_costo + $s->costo_servicio;
        }



        return view('livewire.reporte_service.reporteservicioscostos', [
            'lista_servicios' =>  $lista_servicios,
            'total_costo' =>  $total_costo,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
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
}
