<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\CarteraMov;
use App\Models\Cliente;
use App\Models\ClienteMov;
use App\Models\Destino;
use App\Models\Lote;
use App\Models\Product;
use App\Models\ProductosDestino;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\SaleLote;
use App\Models\Sucursal;
use App\Models\User;
use Facade\FlareClient\Http\Client;
use Livewire\Component;
use Livewire\WithPagination;

class SaleEditController extends Component
{
    //Guarda el id de la venta a editar
    public $venta_id;
    //Guarda true o false si dependiendo si se activa la venta con un cliente anónimo
    public $clienteanonimo;
    //Guarda true o false si dependiendo si se activa la venta con factura
    public $factura;
    //Guarda el id de la cartera que sera usada para la venta
    public $cartera_id;
    //Guarda el total de artículos para la venta
    public $total_items;
    //Guarda el total Bs de una venta
    public $total_bs;
    //Guarda las palabras usadas para buscar productos para la venta
    public $buscarproducto;
    //Guarda el nombre del cliente con el que se registrará la venta
    public $nombrecliente;
    //Guarda las monedas para ser usadas al finalizar la venta
    public $denominations;
    //Guarda el total descuento o recargo de la venta
    public $descuento_recargo;
    //Guarda la observacion que tendrá la venta
    public $observacion;
    //Guarda el mensaje que se quiera mandar en pantalla
    public $message;
    //Guarda el id de un producto
    public $producto_id;
    //Guarda el nombre de un producto
    public $nombreproducto;
    //Guarda el nombre de una sucursal
    public $nombresucursal;
    //Guarda true o false para dependiendo del resultado mostrar la venta modal finalizar venta
    public $stock_disponible;
    //Guarda todos los destinos disponibles y su stock de un determinado producto
    public $listadestinos;
    // Para guardar una lista de todas  las sucursales
    public $listasucursales;
    //Variable para Buscar por el Nombre a los Clientes
    public $buscarcliente;
    //Guarda el id de un cliente
    public $cliente_id;
    //Variables para crear un cliente
    public $cliente_ci, $cliente_celular;
    //Numero de filas que tendrá la lista de productos encontrados (paginacion)
    public $paginacion;
    //Carrito de Ventas
    public $carrito_venta;
    use WithPagination;
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        //Obteniendo el id de la venta por la variable de sesión
        $this->venta_id = session('venta_id');
        //Obteniendo detalles generales de la venta
        $venta = Sale::join("movimientos as m", "m.id", "sales.movimiento_id")
        ->join("cliente_movs as cm","cm.movimiento_id","m.id")
        ->select("cm.cliente_id as idcliente","sales.factura as factura","sales.cartera_id as cartera_id",
        "sales.observacion as observacion","sales.total as totalbs")
        ->where("sales.id",$this->venta_id)
        ->get()
        ->first();
        //Verificando si la venta se hizo con un cliente anónimo
        $cliente = Cliente::where("clientes.id", $venta->idcliente)
        ->where("clientes.nombre", "Cliente Anónimo")
        ->get();
        //Si la venta se hizo con un cliente anónimo actualizamos la variable $this->clienteanonimo
        if($cliente->count() > 0)
        {
            $this->clienteanonimo = true;
        }
        else
        {
            $this->clienteanonimo = false;
        }
        //Obteniendo el nombre del cliente con el que se registro la venta
        $this->nombrecliente = Cliente::find($venta->idcliente)->nombre;
        //Si la venta se hizo con factura actualizamos la variable $this->factura
        if($venta->factura == "Si")
        {
            $this->factura = true;
        }
        else
        {
            $this->factura = false;
        }
        //Obteniendo el id de la cartera
        $this->cartera_id = $venta->cartera_id;
        //Obteniendo la observacion de la venta
        $this->observacion = $venta->observacion;
        //Creando el carrito de venta en una colección
        $this->carrito_venta = collect([]);
        //Obteniendo detalles de los productos de la venta
        $detalle = SaleDetail::join("products as p","p.id", "sale_details.product_id")
        ->where("sale_details.sale_id", $this->venta_id)
        ->select("p.nombre as name_product","sale_details.price as price","sale_details.quantity as quantity","sale_details.product_id as product_id")
        ->get();
        //Creando un contador que cumplira la función de ordenar los productos del carrito de ventas
        $cont = 1;
        foreach($detalle as $d)
        {
            //Llenando la coleccion con los productos de la venta
            $this->carrito_venta->push([
                'order' => $cont,
                'product_id' => $d->product_id,
                'name' => $d->name_product,
                'price' => $d->price,
                'quantity'=> $d->quantity,
                'id' => $d->product_id,
            ]);
            $cont++;
        }
        //Poniendo la variable a true por defecto
        $this->stock_disponible = true;
        $this->listasucursales = [];


