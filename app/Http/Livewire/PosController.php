<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\CarteraMov;
use App\Models\CarteraMovCategoria;
use App\Models\Denomination;
use App\Models\Product;
use Livewire\Component;
use App\Models\Cliente;
use App\Models\ClienteMov;
use App\Models\Company;
use App\Models\Cotization;
use App\Models\CotizationDetail;
use App\Models\Destino;
use App\Models\DestinoSucursal;
use App\Models\DetalleEntradaProductos;
use App\Models\IngresoProductos;
use App\Models\Lote;
use App\Models\Movimiento;
use App\Models\OperacionesCarterasCompartidas;
use App\Models\ProcedenciaCliente;
use App\Models\ProductosDestino;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\SaleDevolution;
use App\Models\SaleLote;
use App\Models\Sucursal;
use App\Models\User;
use Carbon\Carbon;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\WithPagination;

class PosController extends Component
{
    //VARIABLES PARA LOS ELEMENTOS QUE ESTAN EN LA PARTE SUPERIOR DE LA VISTA DE UNA VENTA

    //Variable para guardar true o false para tenor o no un cliente anónimo
    public $clienteanonimo;
    //Variable para guardar el id del cliente
    public $cliente_id;
    //Total Bs en una Venta
    public $total_bs;
    //Cantidad Total de Productos en una Venta
    public $total_items;
    //id de la cartera seleccionada
    public $cartera_id;
    //Variables para saber si la venta es o no con factura
    public $factura, $invoice;
    //Variables para crear o no comprobante pdf de la venta
    public $pdf, $a;
    //Para guardar alguna observación en la venta
    public $observacion;
    //id de una venta
    public $venta_id;
    //Variable para poner la cantidad de filas en las tablas
    public $paginacion;
    //Variable para Buscar por el Nombre o Código los Productos
    public $buscarproducto;
    //Variable para Buscar por el Nombre o Código a los Clientes
    public $buscarcliente;
    //Variable para mostrar en un Mensaje Toast (Mensaje Emergente Arriba a la derecha en la Pantalla)
    public $mensaje_toast;
    //Variable para guardar la cantidad de dinero y cambio que se debe dar al cliente en una venta
    public $dinero_recibido, $cambio;
    //Lista de destinos dentro de la sucursal (menos tienda) para mostrar en la ventana nodal stock insuficiente
    public $listadestinos;
    //Para guardar el nombre de un producto
    public $nombreproducto;
    //Para guardar el nombre de una sucursal
    public $nombresucursal;
    // Para guardar una lista de todas  las sucursales menos en la que esta el usuario
    public $listasucursales;
    // Para no mostrar la ventana modal finalizar venta en caso de que algun producto se quiera
    // vender con un stock mayor al que se tenga disponible en tienda
    public $stock_disponible;
    //Variables para el Descuento o Recargo en Venta...
    public $descuento_recargo;
    //Variables para crear un cliente
    public $cliente_ci, $cliente_celular;
    //Para verificar que tenga un corte de caja
    public $corte_caja;
    //Guardar el id de un producto
    public $producto_id;
    //Guarda todos los lotes activos de un producto
    public $lotes_producto;
    //Guarda el promedio de precio de un producto para la ventana modal lotes producto
    public $precio_promedio;
    //Guarda la candidad de un producto para la venta
    public $cantidad_venta;
    //Lista la tabla procedencias de clientes
    public $procedencias;
    //Guarda el id de la tabla procedencia clientes
    public $procedencia_cliente_id;
    //Guarda el id Destino de donde se sacaran las ventas
    public $destino_id;
    //variable para guardar el id de caja abierta
    public $caja_abierta_id;
    //Variable para guardar true o false en caso de querer vender cantidades fuera del stock disponible
    public $selloutofstock;
    //Cantidad extra a vender de un determinado producto
    public $extraquantity;
    //Guarda el id de una cotizacion
    public $cotization_id;
    public $page = 1;
    //Variable que guarda lo que hay que buscar en una devolucion en venta
    public $search_devolution, $date_from_devolution, $date_of_devolution;
    //Variable que guarda el id y nombre del producto para devolución
    public $product_id_devolution, $product_name_devolution, $sale_id_devolution, $detail_devolution,
     $list_destinations_devolution, $destiny_id_devolution, $quantity_devolution, $sale_detail_id_devolution, $amount_devolution,
     $list_categories_devolution, $category_id_devolution, $cartera_id_devolution;


    //VARIABLES PARA LOS INGRESOS Y EGRESOS
    public $cartera_id_ie, $tipo_movimiento_ie, $cantidad_ie, $detallecategoria, $categoria_id_ie, $comentario;


    //Cotizacion
    public $finaldatecotization, $product_cost;


