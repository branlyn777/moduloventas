<?php

namespace App\Http\Livewire;

use App\Exports\ClientsReportExport;
use App\Models\CatProdService;
use App\Models\Cliente;
use Livewire\Component;
use App\Models\Customer;
use App\Models\ProcedenciaCliente;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ReporteServicioClienteController extends Component
{ 
    use WithPagination;
    public $listaprodencias,$listacategoria , $dateFrom, $dateTo, $procedencia_id,$pagination, $categoria_id;
   
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->procedencia_id = "Todos";
        $this->categoria_id = "Todos";
        $this->listaprodencias = ProcedenciaCliente::all();
        $this->listacategoria = CatProdService::all();
        $this->dateFrom = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->dateTo = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->pagination = 10;
        
    }

    public function render()
    {
        //fltro de procedencia 
        if ($this->procedencia_id == "Todos" )
        {
            if($this->categoria_id == "Todos")
            {
                $clients = Cliente::join("procedencia_clientes as pc", "pc.id", "clientes.procedencia_cliente_id")
                ->join("cliente_movs as cm","cm.cliente_id", "clientes.id")
                ->join("movimientos as m", "m.id", "cm.movimiento_id")
                ->join("mov_services as ms", "ms.movimiento_id", "m.id")
                ->join("services as s", "s.id", "ms.service_id")
                ->join("cat_prod_services as cps", "cps.id", "s.cat_prod_service_id")
                ->select("clientes.*", "pc.procedencia as procedencia","cps.nombre as nombrecps")
                
                ->whereBetween("clientes.created_at", [Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->dateTo)->format('Y-m-d')     . ' 23:59:59'])
                ->distinct()
                ->paginate($this->pagination);
             
            }
            else
            {
                $clients = Cliente::join("procedencia_clientes as pc", "pc.id", "clientes.procedencia_cliente_id")
                ->join("cliente_movs as cm","cm.cliente_id", "clientes.id")
                ->join("movimientos as m", "m.id", "cm.movimiento_id")
                ->join("mov_services as ms", "ms.movimiento_id", "m.id")
                ->join("services as s", "s.id", "ms.service_id")
                ->join("cat_prod_services as cps", "cps.id", "s.cat_prod_service_id")
                ->select("clientes.*", "pc.procedencia as procedencia","cps.nombre as nombrecps")
                ->whereBetween("clientes.created_at", [Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->dateTo)->format('Y-m-d')     . ' 23:59:59'])
                ->where("cps.id", $this->categoria_id)
                ->distinct()
                ->paginate($this->pagination);
            }
        }
        else
        {
            if($this->categoria_id == "Todos")
            {
                $clients = Cliente::join("procedencia_clientes as pc", "pc.id", "clientes.procedencia_cliente_id")
                ->join("cliente_movs as cm","cm.cliente_id", "clientes.id")
                ->join("movimientos as m", "m.id", "cm.movimiento_id")
                ->join("mov_services as ms", "ms.movimiento_id", "m.id")
                ->join("services as s", "s.id", "ms.service_id")
                ->join("cat_prod_services as cps", "cps.id", "s.cat_prod_service_id")
                ->select("clientes.*", "pc.procedencia as procedencia","cps.nombre as nombrecps")
                ->whereBetween("clientes.created_at", [Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->dateTo)->format('Y-m-d')     . ' 23:59:59'])
                ->where("pc.id", $this->procedencia_id)
                ->distinct()
                ->paginate($this->pagination);
            }
            else
            {
                $clients = Cliente::join("procedencia_clientes as pc", "pc.id", "clientes.procedencia_cliente_id")
                ->join("cliente_movs as cm","cm.cliente_id", "clientes.id")
                ->join("movimientos as m", "m.id", "cm.movimiento_id")
                ->join("mov_services as ms", "ms.movimiento_id", "m.id")
                ->join("services as s", "s.id", "ms.service_id")
                ->join("cat_prod_services as cps", "cps.id", "s.cat_prod_service_id")
                ->select("clientes.*", "pc.procedencia as procedencia","cps.nombre as nombrecps")
                ->whereBetween("clientes.created_at", [Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->dateTo)->format('Y-m-d')     . ' 23:59:59'])
                ->where("cps.id", $this->categoria_id)
                ->where("pc.id", $this->procedencia_id)
                ->distinct()
                ->paginate($this->pagination);
            }
            dd($clients);
        }
        return view('livewire.reporte_service.reporte-servicio-cliente', [
            'clients' => $clients
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    public function generateexcel()
    {
        $reportClients = "Reporte de Clientes_" . uniqid() . ".xlsx";
        return Excel::download(new ClientsReportExport($this->dateFrom, $this->dateTo), $reportClients);
    }
}