        $this->cliente_id = ClienteMov::join("movimientos as m","m.id","cliente_movs.movimiento_id")
        ->join("sales as s","s.movimiento_id","m.id")
        ->where("s.id",$this->venta_id)
        ->select("cliente_movs.cliente_id as idcliente")
        ->get()
        ->first()->idcliente;

        $this->paginacion = 10;
    }
    public function render()
    {
        //Variable para guardar todos los productos encontrados que contengan el nombre o código en $buscarproducto
        $listaproductos = [];
        if($this->buscarproducto != "")
        {
            $listaproductos = Product::join("productos_destinos as pd", "pd.product_id", "products.id")
            ->join('destinos as des', 'des.id', 'pd.destino_id')
            ->select("products.id as id","products.nombre as nombre", "products.image as image", "products.precio_venta as precio_venta",
            "pd.stock as stock", "products.codigo as barcode")
            ->where('products.nombre', 'like', '%' . $this->buscarproducto . '%')
            ->orWhere('products.codigo', 'like', '%' . $this->buscarproducto . '%')
            ->groupBy('products.id')
            ->paginate($this->paginacion);
        }
        //Lista a todos los clientes que tengan el nombre de la variable $this->buscarcliente
        $listaclientes = [];
        if(strlen($this->buscarcliente) > 0)
        {
            $listaclientes = Cliente::select("clientes.*")
            ->where('clientes.nombre', 'like', '%' . $this->buscarcliente . '%')
            ->orderBy("clientes.created_at","desc")
            ->get();
        }
        //Actualiza el total items del carrito de ventas
        $this->total_items = $this->totalarticulos();
        //Obteniendo el total Bs de una venta
        $this->total_bs = $this->totalbs();

        $this->nombrecliente = Cliente::find($this->cliente_id)->nombre;

        //Para actuazalizar el descuento o recargo total
        $bs_total_original = 0;
        $items = $this->carrito_venta;
        foreach ($items as $item)
        {
            $bs_total_original = ($this->buscarprecio($item['id']) * $item['quantity']) + $bs_total_original;
        }
        $this->descuento_recargo = $bs_total_original - $this->total_bs;


        return view('livewire.sales_edit.saleedit', [
            'listaproductos' => $listaproductos,
            'carteras' => $this->listarcarteras(),
            'carterasg' => $this->listarcarterasg(),
            'listaclientes' => $listaclientes,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    //Buscar el Precio Original de un Producto
    public function buscarprecio($id)
    {
        $tiendaproducto = Product::select("products.id as id","products.precio_venta as precio")
        ->where("products.id", $id)
        ->get()->first();
        return $tiendaproducto->precio;
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
            $procedencia = ProcedenciaCliente::select('procedencia_clientes.procedencia as procedencia')
            ->where('procedencia_clientes.procedencia','VENTA DE PRODUCTOS')
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
                    'procedencia' => "Venta de Productos"
                ]);
                $cliente_anonimo = Cliente::create([
                    'nombre' => "Cliente Anónimo",
                    'procedencia_cliente_id' => $procedencia->id
                ]);
                return $cliente_anonimo->id;
            }
        }
    }
    //Listar las Carteras disponibles en su corte de caja
    public function listarcarteras()
    {
        $carteras = Caja::join('carteras as car', 'cajas.id', 'car.caja_id')
        ->join('cartera_movs as cartmovs', 'car.id', 'cartmovs.cartera_id')
        ->join('movimientos as mov', 'mov.id', 'cartmovs.movimiento_id')
        ->where('cajas.estado', 'Abierto')
        ->where('mov.user_id', Auth()->user()->id)
        ->where('mov.status', 'ACTIVO')
        ->where('mov.type', 'APERTURA')
        ->where('cajas.sucursal_id', $this->idsucursal())
        ->select('car.id as idcartera', 'car.nombre as nombrecartera', 'car.descripcion as dc','car.tipo as tipo')
        ->get();
        return $carteras;
    }
    //Listar las carteras generales
    public function listarcarterasg()
    {
        $carteras = Caja::join('carteras as car', 'cajas.id', 'car.caja_id')
        ->where('cajas.id', 1)
        ->select('car.id as idcartera', 'car.nombre as nombrecartera', 'car.descripcion as dc','car.tipo as tipo')
        ->get();
        return $carteras;
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
    //Obtiene el total artículos de la coleccion carrito de ventas
    public function totalarticulos()
    {
        $contador = 0;
        foreach($this->carrito_venta as $c)
        {
            $contador = $contador + $c['quantity'];
        }
        return $contador;
    }
    //Obtiene el total Bs de de la coleccion carrito de ventas
    public function totalbs()
    {
        $contador = 0;
        foreach($this->carrito_venta as $c)
        {
            $contador = $contador + ($c['quantity'] * $c['price']);
        }
        return $contador;  
    }
    //Decrementa en una unidad un producto del carrito de ventas
    public function decrease($idproducto)
    {
        //Buscando y guardando el elemento en la colección
        $p = $this->carrito_venta->where('product_id', $idproducto)->first();
        //Calculando la nueva cantidad del producto
        $cantidad_nueva = $p['quantity'] - 1;

        if($cantidad_nueva > 0)
        {
            //Buscamos el elemento en la colección
            $result = $this->carrito_venta->where('product_id', $idproducto);
            //Eliminando la fila del elemento en la coleccion
            $this->carrito_venta->pull($result->keys()->first());
            //Insertando otra vez el producto con la cantidad actualizada
            $this->carrito_venta->push([
                'order' => $p['order'],
                'product_id' => $p['product_id'],
                'name' => $p['name'],
                'price' => $p['price'],
                'quantity'=> $cantidad_nueva,
                'id' => $p['id'],
            ]);
            //Actualizando la variable $this->message
            $this->message = "Cantidad Decrementada";
        }
        else
        {
            //Buscamos el elemento en la colección
            $result = $this->carrito_venta->where('product_id', $idproducto);
            //Eliminando la fila del elemento en la coleccion
            $this->carrito_venta->pull($result->keys()->first());
            //Actualizando la variable $this->message
            $this->message = "Producto Eliminado por que la cantidad a vender llego a 0";
        }
        //Mostrando mensaje toast
        $this->emit("message-ok");
    }
    //Incrementa en una unidad un producto ya existente del carrito de ventas
    public function increase($idproducto)
    {
        //Buscando y guardando el elemento en la colección
        $p = $this->carrito_venta->where('product_id', $idproducto)->first();
        //Calculando la nueva cantidad del producto
        $cantidad_nueva = $p['quantity'] + 1;

        if($this->stocktienda($idproducto,$cantidad_nueva))
        {
            //Buscamos el elemento en la colección
            $result = $this->carrito_venta->where('product_id', $idproducto);
            //Eliminando la fila del elemento en la coleccion
            $this->carrito_venta->pull($result->keys()->first());
            //Insertando otra vez el producto con la cantidad actualizada
            $this->carrito_venta->push([
                'order' => $p['order'],
                'product_id' => $p['product_id'],
                'name' => $p['name'],
                'price' => $p['price'],
                'quantity'=> $cantidad_nueva,
                'id' => $p['id'],
            ]);
            //Actualizando la variable $this->message
            $this->message = "Cantidad Incrementada";
            //Mostrando mensaje toast
            $this->emit("message-ok");
        }
        else
        {
            $this->modalstockinsuficiente($idproducto);
        }

    }
    //Inserta un producto no existente en el carrito de ventas
    public function insert($idproducto)
    {
        //Buscando el producto en el carrito de ventas
        $p = $this->carrito_venta->where('product_id', $idproducto);

        if($p->count() > 0)
        {
            $this->increase($idproducto);
        }
        else
        {
            if($this->stocktienda($idproducto,1))
            {
                $order = $this->carrito_venta->max('order') + 1;
                $producto = Product::find($idproducto);
                //Insertando el producto
                $this->carrito_venta->push([
                    'order' => $order,
                    'product_id' => $producto->id,
                    'name' => $producto->nombre,
                    'price' => $producto->precio_venta,
                    'quantity'=> 1,
                    'id' => $producto->id,
                ]);
                //Actualizando la variable $this->message
                $this->message = "¡Producto: " . $producto->nombre . " insertado exitósamente!";
                //Mostrando mensaje toast
                $this->emit("message-ok");
            }
            else
            {
                $this->modalstockinsuficiente($idproducto);
            }
        }
    }
    //Para verificar que quede stock disponible en la TIENDA para la venta
    public function stocktienda($idproducto, $cantidad)
    {
        //Buscando stock dispnible del producto en el destino TIENDA
        $producto = Destino::join("productos_destinos as pd", "pd.destino_id", "destinos.id")
        ->join("products as p", "p.id", "pd.product_id")
        ->select("destinos.id as id","destinos.nombre as nombredestino","pd.product_id as idproducto","pd.stock as stock")
        ->where("destinos.sucursal_id", $this->idsucursal())
        ->where('destinos.nombre', 'TIENDA')
        ->where('pd.product_id', $idproducto)
        ->where('p.status', 'ACTIVO')
        ->where('pd.stock','>=', $cantidad)
        ->get();


        if($producto->count() > 0)
        {
            //Variable donde se guardará el stock del producto del Carrito de Ventas
            $stock_cart = 0;
            //Para saber si el Producto ya esta en el carrrito
            $p = $this->carrito_venta->where('product_id', $idproducto);
            //Si el producto existe en el Carrito de Ventas actualizamos la variable $stock_cart
            if($p->count() > 0)
            {
                $stock_cart = $p->first()['quantity'];
            }
            //Restamos el stock de la tienda con el stock del Carrito de Ventas
            $stock = $producto->first()->stock - $stock_cart;
            if($stock > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
        
    }
    //Método para mostrar una ventana modal cuando no hay stock en Tienda de un producto
    public function modalstockinsuficiente($idproducto)
    {
        //Actualizando la variable $this->producto_id
        $this->producto_id = $idproducto;
        //Cambiando la variable $this->stock_disponible a false para que no se pueda mostrar la ventana modal finalizar venta
        $this->stock_disponible = false;
        //Buscamos stock disponible del producto en toda la sucursal menos en el destino TIENDA
        //Y actualizando la variable $this->listadestinos para guardar todos los destinos
        //de la sucursal (Menos Tienda) en los que existan stocks disponibles
        $this->listadestinos = Destino::join("productos_destinos as pd", "pd.destino_id", "destinos.id")
        ->join("products as p", "p.id", "pd.product_id")
        ->select("destinos.id as id","destinos.nombre as nombredestino","pd.product_id as idproducto","pd.stock as stock")
        ->where("destinos.sucursal_id", $this->idsucursal())
        ->where('destinos.nombre', '<>' ,'TIENDA')
        ->where('pd.product_id', $this->producto_id)
        ->where('p.status', 'ACTIVO')
        ->get();

        //Guardando el nombre del producto con 0 stock en tienda
        $this->nombreproducto = Product::find($idproducto)->nombre;
        $this->nombresucursal = Sucursal::find($this->idsucursal())->name;

        
        // Lista todas las sucursales menos la sucursal en la que esta el usuario
        $this->listasucursales = Sucursal::select("sucursals.*")
        ->where('sucursals.id', '<>' , $this->idsucursal())
        ->get();

        //Mostrando la ventana modal
        $this->emit('show-stockinsuficiente');
    }
    //Devuelve nombredestino y stock de una sucursal
    public function buscarstocksucursal($idsucursal)
    {
        $destinos = Destino::join("productos_destinos as pd", "pd.destino_id", "destinos.id")
                ->join("products as p", "p.id", "pd.product_id")
                ->select("destinos.id as id","destinos.nombre as nombredestino","pd.product_id as idproducto","pd.stock as stock")
                ->where("destinos.sucursal_id", $idsucursal)
                ->where('pd.product_id', $this->producto_id)
                ->where('p.status', 'ACTIVO')
                ->where('pd.stock','>', 0)
                ->get();
        return $destinos;
    }
    //Cierra la ventana modal Buscar Cliente y Cambia el id de la variable $cliente_id
    public function seleccionarcliente($idcliente)
    {
        $this->cliente_id = $idcliente;
        $this->nombrecliente = Cliente::find($idcliente)->nombre;
        $this->buscarcliente = "";
        $this->message = "Se seleccionó al cliente: '" . ucwords(strtolower($this->nombrecliente)) . "' para esta venta";
        $this->emit('hide-buscarcliente');
    }
    //Cierra la ventana modal Buscar Cliente y Cambia el id de la variable $cliente_id con un cliente Creado
    public function crearcliente()
    {
        if($this->cliente_celular == null)
        {
            $newclient = Cliente::create([
                'nombre' => $this->buscarcliente,
                'cedula' => $this->cliente_ci,
                'celular' => 0,
                'procedencia_cliente_id' => 1,
            ]);
        }
        else
        {
            $newclient = Cliente::create([
                'nombre' => $this->buscarcliente,
                'cedula' => $this->cliente_ci,
                'celular' => $this->cliente_celular,
                'procedencia_cliente_id' => 1,
        ]);
        }
        
        $this->cliente_id = $newclient->id;
        $this->nombrecliente = $newclient->nombre;
        $this->message = "Se selecciono al cliente creado: '" . $newclient->nombre . "'";
        //Ocultando ventana modal
        $this->emit('hide-buscarcliente');
    }
    //Poner la variable $clienteanonimo en true o false dependiendo el caso
    public function clienteanonimo()
    {
        if($this->clienteanonimo)
        {
            $this->clienteanonimo = false;
            $this->message = "Por favor cree o seleccione a un cliente, si no lo hace, se usará a un cliente anónimo";
            $this->emit('clienteanonimo-false');
        }
        else
        {
            $this->clienteanonimo = true;
            $this->cliente_id = $this->clienteanonimo_id();
            $this->message = "Se usará a un Cliente Anónimo para esta venta";
            $this->emit('clienteanonimo-true');
        }
    }
    //Método para guardar SI o NO en la variable $invoice para saber si una venta es con factura
    public function facturasino()
    {
        if($this->factura)
        {
            $this->invoice = "No";
            $this->factura = false;
            $this->message = "Venta con factura desactivada";
            $this->emit('message-ok');
        }
        else
        {
            $this->invoice = "Si";
            $this->factura = true;
            $this->message = "Venta con factura activada";
            $this->emit('message-ok');
        }
    }
    //Cambiar el precio de un producto del Carrito de Ventas
    public function cambiarprecio($idproducto, $precio_nuevo)
    {
        //Guardamos los datos del producto del Carrito de Ventas
        $product_cart = $this->carrito_venta->where('product_id', $idproducto)->first();
        if($precio_nuevo >= 0 && $precio_nuevo != "")
        {
            //Eliminamos el producto del Carrito de Ventas
            $this->clearproduct($idproducto);
            //Volvemos a añadir el producto con el precio actualizado

            //Insertando el producto
            $this->carrito_venta->push([
                'order' => $product_cart['order'],
                'product_id' => $product_cart['product_id'],
                'name' => $product_cart['name'],
                'price' => $precio_nuevo,
                'quantity'=> $product_cart['quantity'],
                'id' => $product_cart['id'],
            ]);
            //Actualizando la variable $this->message
            $this->message = "Precio Actualizado Exitósamente Producto: " . $product_cart['name'];
            //Mostrando mensaje toast
            $this->emit("message-ok");

        }
        else
        {
            $this->message = "El precio dado no esta admitido, se usará el precio de '" . $product_cart['price'] . " Bs'";
            //Eliminamos el producto del Carrito de Ventas
            $this->clearproduct($idproducto);
            
            //Volvemos a añadir el producto con el precio que tenia en el Carrito de Ventas
            $this->carrito_venta->push([
                'order' => $product_cart['order'],
                'product_id' => $product_cart['product_id'],
                'name' => $product_cart['name'],
                'price' => $product_cart['price'],
                'quantity'=> $product_cart['quantity'],
                'id' => $product_cart['id'],
            ]);
            //Actualizando la variable $this->message
            $this->message = "Precio no admitido, producto: " . $product_cart['name'];
            $this->emit('message-warning');
        }
    }
    //Cambiar la cantidad de un producto del Carrito de Ventas
    public function cambiarcantidad($idproducto, $cantidad_nueva)
    {
        //Actualizando la variable $this->cantidad_venta para mostrar cantidad en lotes en la ventana modal lotes productos
        $this->cantidad_venta = $cantidad_nueva;


        //Guardamos los datos del producto del Carrito de Ventas
        $product_cart = $this->carrito_venta->where('product_id', $idproducto)->first();
        if($this->stocktienda($idproducto, $cantidad_nueva))
        {
            if($cantidad_nueva > 0 && $cantidad_nueva != "")
            {
                //Eliminamos el producto del Carrito de Ventas
                $this->clearproduct($idproducto);
                //Insertando el producto
                $this->carrito_venta->push([
                    'order' => $product_cart['order'],
                    'product_id' => $product_cart['product_id'],
                    'name' => $product_cart['name'],
                    'price' => $product_cart['price'],
                    'quantity'=> $cantidad_nueva,
                    'id' => $product_cart['id'],
                ]);
                //Actualizando la variable $this->message
                $this->message = "Cantidad Actualizada Exitósamente Producto: " . $product_cart['name'];
                //Mostrando mensaje toast
                $this->emit('message-ok');
            }
            else
            {
                $this->message = "La cantidad dada no esta admitida, se usará la cantidad de '" . $product_cart->quantity . " unidades'";
                //Eliminamos el producto del Carrito de Ventas
                $this->clearproduct($idproducto);
                
                //Volvemos a añadir el producto con la cantidad que tenia en el Carrito de Ventas
                $this->carrito_venta->push([
                    'order' => $product_cart['order'],
                    'product_id' => $product_cart['product_id'],
                    'name' => $product_cart['name'],
                    'price' => $product_cart['price'],
                    'quantity'=> $product_cart['quantity'],
                    'id' => $product_cart['id'],
                ]);
                $this->emit('message-warning');
            }
        }
        else
        {   
            $this->modalstockinsuficiente($idproducto);
        }

        
    }
    //Actualiza la venta
    public function update_sale()
    {
        //Buscando la venta
        $venta = Sale::find($this->venta_id);

        $f = "Si";

        if($this->factura == false)
        {
            $f = "No";
        }
        
        //Actualizando Venta
        $venta->update([
            'tipopago' => Cartera::find($this->cartera_id)->nombre,
            'factura' => $f,
            'cartera_id' => $this->cartera_id,
            'observacion' => $this->observacion,
        ]);
        $venta->save();

        //ACTUALIZANDO EL TIPO DE PAGO
        //Buscando el id de la cartera movimiento
        $cartera_mov_id = CarteraMov::join("movimientos as m","m.id","cartera_movs.movimiento_id")
        ->join("sales as s","s.movimiento_id","m.id")
        ->select("cartera_movs.id as idcarteramov")
        ->where("s.id",$this->venta_id)
        ->get()
        ->first();
        $cartera_mov = CarteraMov::find($cartera_mov_id->idcarteramov);
        //Actualizando el id de la cartera movimiento
        $cartera_mov->update([
            'cartera_id' => $this->cartera_id
        ]);
        $cartera_mov->save();
        //-------------------------------------


        //ACTUALIZANDO EL ID DEL CLIENTE
        $cliente_mov_id = ClienteMov::join("movimientos as m","m.id","cliente_movs.movimiento_id")
        ->join("sales as s","s.movimiento_id","m.id")
        ->where("s.id",$this->venta_id)
        ->select("cliente_movs.id as idclientemov")
        ->get()
        ->first();
        $cliente_mov = ClienteMov::find($cliente_mov_id->idclientemov);
        //Actualizando el id de la cartera movimiento
        $cliente_mov->update([
            'cliente_id' => $this->cliente_id
        ]);
        $cliente_mov->save();
        //-----------------------------------









        //ACTUALIZANDO DETALLE DE VENTA
        //Obteniendo los detalles de la venta
        $detalle_venta = SaleDetail::where("sale_details.sale_id", $this->venta_id)->get();





        //Eliminando todos los detalles de venta y lote venta
        foreach($detalle_venta as $d)
        {

            //INCREMENTANDO LOTES


            //Obteniendo todos los registros de la tabla sale lotes que tengan el id detalle venta
            $sale_lote_i = SaleLote::where("sale_lotes.sale_detail_id", $d->id)->get();

            foreach($sale_lote_i as $l_i)
            {
                //Buscando el lote
                $lote_i = Lote::find($l_i->lote_id);

                //Obteniendo la existencia actual del lote
                $existencia_i = $lote_i->existencia;

                //Incrementando la existencia en el lote, sumando la existencia con la cantidad registrada en sale_lote
                $existencia_i = $existencia_i + $l_i->cantidad;

                //Actualizando el lote con la nueva existencia
                $lote_i->update([
                    'existencia' => $existencia_i,
                    'status' => 'ACTIVO'
                    ]);
                $lote_i->save();


                //Eliminando Sale Lotes
                $l_i->delete();
            }




            //INCREMENTANDO STOCK EN TIENDA
            $tiendaproducto = ProductosDestino::join("products as p", "p.id", "productos_destinos.product_id")
            ->join('destinos as des', 'des.id', 'productos_destinos.destino_id')
            ->select("productos_destinos.id as id","p.nombre as name",
            "productos_destinos.stock as stock")
            ->where("p.id", $d->product_id)
            ->where("des.nombre", 'TIENDA')
            ->where("des.sucursal_id", $this->idsucursal())
            ->get()->first();


            $tiendaproducto->update([
                'stock' => $tiendaproducto->stock + $d->quantity
            ]);
            

            //Eliminando Detalle de ventas
            $d->delete();



        }





        //Creando nuevos detalles de venta y lotes venta
        foreach($this->carrito_venta as $p)
        {
            $sd = SaleDetail::create([
                'price' => $p['price'],
                'quantity' => $p['quantity'],
                'product_id' => $p['id'],
                'sale_id' => $venta->id,
            ]);





            //DECREMENTANDO LOTES

            //Para obtener la cantidad del producto que se va a vender
            $cantidad_producto_venta = $p['quantity'];

            //Buscamos todos los lotes que tengan ese producto oredenados por fecha de creación
            $lotes_d = Lote::where('lotes.product_id', $p['id'])->where('status','Activo')->orderBy('lotes.created_at','asc')->get();

            //Recorremos todos los lotes que tengan ese producto
            foreach($lotes_d as $l_d)
            {
                //Obtenemos la cantidad de existencia que tenga ese lote de ese producto
                $cantidad_producto_lote = $l_d->existencia;

                //Si la cantidad del producto para la venta supera la existencia en el lote
                //Vaciamos toda la existencia de ese lote y lo inactivamos
                if($cantidad_producto_venta > $cantidad_producto_lote)
                {
                    //Creamos un registro en la tabla SaleLote con la cantidad total del producto en el lote
                    $sale_lote = SaleLote::create([
                        'sale_detail_id' => $sd->id,
                        'lote_id' => $l_d->id,
                        'cantidad' => $cantidad_producto_lote
                    ]);
                    //Dismunuimos la cantidad del producto para la venta por el total cantidad del producto en el lote
                    $cantidad_producto_venta = $cantidad_producto_venta - $cantidad_producto_lote;


                    //Actualizamos el lote
                    $l_d->update([
                        'existencia' => 0,
                        'status' => 'Inactivo'
                        ]);
                    $l_d->save();
                }
                else
                {
                    //Si la cantidad del producto para la venta no supera la existencia en el lote
                    //Reducimos la existencia de ese lote por la cantidad del producto para la venta
                    SaleLote::create([
                        'sale_detail_id' => $sd->id,
                        'lote_id' => $l_d->id,
                        'cantidad' => $cantidad_producto_venta
                    ]);

                    $l_d->update([ 
                        'existencia'=> $cantidad_producto_lote - $cantidad_producto_venta
                    ]);
                    $l_d->save();
                    $cantidad_producto_venta = 0;
                }
            }






















            //DECREMENTANDO STOCK EN TIENDA
            $tiendaproducto = ProductosDestino::join("products as p", "p.id", "productos_destinos.product_id")
            ->join('destinos as des', 'des.id', 'productos_destinos.destino_id')
            ->select("productos_destinos.id as id","p.nombre as name",
            "productos_destinos.stock as stock")
            ->where("p.id", $p['id'])
            ->where("des.nombre", 'TIENDA')
            ->where("des.sucursal_id", $this->idsucursal())
            ->get()->first();


            $tiendaproducto->update([
                'stock' => $tiendaproducto->stock - $p['quantity']
            ]);

        }











        $this->redirect('salelist');


    }
    //Escucha los eventos JavaScript de la vista (saleedit.blade.php)
    protected $listeners = [
        'scan-code' => 'ScanCode',
        'clear-Cart' => 'clearcart',
        'clear-product' => 'clearproduct',
        'save-sale' => 'savesale'
    ];
    //Elimina un producto de la colección carrito de ventas
    public function clearproduct($idproducto)
    {
        //Buscamos el elemento en la colección
        $result = $this->carrito_venta->where('product_id', $idproducto);
        //Eliminando la fila del elemento en la coleccion
        $this->carrito_venta->pull($result->keys()->first());

        $nombre_producto = Product::find($idproducto)->nombre;

        //Actualizando la variable $this->message
        $this->message = "Eliminado: '" . $nombre_producto . "'";
        //Mostrando mensaje toast
        $this->emit("message-ok");

    }
    //Vaciar todos los Items en el Carrito
    public function clearcart()
    {
        $this->carrito_venta = collect([]);
        $this->emit('cart-clear');
    }
}