    use WithPagination;
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function mount()
    {
        $this->category_id_devolution = 9;
        $this->list_categories_devolution = CarteraMovCategoria::where("tipo", "EGRESO")->where("status","ACTIVO")->get();
        $this->destiny_id_devolution = 1;
        $this->list_destinations_devolution = Destino::where("sucursal_id", $this->idsucursal())->get();
        $this->date_from_devolution = Carbon::now()->subDays(4)->format('Y-m-d');
        $this->date_of_devolution = Carbon::parse(Carbon::now())->format('Y-m-d');


        $this->extraquantity = 1;
        $this->selloutofstock = true;
        $this->finaldatecotization = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->tipo_movimiento_ie = "Elegir";
        $this->cartera_id_ie = "Elegir";
        $this->categoria_id_ie = "Elegir";
        /* Caja en la cual se encuentra el usuario */
        $cajausuario = Caja::join('sucursals as s', 's.id', 'cajas.sucursal_id')
            ->join('sucursal_users as su', 'su.sucursal_id', 's.id')
            ->join('carteras as car', 'cajas.id', 'car.caja_id')
            ->join('cartera_movs as cartmovs', 'car.id', 'cartmovs.cartera_id')
            ->join('movimientos as mov', 'mov.id', 'cartmovs.movimiento_id')
            ->where('mov.user_id', Auth()->user()->id)
            ->where('mov.status', 'ACTIVO')
            ->where('mov.type', 'APERTURA')
            ->select('cajas.id as id')
            ->get();


        if ($cajausuario->count() > 0) {
            $this->corte_caja = true;
            $this->caja_abierta_id = $cajausuario->first()->id;
        } else {
            $this->corte_caja = false;
        }

        $this->destino_id = DestinoSucursal::where("destino_sucursals.sucursal_id", $this->idsucursal())->first()->destino_id;


        $this->paginacion = 10;
        $this->descuento_recargo = 0;
        // $this->total_bs = Cart::getTotal();
        $this->total_bs = $this->gettotalcart();
        $this->total_items = Cart::getTotalQuantity();
        $this->factura = false;
        $this->clienteanonimo = false;
        $this->cartera_id = 'Elegir';
        $this->observacion = "";
        $this->lotes_producto = [];
        $this->precio_promedio = 0;
        foreach ($this->listarcarteras() as $list) {
            if ($list->tipo == 'efectivo') {
                $this->cartera_id = $list->idcartera;
                break;
            }
        }
        $this->cartera_id_devolution = $this->cartera_id;
        $this->cliente_id = $this->clienteanonimo_id();
        $this->listadestinos = [];
        $this->listasucursales = [];
        $this->nombresucursal = "";
        $this->pdf = false;
        $this->stock_disponible = true;
    }
    public function render()
    {
        if ($this->categoria_id_ie != "Elegir")
        {
            $this->detallecategoria = CarteraMovCategoria::find($this->categoria_id_ie)->detalle;
        }


        //Categorias para Ingresos y Egresos
        $categorias_ie = CarteraMovCategoria::where("cartera_mov_categorias.tipo", $this->tipo_movimiento_ie)->get();

        /* Caja en la cual se encuentra el usuario */
        $cajausuario = Caja::join('sucursals as s', 's.id', 'cajas.sucursal_id')
            ->join('sucursal_users as su', 'su.sucursal_id', 's.id')
            ->join('carteras as car', 'cajas.id', 'car.caja_id')
            ->join('cartera_movs as cartmovs', 'car.id', 'cartmovs.cartera_id')
            ->join('movimientos as mov', 'mov.id', 'cartmovs.movimiento_id')
            ->where('mov.user_id', Auth()->user()->id)
            ->where('mov.status', 'ACTIVO')
            ->where('mov.type', 'APERTURA')
            ->select('cajas.id as id')
            ->get();



        if ($cajausuario->count() > 0) {
            $this->corte_caja = true;
            $this->caja_abierta_id = $cajausuario->first()->id;
        } else {
            $this->corte_caja = false;
        }


        //Variable para guardar todos los productos encontrados que contengan el nombre o código en $buscarproducto
        $listaproductos = [];
        if ($this->buscarproducto != "")
        {
            $listaproductos = Product::distinct()
            ->join("productos_destinos as pd", "pd.product_id", "products.id")
            ->select(
                    "products.id as id",
                    "products.nombre as nombre",
                    "products.image as image",
                    "products.precio_venta as precio_venta",
                    "products.codigo as barcode",
                    "products.status as estado"
                )
                ->where(function ($query) {
                    $query->where('products.nombre', 'like', '%' . $this->buscarproducto . '%')
                        ->orWhere('products.codigo', 'like', '%' . $this->buscarproducto . '%');
                })
                ->paginate($this->paginacion);
            // $this->resetPage();

        }
        //---------------------------------------------------------------------------------------------------------
        //Modulo para Calcular el Cambio
        if ($this->dinero_recibido < 0 || $this->dinero_recibido == "-")
        {
            $this->dinero_recibido = 0;
        }
        if ($this->dinero_recibido != "")
        {
            $this->cambio = $this->dinero_recibido - $this->total_bs;
        }
        //---------------------------------------------------------------
        //Modulo para cambiar a si o no la variable $invoice (Factura)
        if ($this->factura)
        {
            $this->invoice = "Si";
        }
        else
        {
            $this->invoice = "No";
        }
        //---------------------------------------------------------------
        //Lista a todos los clientes que tengan el nombre de la variable $this->buscarcliente
        $listaclientes = [];
        if (strlen($this->buscarcliente) > 0)
        {
            $listaclientes = Cliente::select("clientes.*")
            ->where('clientes.nombre', 'like', '%' . $this->buscarcliente . '%')
            ->orderBy("clientes.created_at", "desc")
            ->get();
        }

        //Actualizar los valores de Total Bs y Total Artículos en una Venta
        $this->actualizarvalores();




        //Devolución en Ventas
        $list_sales_devolution = Sale::join("sale_details as sd","sd.sale_id","sales.id")
        ->join("users as u","u.id","sales.user_id")
        ->join("carteras as c","c.id","sales.cartera_id")
        ->join("sucursals as s","s.id","sales.sucursal_id")
        ->join("products as p","p.id","sd.product_id")
        ->select("sales.id as code","sales.created_at as created","sales.total as total","u.name as user",
        "c.nombre as wallet","s.name as branch", DB::raw('0 as saledetail'))
        ->where("sales.status","PAID")
        ->whereBetween('sales.created_at', [$this->date_from_devolution . ' 00:00:00', $this->date_of_devolution . ' 23:59:59'])
        ->where(function ($query) {
            $query->where('p.nombre', 'like', '%' . $this->search_devolution . '%')
            ->orWhere('p.codigo', 'like', '%' . $this->search_devolution . '%')
            ->orWhere('sales.id', 'like', '%' . $this->search_devolution . '%');
        })
        ->distinct()
        ->orderBy("sales.created_at", "desc")
        ->paginate(10);

        foreach($list_sales_devolution as $s)
        {
            if($s->code == $this->sale_id_devolution)
            {
                $s->saledetail = SaleDetail::join("products as p","p.id","sale_details.product_id")
                ->select("p.nombre as name_product","sale_details.price as price","sale_details.id as idsaledetail","sale_details.quantity as quantity","p.codigo as code_product")
                ->where("sale_details.sale_id",$s->code)
                ->get();
            }
        }


        //------------------




        return view('livewire.pos.component', [
            'denominations' => Denomination::orderBy('id', 'asc')->get(),
            'listaproductos' => $listaproductos,
            'cart' => Cart::getContent()->sortBy('name'),
            'carteras' => $this->listarcarteras(),
            'carterasg' => $this->listarcarterasg(),
            'listaclientes' => $listaclientes,
            'nombrecliente' => Cliente::find($this->cliente_id)->nombre,
            'nombrecartera' => $this->nombrecartera(),
            'categorias_ie' => $categorias_ie,
            'list_sales_devolution' => $list_sales_devolution

        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    //Obtener el Id de la Sucursal donde esta el Usuario
    public function idsucursal()
    {
        $idsucursal = User::join("sucursal_users as su", "su.user_id", "users.id")
            ->select("su.sucursal_id as id", "users.name as n")
            ->where("users.id", Auth()->user()->id)
            ->where("su.estado", "ACTIVO")
            ->get()
            ->first();
        return $idsucursal->id;
    }
    //Poner la variable $clienteanonimo en true o false dependiendo el caso
    public function clienteanonimo()
    {
        if ($this->clienteanonimo) {
            $this->clienteanonimo = false;
            $this->mensaje_toast = "Por favor cree o seleccione a un cliente, si no lo hace, se usará a un cliente anónimo";
            $this->emit('clienteanonimo-false');
        }
        else
        {
            $this->clienteanonimo = true;
            $this->cliente_id = $this->clienteanonimo_id();
            $this->mensaje_toast = "Se usará a un Cliente Anónimo para esta venta";
            $this->emit('clienteanonimo-true');
        }
    }
    //Obtener el id de un cliente anónimo, si no existe creará uno
    public function clienteanonimo_id()
    {
        $client = Cliente::select('clientes.nombre as nombrecliente', 'clientes.id as idcliente')
            ->where('clientes.nombre', 'Cliente Anónimo')
            ->get();

        if ($client->count() > 0)
        {
            return $client->first()->idcliente;
        }
        else
        {
            $procedencia = ProcedenciaCliente::where('procedencia_clientes.procedencia', 'Venta')
                ->get();
            if ($procedencia->count() > 0) {
                $cliente_anonimo = Cliente::create([
                    'nombre' => "Cliente Anónimo",
                    'procedencia_cliente_id' => $procedencia->first()->id
                ]);
                return $cliente_anonimo->id;
            }
            else
            {
                $procedencia = ProcedenciaCliente::create([
                    'procedencia' => "Venta"
                ]);
                $cliente_anonimo = Cliente::create([
                    'nombre' => "Cliente Anónimo",
                    'procedencia_cliente_id' => $procedencia->id
                ]);
                return $cliente_anonimo->id;
            }
        }
    }
    //Cierra la ventana modal Buscar Cliente y Cambia el id de la variable $cliente_id
    public function seleccionarcliente($idcliente)
    {
        $this->cliente_id = $idcliente;
        $nombrecliente = Cliente::find($idcliente)->nombre;
        $this->mensaje_toast = "Se seleccionó al cliente: '" . ucwords(strtolower($nombrecliente)) . "' para esta venta";
        $this->emit('hide-buscarcliente');
    }
    //Incrementar Items en el Carrito de Ventas
    public function increase(Product $producto)
    {
        $product_cart = Cart::get($producto->id);
        //Verificamos que exista stock en la TIENDA de la sucursal
        if ($this->stocktienda($producto->id, 1))
        {
            //Para saber si el Producto ya esta en el carrrito para cambiar el Mensaje Toast de Producto Agregado a Cantidad Actualizada
            if ($product_cart) {
                $this->mensaje_toast = "¡Cantidad Actualizada: '" . strtolower($producto->nombre) . "'!";
                if ($producto->image == null)
                {
                    Cart::add($product_cart->id, $product_cart->name, $product_cart->price, 1, 'noimgproduct.png');
                    $this->emit('increase-ok');
                } 
                else
                {
                    Cart::add($product_cart->id, $product_cart->name, $product_cart->price, 1, $producto->image);
                    $this->emit('increase-ok');
                }
            }
            else
            {

                $precio = Lote::select("lotes.pv_lote as pv")
                ->where("lotes.product_id", $producto->id)
                // ->where("lotes.status","Activo")
                ->orderby("lotes.created_at", "desc")
                ->get();


                if($precio->count() > 0)
                {
                    $precio = $precio->first()->pv;
                }
                else
                {
                    $precio = 0;
                }

                $this->mensaje_toast = "¡Agregado correctamente: '" . $producto->nombre . "'!";
                if ($producto->image == null)
                {
                    Cart::add($producto->id, $producto->nombre, $precio, 1, 'noimgproduct.png');
                    $this->emit('increase-ok');
                }
                else
                {
                    Cart::add($producto->id, $producto->nombre, $precio, 1, $producto->image);
                    $this->emit('increase-ok');
                }
            }
            //Actualizar los valores de Total Bs y Total Artículos en una Venta
            $this->actualizarvalores();
        }
        else
        {
            $this->modalstockinsuficiente($producto->id);
        }
    }
    //Decrementar Items en el Carrito de Ventas
    public function decrease(Product $producto)
    {
        try
        {
            //Guardamos los datos del producto en Carrito de Ventas
            $product_cart = Cart::get($producto->id);

            //Obteniendo la cantidad extra que se debe incrementar (en caso de que se nesecite) en los lotes, cuando se quiera vender mas alla del stock disponible
            $cantidad_previa = $product_cart->attributes->Cantidad;

            if($cantidad_previa)
            {
                $cantida_nueva = $cantidad_previa - 1;
                if($cantida_nueva == 0)
                {
                    $miArray = array(
                        "Imagen" => "noimgproduct.png"
                    );
                }
                else
                {
                    $miArray = array(
                        "Imagen" => $producto->image,
                        "Cantidad" => $cantidad_previa - 1,
                        "Costo" => $this->product_cost
                    );
                }
            }
            else
            {
                if($producto->image == null)
                {
                    $miArray = array(
                        "Imagen" => "noimgproduct.png"
                    );
                }
                else
                {
                    $miArray = array(
                        "Imagen" => $producto->image
                    );
                }
            }
            //Elimnamos el producto del Carrito de Ventas
            Cart::remove($producto->id);
            //Obtenmos la cantidad que existia del producto en el Carrito de Ventas
            $cant = $product_cart->quantity - 1;
            //Volvemos a añadir el produto al Carrito de Ventas pero con la cantidad actualizada
            if ($cant > 0) {
                Cart::add($product_cart->id, $product_cart->name, $product_cart->price, $cant, $miArray);
                // $this->total = Cart::getTotal();
                $this->total = $this->gettotalcart();
                $this->itemsQuantity = Cart::getTotalQuantity();
                $this->emit('scan-ok', 'Cantidad actualizada');
            }
            //Actualizamos Valores (Unidades y Bs de la Venta)
            $this->actualizarvalores();
        }
        catch (Exception $e)
        {
            $this->mensaje_toast = "Por favor no realize tantos clicks";
            $this->emit('message-error-sale');
        }
    }
    //Para verificar que quede stock disponible en la TIENDA para la venta
    public function stocktienda($idproducto, $cantidad)
    {
        //Primero buscamos stock dispnible del producto en el destino TIENDA
        $producto = Destino::join("productos_destinos as pd", "pd.destino_id", "destinos.id")
            ->join("products as p", "p.id", "pd.product_id")
            ->select("destinos.id as id", "destinos.nombre as nombredestino", "pd.product_id as idproducto", "pd.stock as stock")
            ->where("destinos.sucursal_id", $this->idsucursal())
            ->where('destinos.id', $this->destino_id)
            ->where('pd.product_id', $idproducto)
            ->where('p.status', 'ACTIVO')
            ->where('pd.stock', '>=', $cantidad)
            ->get();


        if ($producto->count() > 0) {
            //Variable donde se guardará el stock del producto del Carrito de Ventas
            $stock_cart = 0;
            //Para saber si el Producto ya esta en el carrrito
            $exist = Cart::get($idproducto);
            //Si el producto existe en el Carrito de Ventas actualizamos la variable $stock_cart
            if ($exist) {
                $stock_cart = Cart::get($idproducto)->quantity;
            }
            //Restamos el stock de la tienda con el stock del Carrito de Ventas


            $stock = $producto->first()->stock - $stock_cart;
            if ($stock > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //Llama al modal para calcular cambio y finalizar una venta
    public function modalfinalizarventa()
    {
        // Solo si la variable $this->stock_disponible es true e mostrara la ventana modal
        if ($this->stock_disponible)
        {
            if ($this->cartera_id != "Elegir")
            {
                if ($this->stock_disponible)
                {
                    $this->emit('show-finalizarventa');
                }
            }
            else
            {
                $this->emit('show-elegircartera');
            }
        }
        else
        {
            $this->stock_disponible = true;
        }
    }
    protected $listeners = [
        'scan-code' => 'ScanCode',
        'clear-Cart' => 'clearcart',
        'clear-Product' => 'clearproduct',
        'saveSale' => 'savesale'
    ];
    //Recibe el codigo del producto para ponerlo en el Carrito de Ventas (Carrito de Ventas)
    public function ScanCode($barcode, $cant = 1)
    {
        //Buscando Stock del Producto en Tienda
        $product = Product::join("productos_destinos as pd", "pd.product_id", "products.id")
            ->join('destinos as des', 'des.id', 'pd.destino_id')
            ->select(
                "products.id as id",
                "products.image as image",
                "des.sucursal_id as sucursal_id",
                "products.nombre as name",
                "products.precio_venta as price",
                "products.codigo",
                "pd.stock as stock"
            )
            ->where("products.codigo", $barcode)
            ->where("des.id", $this->destino_id)
            ->where("des.sucursal_id", $this->idsucursal())
            ->get()->first();


        if ($product == null || empty($product)) {
            $this->mensaje_toast = "El producto con el código '" . $barcode . "' no existe o no esta registrado";
            $this->emit('increase-notfound');
        } else {
            if ($this->stocktienda($product->id, $cant)) {
                //Añadiendo al Carrrito los Productos
                Cart::add(
                    $product->id,
                    $product->name,
                    $product->price,
                    $cant,
                    $product->image
                );
                $this->actualizarvalores();
                $this->mensaje_toast = "¡Producto: '" . $product->name . "' escaneado correctamente!";
                $this->emit('increase-ok');
            } else {
                $this->modalstockinsuficiente($product->id);
            }
        }
    }
    //Vaciar todos los Items en el Carrito
    public function clearcart()
    {
        Cart::clear();
        $this->actualizarvalores();
        $this->emit('cart-clear');
    }
    //Eliminar un producto del Carrito de Ventas
    public function clearproduct(Product $producto)
    {
        //Eliminamos el producto del Carrito de Ventas
        Cart::remove($producto->id);
        $this->mensaje_toast = "Eliminado: '" . $producto->nombre . "'";
        //mostrando mensaje toast
        $this->emit('mensaje-ok');
    }
    //Actualizar los valores de Total Bs y Total Artículos en una Venta
    public function actualizarvalores()
    {
        // $this->total_bs = Cart::getTotal();
        $this->total_bs = $this->gettotalcart();
        $this->total_items = Cart::getTotalQuantity();
        $this->actualizar_desc_recar();
    }
    //Sumar Denominaciones de Monedas y Billetes a la variable $dinero_recibido
    public function sumar($value)
    {
        if ($value == 0) {
            $this->dinero_recibido = $this->total_bs;
        } else {
            if ($this->dinero_recibido == "") {
                $this->dinero_recibido = 0;
            }
            $this->dinero_recibido = $this->dinero_recibido + $value;
        }
    }
    //Guardar una venta
    public function savesale()
    {
        DB::beginTransaction();
        try
        {
            //Creando Movimiento
            $Movimiento = Movimiento::create([
                'type' => "VENTAS",
                'import' => $this->total_bs,
                'user_id' => Auth()->user()->id,
            ]);
            //Creando Cliente Movimiento
            ClienteMov::create([
                'movimiento_id' => $Movimiento->id,
                'cliente_id' => $this->cliente_id,
            ]);
            //Para saber toda la informacionde del id de la cartera seleccionada
            $cartera = Cartera::find($this->cartera_id);

            $saldo_cartera = $cartera->saldocartera + $this->total_bs;

            //Actualizamos el saldo de la cartera
            $cartera->update([
                'saldocartera' => $saldo_cartera
            ]);
            $cartera->save();

            //Creando la venta
            $sale = Sale::create([
                'total' => $this->total_bs,
                'items' => $this->total_items,
                'cash' => $this->dinero_recibido,
                'change' => $this->cambio,
                'tipopago' => "",
                'factura' => $this->invoice,
                'cartera_id' => $cartera->id,
                'sucursal_id' => $this->idsucursal(),
                'observacion' => $this->observacion,
                'movimiento_id' => $Movimiento->id,
                'user_id' => Auth()->user()->id
            ]);
            //Actualizando la variable $this->venta_id para poder crear un comprobante de venta
            $this->venta_id = $sale->id;


            //Obteniendo todos los productos del Carrito de Ventas (Carrito de Ventas)
            $productos = Cart::getContent();

            //Variable que guarda que si existe productos con stock mas allá del disponible
            $stock_extra = false;

            //Verificando si entre los productos a vender se tiene alguno que tenga stock extra (Cantidad mas allá del disposable)
            foreach ($productos as $pp)
            {
                if ($pp->attributes->Cantidad > 0)
                {
                    //Registrando Ingreso Producto
                    $ip = IngresoProductos::create([
                        'destino' => $this->destino_id,
                        'user_id' => Auth()->user()->id,
                        'concepto' => "INGRESO",
                        'observacion' => "Ingreso automático del producto para venta rápida",
                    ]);
                    $stock_extra = true;
                    break;
                }
            }

            if($stock_extra)
            {
                foreach ($productos as $ppp)
                {
                    $precio_producto = Lote::select("pv_lote")
                    ->where("lotes.product_id",$ppp->id)
                    ->orderBy("lotes.created_at","desc")
                    ->first()->pv_lote;
                    //Creando el Lote
                    $l = Lote::create([
                        'existencia' => $ppp->attributes->Cantidad,
                        'costo' => $ppp->attributes->Costo,
                        'pv_lote' => $precio_producto,
                        'status' => 'Activo',
                        'product_id' => $ppp->id
                    ]);
                    //Creando Detalle entrada producto
                    DetalleEntradaProductos::create([
                        'product_id' => $ppp->id,
                        'cantidad' => $ppp->attributes->Cantidad,
                        'costo' => $ppp->attributes->Costo,
                        'id_entrada' => $ip->id,
                        'lote_id' => $l->id
                    ]);
                    //Incrementando el Stock en Tienda
                    $tiendaproducto = ProductosDestino::join("products as p", "p.id", "productos_destinos.product_id")
                    ->join('destinos as des', 'des.id', 'productos_destinos.destino_id')
                    ->select("productos_destinos.id as id","p.nombre as name",
                    "productos_destinos.stock as stock")
                    ->where("p.id", $ppp->id)
                    ->where("des.id", $this->destino_id)
                    ->where("des.sucursal_id", $this->idsucursal())
                    ->get()->first();
                    $tiendaproducto->update([
                        'stock' => $tiendaproducto->stock + $ppp->attributes->Cantidad
                    ]);
                }
            }

            foreach ($productos as $p)
            { 
                $precio_original = Lote::select("lotes.pv_lote as po")
                ->where("lotes.product_id", $p->id)
                ->where("lotes.status", "Activo")
                ->orderBy("lotes.created_at", "desc")
                ->get();
                
                if($precio_original->count() > 0)
                {
                    $sd = SaleDetail::create([
                        'original_price' => $precio_original->first()->po,
                        'price' => $p->price,
                        'cost' => 0,
                        'quantity' => $p->quantity,
                        'product_id' => $p->id,
                        'sale_id' => $sale->id,
                    ]);
                }
                else
                {
                    $sd = SaleDetail::create([
                        'original_price' => 0,
                        'price' => $p->price,
                        'cost' => 0,
                        'quantity' => $p->quantity,
                        'product_id' => $p->id,
                        'sale_id' => $sale->id,
                    ]);
                }

                //Para obtener la cantidad del producto que se va a vender
                $cantidad_producto_venta = $p->quantity;

                //Buscamos todos los lotes que tengan ese producto
                $lotes = Lote::where('product_id', $p->id)->where('status', 'Activo')->get();

                //Recorremos todos los lotes que tengan ese producto
                foreach ($lotes as $l)
                {
                    //Obtenemos la cantidad de existencia que tenga ese lote de ese producto
                    $cantidad_producto_lote = $l->existencia;

                    //Si la cantidad del producto para la venta supera la existencia en el lote
                    //Vaciamos toda la existencia de ese lote y lo inactivamos
                    if ($cantidad_producto_venta > $cantidad_producto_lote)
                    {
                        //Creamos un registro en la tabla SaleLote con la cantidad total del producto en el lote
                        $sale_lote = SaleLote::create([
                            'sale_detail_id' => $sd->id,
                            'lote_id' => $l->id,
                            'cantidad' => $cantidad_producto_lote
                        ]);
                        //Dismunuimos la cantidad del producto para la venta por el total cantidad del producto en el lote
                        $cantidad_producto_venta = $cantidad_producto_venta - $cantidad_producto_lote;


                        //Actualizamos el lote
                        $l->update([
                            'existencia' => 0,
                            'status' => 'Inactivo'
                        ]);
                        $l->save();
                    }
                    else
                    {
                        //Si la cantidad del producto para la venta no supera la existencia en el lote
                        //Reducimos la existencia de ese lote por la cantidad del producto para la venta
                        SaleLote::create([
                            'sale_detail_id' => $sd->id,
                            'lote_id' => $l->id,
                            'cantidad' => $cantidad_producto_venta
                        ]);


                        $diferencia = $cantidad_producto_lote - $cantidad_producto_venta;

                        if ($diferencia != 0) {
                            $l->update([
                                'existencia' => $cantidad_producto_lote - $cantidad_producto_venta
                            ]);
                            $l->save();
                        } else {
                            $l->update([
                                'existencia' => $cantidad_producto_lote - $cantidad_producto_venta,
                                'status' => "Inactivo"
                            ]);
                            $l->save();
                        }
                        $cantidad_producto_venta = 0;
                    }
                }

                //Decrementando el stock
                $tiendaproducto = ProductosDestino::join("products as p", "p.id", "productos_destinos.product_id")
                    ->join('destinos as des', 'des.id', 'productos_destinos.destino_id')
                    ->select(
                        "productos_destinos.id as id",
                        "p.nombre as name",
                        "productos_destinos.stock as stock"
                    )
                ->where("p.id", $p->id)
                ->where("des.id", $this->destino_id)
                ->where("des.sucursal_id", $this->idsucursal())
                ->get()
                ->first();


                $product_destination = ProductosDestino::find($tiendaproducto->id);

                $product_destination->update([
                    'stock' => $tiendaproducto->stock - $p->quantity
                ]);
                $product_destination->save();
                
            }

            //Creando Cartera Movimiento
            $cv = CarteraMov::create([
                'type' => "INGRESO",
                'tipoDeMovimiento' => "VENTA",
                'comentario' => "Venta",
                'cartera_id' => $cartera->id,
                'movimiento_id' => $Movimiento->id,
            ]);

            //verificar que caja esta aperturada
            $cajaId = session('sesionCajaID');

            $this->resetUI();
            $this->clearcart();
            $this->mensaje_toast = "¡Venta con el código: '" . $sale->id . "' realizada exitosamente!";
            $this->emit('sale-ok');


            //Verificando la variable $this->pdf para crear o no un comprobante pdf
            if ($this->pdf)
            {
                $this->emit('opentap');
            }


            DB::commit();
            return Redirect::to('pos');
                
        }
        catch (Exception $e)
        {
            DB::rollback();
            $this->mensaje_toast = ": " . $e->getMessage();
            $this->emit('sale-error');
        }
    }
    //Listar las Carteras disponibles en su corte de caja
    public function listarcarteras()
    {
        // $carteras = Caja::join('carteras as car', 'cajas.id', 'car.caja_id')
        // ->join('cartera_movs as cartmovs', 'car.id', 'cartmovs.cartera_id')
        // ->join('movimientos as mov', 'mov.id', 'cartmovs.movimiento_id')
        // ->where('cajas.estado', 'Abierto')
        // ->where('mov.user_id', Auth()->user()->id)
        // ->where('mov.status', 'ACTIVO')
        // ->where('mov.type', 'APERTURA')
        // ->where('cajas.sucursal_id', $this->idsucursal())
        // ->select('car.id as idcartera', 'car.nombre as nombrecartera', 'car.descripcion as dc','car.tipo as tipo')
        // ->get();


        $carteras = Cartera::select('carteras.id as idcartera', 'carteras.nombre as nombrecartera', 'carteras.descripcion as dc', 'carteras.tipo as tipo')
            ->where("carteras.caja_id", $this->caja_abierta_id)
            ->get();




        return $carteras;
    }
    //Listar las carteras generales
    public function listarcarterasg()
    {
        $carteras = Caja::join('carteras as car', 'cajas.id', 'car.caja_id')
            ->where('cajas.id', 1)
            ->select('car.id as idcartera', 'car.nombre as nombrecartera', 'car.descripcion as dc', 'car.tipo as tipo')
            ->get();
        return $carteras;
    }
    //Volver a los valores por defecto
    public function resetUI()
    {
        $this->total_bs = $this->gettotalcart();
        $this->total_items = Cart::getTotalQuantity();
        $this->factura = false;
        $this->buscarproducto = "";
        $this->cartera_id = 'Elegir';
        $this->cliente_id = $this->clienteanonimo_id();
        $this->clienteanonimo = true;
        $this->observacion = "";
        $this->dinero_recibido = "";
        foreach ($this->listarcarteras() as $list) {
            if ($list->tipo == "efectivo") {
                $this->cartera_id = $list->idcartera;
                break;
            }
        }
    }
    //llama al modal buscarcliente
    public function modalbuscarcliente()
    {
        $this->procedencias = ProcedenciaCliente::where("estado", "ACTIVO")->get();
        $this->emit('show-buscarcliente');
    }
    //Devuelve el nombre de la cartera seleccionada y su tipo
    public function nombrecartera()
    {
        $nombrecartera = Cartera::select('carteras.*')
            ->where('carteras.id', $this->cartera_id)
            ->get();
        if ($nombrecartera->count() > 0) {
            return $nombrecartera->first()->nombre . " - " . $nombrecartera->first()->tipo;
        } else {
            return "Tipo de Pago no selecccionado";
        }
    }
    //Método para guardar SI o NO en la variable $invoice para saber si una venta es con factura
    public function facturasino()
    {
        if ($this->factura) {
            $this->invoice = "No";
            $this->factura = false;
            $this->mensaje_toast = "Venta con factura desactivada";
            $this->emit('mensaje-ok');
        } else {
            $this->invoice = "Si";
            $this->factura = true;
            $this->mensaje_toast = "Venta con factura activada";
            $this->emit('mensaje-ok');
        }
    }
    //Método para guardar true o false para la variable $this->pdf crear o no comprobante de venta
    public function pdfsino()
    {
        if ($this->pdf) {
            $this->pdf = false;
        } else {
            $this->pdf = true;
        }
    }
    //Cambiar el precio de un producto del Carrito de Ventas
    public function cambiarprecio($idproducto, $precio_nuevo)
    {
        //Guardamos los datos del producto del Carrito de Ventas
        $product_cart = Cart::get($idproducto);
        if ($precio_nuevo >= 0 && $precio_nuevo != "") {
            //Eliminamos el producto del Carrito de Ventas
            Cart::remove($idproducto);
            //Volvemos a añadir el producto con el precio actualizado
            Cart::add($product_cart->id, $product_cart->name, $precio_nuevo, $product_cart->quantity, $product_cart->image);
            //Actualizamos Valores (Unidades y Bs de la Venta)
            $this->actualizarvalores();
            //mensaje a Mostrar
            $this->mensaje_toast = "Precio: '" . $precio_nuevo . " Bs' Actualizado";
            $this->emit('mensaje-ok');
        } else {
            $this->mensaje_toast = "El precio dado no esta admitido, se usará el precio de '" . $product_cart->price . " Bs'";
            //Eliminamos el producto del Carrito de Ventas
            Cart::remove($idproducto);

            //Volvemos a añadir el producto con el precio que tenia en el Carrito de Ventas

            Cart::add($product_cart->id, $product_cart->name, $product_cart->price, $product_cart->quantity, $product_cart->image);
            $this->actualizarvalores();
            $this->emit('mensaje-advertencia');
        }
    }
    //Cambiar la cantidad de un producto del Carrito de Ventas
    public function cambiarcantidad($idproducto, $cantidad_nueva)
    {
        //Actualizando la variable $this->cantidad_venta para mostrar cantidad en lotes en la ventana modal lotes productos
        $this->cantidad_venta = $cantidad_nueva;

        //Guardamos los datos del producto del Carrito de Ventas
        $product_cart = Cart::get($idproducto);
        if ($this->stocktienda($idproducto, $cantidad_nueva)) {
            if ($cantidad_nueva > 0 && $cantidad_nueva != "") {
                //Eliminamos el producto del Carrito de Ventas
                Cart::remove($idproducto);
                //Volvemos a añadir el producto con el precio actualizado
                Cart::add($product_cart->id, $product_cart->name, $product_cart->price, $cantidad_nueva, $product_cart->image);
                //Actualizamos Valores (Unidades y Bs de la Venta)
                $this->actualizarvalores();
                //mensaje a Mostrar
                $this->mensaje_toast = "Cantidad: '" . $cantidad_nueva . " Unidades' Actualizada";
                $this->emit('mensaje-ok');
            } else {
                $this->mensaje_toast = "La cantidad dada no esta admitida, se usará la cantidad de '" . $product_cart->quantity . " unidades'";
                //Eliminamos el producto del Carrito de Ventas
                Cart::remove($idproducto);

                //Volvemos a añadir el producto con el precio que tenia en el Carrito de Ventas

                Cart::add($product_cart->id, $product_cart->name, $product_cart->price, $product_cart->quantity, $product_cart->image);
                //Actualizamos Valores (Unidades y Bs de la Venta)
                $this->actualizarvalores();
                $this->emit('mensaje-advertencia');
            }
        } else {
            $this->modalstockinsuficiente($idproducto);
        }
    }
    //Devolver nombredestino y stock de una sucursal diferente a la que se fue asignado
    public function buscarstocksucursal($idsucursal)
    {
        $destinos = Destino::join("productos_destinos as pd", "pd.destino_id", "destinos.id")
            ->join("products as p", "p.id", "pd.product_id")
            ->select("destinos.id as id", "destinos.nombre as nombredestino", "pd.product_id as idproducto", "pd.stock as stock")
            ->where("destinos.sucursal_id", $idsucursal)
            ->where('pd.product_id', $this->producto_id)
            ->where('p.status', 'ACTIVO')
            ->where('pd.stock', '>', 0)
            ->get();
        return $destinos;
    }
    //Actualizar la variable descuento_recargo
    public function actualizar_desc_recar()
    {
        $bs_total_original = 0;
        $items = Cart::getContent();
        foreach ($items as $item)
        {
            $bs_total_original = ($this->buscarprecio($item->id) * $item->quantity) + $bs_total_original;
        }
        $this->descuento_recargo = $bs_total_original - $this->gettotalcart();
    }
    //Devuelve el precio total Bs del Carrito de Ventas
    public function gettotalcart()
    {
        $bs_total_cart = 0;
        $items = Cart::getContent();

        foreach ($items as $item) {
            $bs_total_cart = ($item->price * $item->quantity) + $bs_total_cart;
        }

        return  $bs_total_cart;
    }
    //Buscar el Precio Original de un Producto
    public function buscarprecio($id)
    {
        $precio = Lote::select("lotes.pv_lote as pv")
        ->where("lotes.product_id", $id)
        // ->where("lotes.status","Activo")
        ->orderby("lotes.created_at", "desc")
        ->get();


        if($precio->count() > 0)
        {
            $precio = $precio->first()->pv;
        }
        else
        {
            $precio = 0;
        }

        return $precio;
    }
    //Cierra la ventana modal Buscar Cliente y Cambia el id de la variable $cliente_id con un cliente Creado
    public function crearcliente()
    {
        $rules = [
            'procedencia_cliente_id' => 'required|not_in:Elegir',
            'procedencia_cliente_id' => 'required'
        ];
        $messages = [
            'procedencia_cliente_id.not_in' => 'Elegir un tipo diferente de elegir',
            'procedencia_cliente_id.required' => 'Elegir un tipo diferente de elegir',
        ];

        $this->validate($rules, $messages);

        if ($this->cliente_celular == null) {
            $newclient = Cliente::create([
                'nombre' => $this->buscarcliente,
                'cedula' => $this->cliente_ci,
                'celular' => 0,
                'procedencia_cliente_id' => $this->procedencia_cliente_id,
            ]);
        } else {
            $newclient = Cliente::create([
                'nombre' => $this->buscarcliente,
                'cedula' => $this->cliente_ci,
                'celular' => $this->cliente_celular,
                'procedencia_cliente_id' => $this->procedencia_cliente_id,
            ]);
        }

        $this->cliente_id = $newclient->id;
        $this->nombrecliente = $newclient->nombre;
        $this->message = "Se selecciono al cliente creado: '" . $newclient->nombre . "'";
        //Ocultando ventana modal
        $this->emit('hide-buscarcliente');
    }
    //Método para mostrar una ventana modal cuando no hay stock en Tienda de un producto
    public function modalstockinsuficiente($idproducto)
    {
        $this->producto_id = $idproducto;

        // Cambiando la variable $this->stock_disponible a false para que no se pueda mostrar la ventana modal finalizar venta
        $this->stock_disponible = false;
        //Buscamos stock disponible del producto en toda la sucursal menos en el destino de venta
        //Y actualizando la variable $this->listadestinos para guardar todos los destinos
        //de la sucursal (Menos Tienda) en los que existan stocks disponibles
        $this->listadestinos = Destino::join("productos_destinos as pd", "pd.destino_id", "destinos.id")
        ->join("products as p", "p.id", "pd.product_id")
        ->select("destinos.id as id", "destinos.nombre as nombredestino", "pd.product_id as idproducto", "pd.stock as stock")
        ->where("destinos.sucursal_id", $this->idsucursal())
        ->where('destinos.id', '<>', $this->destino_id)
        ->where('pd.product_id', $this->producto_id)
        ->where('p.status', 'ACTIVO')
        ->get();

        //Guardando el nombre del producto con 0 stock en tienda
        $this->nombreproducto = Product::find($idproducto)->nombre;
        $this->nombresucursal = Sucursal::find($this->idsucursal())->name;


        // Lista todas las sucursales menos la sucursal en la que esta
        $this->listasucursales = Sucursal::select("sucursals.*")
        ->where('sucursals.id', '<>', $this->idsucursal())
        ->get();



        //Obteniendo el costo del Producto para mostrarlo en la ventana modal
        $this->product_cost = Lote::select("lotes.costo as costo")
        ->where("lotes.product_id",$idproducto)
        // ->where("lotes.status","Activo")
        ->orderBy("lotes.created_at","desc")
        ->get();

        if($this->product_cost->count() > 0)
        {
            $this->product_cost = $this->product_cost->first()->costo;
        }
        else
        {
            $this->product_cost = "0";
        }



        //Mostrando la ventana modal
        $this->emit('show-stockinsuficiente');
    }
    //Muestra una ventana modal con los detalles de todos los lotes nesesarios para llegar a la cantida puesta en el carrito de ventas de un producto
    public function modal_lotes($idproducto)
    {
        //Actualizando la variable  $this->producto_id para (de ser nesesario) aplicar un precio promedio por lotes con el método $this->aplicar_precio_promedio()
        $this->producto_id = $idproducto;
        //Guarda la cantidad a vender en el carrito de ventas para mostrar esa cantidad en la ventana modal lotes producto
        $this->cantidad_venta = Cart::get($idproducto)->quantity;
        //Guardando todos los lotes de un producto
        $this->lotes_producto = Lote::select("lotes.*")
            ->where("lotes.status", "Activo")
            ->where("lotes.product_id", $idproducto)
            ->orderBy("lotes.created_at", "asc")
            ->get();
        //Variable array en donde se guardarán todos los ids de los lotes de un producto que son nesesarios para llegar a la cantidad puesta en el carrito ded ventas
        $lotes = [];
        //Guardando la cantidad para vender del producto de la variable $this->cantidad_venta (Cantidad obtenida del método $this->cambiarcantidad($idproducto, $cantidad_nueva))
        $cant = $this->cantidad_venta;
        //Recorriendo todos los lotes nesesarios para llegar a la cantida ($cant) requerrida
        foreach ($this->lotes_producto as $lp) {
            if ($lp->existencia >= $cant) {
                array_push($lotes, $lp->id);
                break;
            } else {
                $cant = $cant - $lp->existencia;
                array_push($lotes, $lp->id);
            }
        }
        //Guardando todos los lotes de un producto nesesarios para llegar a la cantidad puesta en el carrito ded ventas
        $this->lotes_producto = Lote::select("lotes.*")
            ->where("lotes.status", "Activo")
            ->where("lotes.product_id", $idproducto)
            ->whereIn('lotes.id', $lotes)
            ->orderBy("lotes.created_at", "desc")
            ->get();
        //Guarda un promedio de precios en los lotes de un producto para mostrar en la ventana modal lotes producto 
        $this->precio_promedio = Lote::select("lotes.pv_lote as pv_lote")
            ->where("lotes.status", "Activo")
            ->where("lotes.product_id", $idproducto)
            ->avg('lotes.pv_lote');
        //Guardando el nombre del producto
        $this->nombreproducto = Product::find($idproducto)->nombre;
        //Mostrando la Ventana Modal Lotes Producto
        $this->emit('show-modallotesproducto');
    }
    //Actualiza el precio (Que es el promedio de precios de la cantidad de lotes nesesarios para la venta) de un producto del carrito de ventas
    public function aplicar_precio_promedio()
    {
        //Llamando al método cambiarprecio para actualizar el precio promedio por lotes de un produto en el carrito de ventas
        $this->cambiarprecio($this->producto_id, number_format($this->precio_promedio, 2));
        $this->mensaje_toast = "Precio promedio: " . number_format($this->precio_promedio, 2) . "Bs aplicado al producto " . $this->nombreproducto;
        //Ocultando la Ventana Modal Lotes Producto
        $this->emit('hide-modallotesproducto');
    }
    //MODULO DE INGRESO Y EGRESO
    public function modalingresoegreso()
    {
        $this->emit("show-modalingresoegreso");
    }
    //Generar Ingreso o Egreso
    public function generar()
    {
        $rules = [ /* Reglas de validacion */
            'tipo_movimiento_ie' => 'required|not_in:Elegir',
            'categoria_id_ie' => 'required|not_in:Elegir',
            'cartera_id_ie' => 'required|not_in:Elegir',
            'cantidad_ie' => 'required|not_in:0',
            'comentario' => 'required',
        ];
        $messages = [ /* mensajes de validaciones */
            'tipo_movimiento_ie.not_in' => 'Seleccione un valor distinto a Elegir',
            'cartera_id_ie.not_in' => 'Seleccione un valor distinto a Elegir',

            'categoria_id_ie.required' => 'Seleccione una Categoria',
            'categoria_id_ie.not_in' => 'Seleccione una Categoria distinto a Elegir',

            'cantidad_ie.required' => 'Ingrese un monto válido',
            'cantidad_ie.not_in' => 'Ingrese un monto válido',
            'comentario.required' => 'El comentario es obligatorio',
        ];

        $this->validate($rules, $messages);

        $movimiento = Movimiento::create([
            'type' => 'TERMINADO',
            'status' => 'ACTIVO',
            'import' => $this->cantidad_ie,
            'user_id' => Auth()->user()->id,
        ]);

        $cartera_movimiento = CarteraMov::create([
            'type' => $this->tipo_movimiento_ie,
            'tipoDeMovimiento' => 'EGRESO/INGRESO',
            'comentario' => $this->comentario,
            'cartera_id' => $this->cartera_id_ie,
            'movimiento_id' => $movimiento->id,
            'cartera_mov_categoria_id' => $this->categoria_id_ie
        ]);

        if ($this->tipo_movimiento_ie == "INGRESO") {
            $cartera = Cartera::find($this->cartera_id_ie);

            $saldo_cartera = $cartera->saldocartera + $this->cantidad_ie;

            $cartera->update([
                'saldocartera' => $saldo_cartera
            ]);
        } else {
            $cartera = Cartera::find($this->cartera_id_ie);

            $saldo_cartera = $cartera->saldocartera - $this->cantidad_ie;

            $cartera->update([
                'saldocartera' => $saldo_cartera
            ]);
        }


        return Redirect::to('pos');
    }
    //COTIZACION
    //Show the Modal Cotization
    public function showmodalcotization()
    {
        $this->emit("show-modalcotization");
    }
    public function generatecotization()
    {
        $cotization = Cotization::create([
            'total' => $this->total_bs,
            'items' => $this->total_items,
            'observation' => $this->observacion,
            'finaldate' => $this->finaldatecotization,
            'cliente_id' => $this->cliente_id,
            'user_id' => Auth()->user()->id,
            'sucursal_id' => $this->idsucursal(),
        ]);

        //Obteniendo todos los productos del Carrito de Ventas (Carrito de Ventas)
        $productos = Cart::getContent();

        foreach ($productos as $p) {
            CotizationDetail::create([
                'price' => $p->price,
                'quantity' => $p->quantity,
                'product_id' => $p->id,
                'cotization_id' => $cotization->id
            ]);
        }
        Cart::clear();
        $this->actualizarvalores();

        $this->cotization_id = $cotization->id;

        $this->emit('generatepdfcotizacion');

        return Redirect::to('pos');
    }
    //Incrementa cantidades extra al carrito de ventas (Cantidades que sobrepasan el stock disponible)
    public function extraincrease()
    {
        $producto = Product::find($this->producto_id);
        $product_cart = Cart::get($producto->id);

        if ($producto->image == null)
        {
            $producto->image = "noimgproduct.png";
        }
        //Para saber si el Producto ya esta en el carrrito para cambiar el Mensaje Toast de Producto Agregado a Cantidad Actualizada
        if ($product_cart)
        {
            //Cantidad extra para incrementar
            $cantidad_previa = $product_cart->attributes->Cantidad;
            $miArray = array(
                "Imagen" => $producto->image,
                "Cantidad" => $this->extraquantity + $cantidad_previa,
                "Costo" => $this->product_cost
            );
            //Cantidad para vender
            $cantidad_vender = $product_cart->quantity + $this->extraquantity;

            $this->mensaje_toast = "¡Cantidad Actualizada: '" . strtolower($producto->nombre) . "'!";
            Cart::add($product_cart->id, $product_cart->name, $product_cart->price, $cantidad_vender ,$miArray);
            $this->emit('increase-ok');
        }
        else
        {
            $miArray = array(
                "Imagen" => $producto->image,
                "Cantidad" => $this->extraquantity,
                "Costo" => $this->product_cost
            );

            $precio = Lote::select("lotes.pv_lote as pv")
            ->where("lotes.product_id", $producto->id)
            ->orderby("lotes.created_at", "desc")
            ->get();

            if($precio->count() > 0)
            {
                $precio = $precio->first()->pv;
            }
            else
            {
                $precio = "0";
            }

            $this->mensaje_toast = "¡Agregado correctamente: '" . $producto->nombre . "'!";
            Cart::add($producto->id, $producto->nombre, $precio, $this->extraquantity, $miArray);
            $this->emit('increase-ok');
        }


        $this->extraquantity = 1;
        $this->selloutofstock = true;
        
        $this->emit("hide-stockinsuficiente");
    }
    // Muestra la ventana modal de devolución
    public function showModalDevolution()
    {
        $this->emit("show-modal-devolution");
    }
    //Selecciona una venta para devolución
    public function select_sale($idsale)
    {
        if($this->sale_id_devolution == $idsale)
        {
            $this->sale_id_devolution = null;
        }
        else
        {
            $this->sale_id_devolution = $idsale;
        }
    }
    // Selecciona un producto y venta para devolución
    public function select_product(SaleDetail $sale_detail)
    {
        $this->sale_detail_id_devolution = $sale_detail->id;
        $this->product_name_devolution = Product::find($sale_detail->product_id)->nombre;
        $this->product_id_devolution = $sale_detail->product_id;
    }
    //Guarda una devolución
    public function save_devolution()
    {
        $rules = [
            'quantity_devolution' => 'required|numeric|min:1',
            'detail_devolution' => 'required',

            'cartera_id_devolution' => 'not_in:Elegir',
        ];
        $messages = [
            'quantity_devolution.required' => 'La cantidad es requerida',
            'quantity_devolution.numeric' => 'Debe ser un número',
            'quantity_devolution.min' => 'Debe ser un número positivo',
            'detail_devolution.required' => 'Motivo requerido',

            'cartera_id_devolution.not_in' => 'Seleccione Tipo Pago',

        ];
        $this->validate($rules, $messages);

        if($this->amount_devolution == null)
        {
            $this->amount_devolution = 0;
        }

        //Buscando si la devolución no se hizo antes
        $cont = SaleDevolution::where("sale_detail_id", $this->sale_detail_id_devolution)->get();
        $sale_detail = SaleDetail::find($this->sale_detail_id_devolution);
        if($cont->count() > 0)
        {
            $dev = $cont->sum('quantity');
            $quantity = $sale_detail->quantity - $dev;
        }
        else
        {
            $quantity = $sale_detail->quantity;
        }



        if($this->quantity_devolution <= $quantity)
        {
            //Incrementando el stock
            $product_destiny = ProductosDestino::firstOrCreate([
                "product_id" => $sale_detail->product_id,
                "destino_id" => $this->destiny_id_devolution
            ]);

            $stock = $product_destiny->stock + $this->quantity_devolution;

            $product_destiny_update = ProductosDestino::find($product_destiny->id);
            $product_destiny_update->update([
                'stock' => $stock
            ]);
            $product_destiny_update->save();

            //Actualizando lotes (Reactivando los lotes necesarios)
            $sale_detail_lots = SaleLote::where("sale_detail_id", $this->sale_detail_id_devolution)
            ->orderBy("id", "desc")
            ->get();
            $cont = $this->quantity_devolution;
            //Determina la utilidad total que representa la devolución de x cantidad del producto
            $utility = 0;
            foreach($sale_detail_lots as $sdl)
            {
                if($sdl->cantidad > 0)
                {
                    $cont = $cont - $sdl->cantidad;
                    if($cont <= 0)
                    {
                        if($cont == 0)
                        {
                            $lot = Lote::find($sdl->lote_id);
                            $stock_lot = $lot->existencia + $sdl->cantidad;
                            $lot->update([
                                'existencia' => $stock_lot,
                                'status' => "Activo"
                            ]);
                            $lot->save();

                            $utility = $utility + ($sale_detail->price * $sdl->cantidad) - ($lot->costo * $sdl->cantidad);
                        }
                        else
                        {
                            $n_stock = $sdl->cantidad + $cont;
                            $lot = Lote::find($sdl->lote_id);
                            $stock_lot = $lot->existencia + $n_stock;
                            $lot->update([
                                'existencia' => $stock_lot,
                                'status' => "Activo"
                            ]);
                            $lot->save();

                            $utility = $utility + ($sale_detail->price * $n_stock) - ($lot->costo * $n_stock);
                        }
                    }
                    else
                    {
                        $lot = Lote::find($sdl->lote_id);
                        $stock_lot = $lot->existencia + $sdl->cantidad;
                        $lot->update([
                            'existencia' => $stock_lot,
                            'status' => "Activo"
                        ]);
                        $lot->save();

                        $utility = $utility + ($sale_detail->price * $sdl->cantidad) - ($lot->costo * $sdl->cantidad);
                    }
                }
            }


            //Generando un egreso si el monto devuelto es mayor que 0
            if($this->amount_devolution > 0)
            {
                $m = Movimiento::create([
                    'type' => "TERMINADO",
                    'import' => $this->amount_devolution,
                    'user_id' => Auth()->user()->id,
                ]);

                CarteraMov::create([
                    'type' => "EGRESO",
                    'tipoDeMovimiento' => "EGRESO/INGRESO",
                    'comentario' => $this->detail_devolution,
                    'cartera_id' => $this->cartera_id_devolution,
                    'movimiento_id' => $m->id,
                    'cartera_mov_categoria_id' => $this->category_id_devolution
                ]);

                //Actualizando saldo cartera
                $wallet = Cartera::find($this->cartera_id_devolution);
                $balance = $wallet->saldocartera - $this->amount_devolution;
                $wallet->update([
                    'saldocartera' => $balance
                ]);
                $wallet->save();
            }


            SaleDevolution::create([
                'quantity' => $this->quantity_devolution,
                'amount' => $this->amount_devolution,
                'description' => $this->detail_devolution,
                'utility' => $utility,
                'destino_id' => $this->destiny_id_devolution,
                'sale_detail_id' => $this->sale_detail_id_devolution
            ]);
    
            // $this->observacion = "Venta por devolución de la venta : X.";
    
            //Reseteando las varibles de devolución
            $this->search_devolution = "";
            $this->sale_detail_id_devolution = null;
            $this->amount_devolution = null;
            $this->quantity_devolution = "";
            $this->detail_devolution = "";
            $this->destino_id = 1;
            $this->product_id_devolution = null;
    
            $this->emit("hide-modal-devolution");
        }
        else
        {
            $this->mensaje_toast = "La cantidad máxima para devolver es de " . $quantity . " unidades";
            $this->emit("message-quantity");
        }
    }
}
