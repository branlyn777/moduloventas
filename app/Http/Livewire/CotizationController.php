<?php

namespace App\Http\Livewire;

use App\Models\Cotization;
use App\Models\Lote;
use App\Models\Product;
use Carbon\Carbon;
use Darryldecode\Cart\Cart;
use Exception;
use Illuminate\Support\Facades\DB;
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
    //Guarda el mensaje que se quiera mandar en pantalla
    public $message;
    //Total Bs de precio
    public $total_bs;
    //Total Bs de cantidad
    public $total_cantidad;
    //Variable para guardar la cantidad de precio
    public $dinero_recibido;
    //Guarda el total descuento o recargo de la venta
    public $descuento_recargo;

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
            $listaproducto = Product::Join('lotes as l', 'products.id', 'l.product_id')
                ->select("products.*")
                ->where('products.nombre', 'like', '%' . $this->buscarproducto . '%')
                ->where('products.status', 'ACTIVO')
                ->orderBy("products.nombre", "desc")
                ->distinct()
                ->get();
        }

        //Modulo para Calcular el Cambio
        if ($this->dinero_recibido < 0 || $this->dinero_recibido == "-") {
            $this->dinero_recibido = 0;
        }

        //Obteniendo el total Bs del precio
        $this->total_bs = $this->totalbs();
        //Obteniendo el total cantidad
        $this->total_cantidad = $this->totacantidad();



        $lista_cotizaciones = Cotization::join("clientes as c","c.id","cotizations.cliente_id")
        ->select("c.nombre as nombrecliente","cotizations.total as totalbs","cotizations.created_at as fechacreacion", DB::raw("0 as diasrestantes"),
        "cotizations.finaldate as finaldate")
        ->get();

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
            'lista_cotizaciones' => $lista_cotizaciones,
            'coti' => $asd,
            'listaproducto' => $listaproducto,
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    //Buscar el Precio Original de un Producto
    public function buscarprecio($id)
    {
        $tiendaproducto = Product::select("products.id as id", "products.precio_venta as precio")
            ->where("products.id", $id)
            ->get()->first();
        return $tiendaproducto->precio;
    }

    public function increase($idproducto)
    {
        //Buscando y guardando el elemento en la colección
        $p = $this->carrito_cotizacion->where('producto_id', $idproducto)->first();

        if ($p == null) {

            //Insertando un producto a la coleccion
            $producto = Product::find($idproducto);


            $precio = Lote::select('lotes.pv_lote as pv')
                ->where("lotes.product_id", $idproducto)
                // ->where("lotes.status","Activo")
                ->orderby("lotes.created_at", "desc")
                ->first()->pv;


            $this->carrito_cotizacion->push([
                'orden' => $this->carrito_cotizacion->count() + 1,
                'producto_id' => $idproducto,
                'nombre_producto' => $producto->nombre,
                'codigo' => $producto->codigo,
                'precio_producto' => $precio,
                'cantidad' => 1,
            ]);

            //Actualizando la variable $this->message
            $this->message = "Producto " . $producto->nombre . " Insertado";
        } else {

            //Buscamos el elemento en la colección
            $result = $this->carrito_cotizacion->where('producto_id', $idproducto);
            //Calculando el orden del producto
            $orden = $p['orden'];
            //Eliminando la fila del elemento en la coleccion
            $this->carrito_cotizacion->pull($result->keys()->first());
            $producto = Product::find($idproducto);

            //Calculando la nueva cantidad del producto
            $cantidad_nueva = $p['cantidad'] + 1;

            $precio = Lote::select('lotes.pv_lote as pv')
                ->where("lotes.product_id", $idproducto)
                // ->where("lotes.status","Activo")
                ->orderby("lotes.created_at", "desc")
                ->first()->pv;

            //Insertando un producto a la coleccion 
            $this->carrito_cotizacion->push([
                'orden' => $orden,
                'producto_id' => $idproducto,
                'nombre_producto' => $producto->nombre,
                'codigo' => $producto->codigo,
                'precio_producto' => $precio,
                'cantidad' => $cantidad_nueva,
            ]);

            //Actualizando la variable $this->message
            $this->message = "Cantidad Actulizada";
        }
        //Mostrando mensaje toast
        $this->emit("message-ok");
    }

    //Decrementa en una unidad un producto del carrito 
    public function decrease($idproducto)
    {
        try {

            //Buscando y guardando el elemento en la colección
            $p = $this->carrito_cotizacion->where('producto_id', $idproducto)->first();

            //variable para eliminar el elemento mas tarde 
            $result = $this->carrito_cotizacion->where('producto_id', $idproducto);

            $producto = Product::find($idproducto);

            //Calculando la nueva cantidad del producto
            $cantidad_nueva = $p['cantidad'] - 1;

            if ($cantidad_nueva == 0) {
                //Eliminando la fila del elemento en la coleccion
                $this->carrito_cotizacion->pull($result->keys()->first());
            } else {
                //Eliminando la fila del elemento en la coleccion
                $this->carrito_cotizacion->pull($result->keys()->first());
                //Insertando un producto a la coleccion 

                $precio = Lote::select('lotes.pv_lote as pv')
                    ->where("lotes.product_id", $idproducto)
                    // ->where("lotes.status","Activo")
                    ->orderby("lotes.created_at", "desc")
                    ->first()->pv;

                $this->carrito_cotizacion->push([
                    'orden' => 1,
                    'producto_id' => $idproducto,
                    'nombre_producto' => $producto->nombre,
                    'codigo' => $producto->codigo,
                    'precio_producto' => $precio,
                    'cantidad' => $cantidad_nueva,
                ]);

                //Actualizando la variable $this->message
                $this->message = "Cantidad Degrementada";
                //Mostrando mensaje toast
                $this->emit("message-ok");
            }
        } catch (Exception $e) {

            $this->emit('message-error-sale');
        }
    }
    protected $listeners = [

        'clear-Product' => 'clearproduct',

    ];
    //Elimina un producto de la colección carrito
    public function clearproduct($idproducto)
    {
        //Buscamos el elemento en la colección
        $result = $this->carrito_cotizacion->where('producto_id', $idproducto);
        //Eliminando la fila del elemento en la coleccion
        $this->carrito_cotizacion->pull($result->keys()->first());

        $nombre_producto = Product::find($idproducto)->nombre;

        //Actualizando la variable $this->message
        $this->message = "Eliminado: '" . $nombre_producto . "'";
        //Mostrando mensaje toast
        $this->emit("message-ok");
    }

    //Obtiene el total Bs de de la coleccion carrito de ventas
    public function totalbs()
    {
        $contador = 0;
        foreach ($this->carrito_cotizacion as $c) {
            $contador = $contador + ($c['cantidad'] * $c['precio_producto']);
        }
        return $contador;
    }

    //Obtiene la cantidad total
    public function totacantidad()
    {
        $contador = 0;
        foreach ($this->carrito_cotizacion as $c) {
            $contador = $contador + ($c['cantidad']);
        }
        return $contador;
    }


    public function modalbuscarproducto()
    {
        $this->emit('show-buscarproducto');
    }
}
