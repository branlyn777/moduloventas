<?php

namespace App\Http\Livewire;

use App\Models\OrderService;
use App\Models\Service;
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
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->pagination = 20;
    }
    public function render()
    {
        $service_orders = OrderService::select(
                "order_services.id as code",
                "order_services.created_at as reception_date",
                DB::raw('0 as servicios')
            )
            ->where('order_services.status', 'ACTIVO')
            ->orderBy("order_services.id", "desc")
            ->paginate($this->pagination);





        return view('livewire.order_service.orderservice2', [
            'service_orders' => $service_orders,
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function detalle_orden_de_servicio($code)
    {
        $servicios =  Service::join('order_services as os', 'os.id', 'services.order_service_id')
            ->join('mov_services as ms', 'services.id', 'ms.service_id')
            ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
            ->join('cat_prod_services as cps', 'cps.id', 'services.cat_prod_service_id')
            ->select('cps.nombre as nombrecategoria',
            'services.detalle as detalle',
            'services.id as idservicio',
            'mov.type as estado',
            'mov.import as importe',
            'services.falla_segun_cliente as falla_segun_cliente',
            'services.fecha_estimada_entrega as fecha_estimada_entrega',
            'services.marca as marca',
            DB::raw('0 as responsabletecnico'),
            DB::raw('0 as tecnicoreceptor'))
            ->where('mov.status', 'ACTIVO')
            ->where('services.order_service_id', $code)
            ->get();

            foreach ($servicios as $ser)
            {
                $ser->responsabletecnico = $this->obtener_tecnico_responsable($ser->idservicio);
                $ser->tecnicoreceptor = $this->obtener_tecnico_receptor($ser->idservicio);
            }



        return $servicios;
    }
}
