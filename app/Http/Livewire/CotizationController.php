<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class CotizationController extends Component
{
    //Variable para Buscar por el Nombre o Código los productos
    public $buscarproducto;
    //Variable para guardar el id del producto
    public $producto_id;
     //Lista la tabla procedencias de producto
     public $procedencias;
     //Carrito de cotizacion
    public $carrito_cotizacion;

    public function mount()
    {
        //Creando el carrito de venta en una colección
        $this->carrito_cotizacion = collect([]);
    }

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
            'listaproducto' => $listaproducto,
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    public function increase($idproducto)
    {
        $producto = Product:: find($idproducto);

         //Insertando un producto a la coleccion 
         $this->carrito_cotizacion->push([
            'orden' => 1,
            'producto_id' => $idproducto,
            'nombre_producto' => $producto->nombre,
            'codigo' => $producto->codigo,
            'precio_producto' => 0,
            'cantidad' => '1',
        ]);     
    }
    public function modalbuscarproducto()
    {
        $this->emit('show-buscarproducto');
    }
}
