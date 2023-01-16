<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class CotizationController extends Component
{
    //Variable para Buscar por el Nombre o Código los productos
    public $buscarproducto;
     //Variable para guardar el id del cliente
     public $producto_id;


    public function render()
    {
        $asd = '';


        //Lista a todos los productos que tengan el nombre de la variable $this->buscarproducto
        $listaproducto = [];
        if (strlen($this->buscarproducto) > 0) {
            $listaproducto = Product::select("products.*")
                ->where('products.nombre', 'like', '%' . $this->buscarproducto . '%')
                ->where('products.status', 'ACTIVO')
                ->orderBy("products.nombre", "desc")
                ->get();
        }
        return view('livewire.cotizacion.cotization', [
            'coti' => $asd,
            'listaproductos' => $listaproducto,
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

     //Cierra la ventana modal Buscar Producto y Cambia el id de la variable $producto_id
     public function seleccionarcliente($idproducto)
     {
         $this->producto_id = $idproducto;
         $nombrecliente = Product::find($idproducto)->nombre;
         /* $this->mensaje_toast = "Se seleccionó al cliente: '" . ucwords(strtolower($nombrecliente)) . "' para esta venta";
         $this->emit('hide-buscarcliente'); */
     }
}
