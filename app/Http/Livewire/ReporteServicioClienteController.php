<?php

namespace App\Http\Livewire;

use App\Exports\ClientsReportExport;
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
    public $listaprodencias, $dateFrom, $dateTo, $procedencia_id,$pagination;
   
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->procedencia_id = "Todos";
        $this->listaprodencias = ProcedenciaCliente::all();
        $this->dateFrom = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->dateTo = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->pagination = 100;
    }

    public function render()
    {
        //fltro de procedencia 
        if ($this->procedencia_id == "Todos")
        {
            $clients = Cliente::join("procedencia_clientes as pc", "pc.id", "clientes.procedencia_cliente_id", "clientes.celular as celular")
                ->select("clientes.*", "pc.procedencia as procedencia", "pc.created_at as created_at")
                ->whereBetween("clientes.created_at", [Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->dateTo)->format('Y-m-d')     . ' 23:59:59'])
                ->paginate($this->pagination);
        }
        else
        {
            $clients = Cliente::join("procedencia_clientes as pc", "pc.id", "clientes.procedencia_cliente_id", "clientes.celular as celular")
                ->select("clientes.*", "pc.procedencia as procedencia", "pc.created_at as created_at")
                ->whereBetween("clientes.created_at", [Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->dateTo)->format('Y-m-d')     . ' 23:59:59'])
                ->where("pc.id", $this->procedencia_id)
                ->paginate($this->pagination);
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
