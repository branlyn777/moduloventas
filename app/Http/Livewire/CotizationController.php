<?php

namespace App\Http\Livewire;

use App\Models\Cotization;
use App\Models\CotizationDetail;
use App\Models\Lote;
use App\Models\Product;
use Carbon\Carbon;
use Darryldecode\Cart\Cart;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CotizationController extends Component
{
    //Guarda los detalles de una determinada cotización
    public $cotization_details;
    //Guarda el id de una cotización
    public $cotization_id;
    //Variable que guarda cualquier mensaje en un toast
    public $message;
    //Variable que guarda palabras de busqueda
    public $search;

    public function mount()
    {
        $this->cotization_details = [];
    }
    public function render()
    {

        if (strlen($this->search) == 0)
        {
            $lista_cotizaciones = Cotization::join("clientes as c","c.id","cotizations.cliente_id")
            ->select("cotizations.id as idcotizacion","c.nombre as nombrecliente","cotizations.total as totalbs","cotizations.created_at as fechacreacion", DB::raw("0 as diasrestantes"),
            "cotizations.finaldate as finaldate","cotizations.status as estado")
            ->get();
        }
        else
        {
            $lista_cotizaciones = Cotization::join("clientes as c","c.id","cotizations.cliente_id")
            ->select("cotizations.id as idcotizacion","c.nombre as nombrecliente","cotizations.total as totalbs","cotizations.created_at as fechacreacion", DB::raw("0 as diasrestantes"),
            "cotizations.finaldate as finaldate","cotizations.status as estado")
            ->where('c.nombre', 'like', '%' . $this->search . '%')
            ->get();
        }


       

        foreach ($lista_cotizaciones as $key)
        {
            $fechaLimite = Carbon::parse($key->finaldate);
            if(Carbon::now() > $fechaLimite)
            {
                $key->diasrestantes = "Vencido";
               
      
            }
            else
            {
                $key->diasrestantes = $fechaLimite->diffInDays(Carbon::now());
            } 
        }
        return view('livewire.cotizacion.cotization', [
            'lista_cotizaciones' => $lista_cotizaciones
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    //Muestra la ventana modal con detalles de una cotización
    public function ShowModalDetail($idcotizacion)
    {
        $this->cotization_details = CotizationDetail::join("products as p","p.id","cotization_details.product_id")
        ->select("p.nombre as nombreproducto","cotization_details.price as price","cotization_details.quantity as quantity")
        ->where("cotization_details.cotization_id",$idcotizacion)
        ->get();
        $this->emit("show-details");
    }
    //Crea un compronate de la cotizacio´n
    public function crearcomprobante($idcotizacion)
    {
        $this->cotization_id = $idcotizacion;
        $this->emit('crear-comprobante');
    }
    //Escucha los eventos javascript de la vista
    protected $listeners = [
        'delete-cotization' => 'deletecotization'
    ];
    //Anula una cotización
    public function deletecotization($idcotization)
    {
        $cotization = Cotization::find($idcotization);
        $cotization->update([
            'status' => 'INACTIVO'
            ]);
        $cotization->save();
        $this->message = "¡Cotización número " . $cotization->id . " anulada con éxito!";
        $this->emit("message-ok");
    }
}
