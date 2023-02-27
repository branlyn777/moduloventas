<?php

namespace App\Http\Livewire;

use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Destino;
use App\Http\Livewire\ProvidersController as Prov;
use App\Http\Livewire\ProductsController as Products;
use App\Models\Category;
use App\Models\Lote;
use App\Models\Marca;
use App\Models\Movimiento;
use App\Models\MovimientoCompra;
use App\Models\OrdenCompra;
use App\Models\OrdenCompraAsignada;
use App\Models\Product;
use App\Models\ProductosDestino;
use App\Models\Provider;
use App\Models\Sucursal;
use App\Models\Unidad;
use Carbon\Carbon;
use Livewire\Component;

use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;



use Darryldecode\Cart\Facades\ComprasFacade as Compras;
use Exception;
use Illuminate\Support\Facades\Auth;

class DetalleComprasController extends Component
{


    use WithPagination;
    use WithFileUploads;
    public  $nro_compra, $search, $provider, $fecha_compra, $vs = [],
        $usuario, $metodo_pago, $pago_parcial = 0, $tipo_documento, $nro_documento, $observacion, $selected_id, $descuento = 0, $saldo = 0, $subtotal, $cantidad_minima,
        $estado_compra, $total_compra, $itemsQuantity, $price, $status, $tipo_transaccion, $destinocompra, $porcentaje, $importe, $dscto = 0, $aplicar = false, $lote_compra;

    public $nombre_prov, $apellido, $correo, $direccion, $nit,
        $telefono;

    public $nombre, $costo, $precio_venta, $barcode, $codigo, $caracteristicas, $lote, $unidad, $marca, $garantia, $industria, $total,
        $categoryid, $component, $stockswitch, $destino, $imagen, $destinosp, $selected_categoria, $image, $selected_id2, $name, $descripcion;



    public $costoUnitario,$costoTotal,$cantidad,$precioVenta;

    public $orden, $ordencompraselected;

    private $pagination = 5;
    public $componentName, $componentName2;
   
    public function mount()
    {
        $this->componentName= "Compras";
        $this->componentName2= "Proveedor";
        $this->fecha_compra = Carbon::now()->format('Y-m-d');
        $this->usuario = Auth()->user()->name;
        $this->estado_compra = "finalizada";
        $this->selected_id = 0;
        $this->pago_parcial = 0;
        $this->destinocompra = 'Elegir';
        $this->tipo_transaccion = "CONTADO";
        $this->tipo_documento = "FACTURA";
        $this->imagen = 'noimagenproduct.png';
        $this->status = "ACTIVO";
        $this->itemsQuantity = Compras::getTotalQuantity();
        $this->subtotal = Compras::getTotal();
        $this->total_compra = $this->subtotal - $this->dscto;
        $this->porcentaje = 0;
        $this->stockswitch = false;
        $this->verPermisos();
    }
    public function render()
    {

        if (strlen($this->search) > 0) {
            $prod = Product::select('products.*')
                ->where('nombre', 'like', '%' . $this->search . '%')
                ->where('status', 'ACTIVO')
                ->orWhere('codigo', 'like', '%' . $this->search . '%')
                ->orWhere('marca', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%')
         
                ->get();
        } else {
            $prod = "cero";
        }
        //---------------Select destinocompra de la compra----------------------//
        $data_destino = Sucursal::join('destinos as dest', 'sucursals.id', 'dest.sucursal_id')
            ->whereIn('dest.id', $this->vs)
            ->select('dest.*', 'dest.id as destino_id', 'sucursals.*')
            ->get();

        //--------------------Select proveedor---------------------------//
        $data_provider = Provider::where('status', 'ACTIVO')
            ->select('providers.*')
            ->get();



            $this->destinosp= Destino::join('sucursals as suc','suc.id','destinos.sucursal_id')
            ->select ('suc.name as sucursal','destinos.nombre as destino','destinos.id as destino_id')
            ->get();
    
          

        return view('livewire.compras.detalle_compra', [
            'data_prod' => $prod,
            'cart' => Compras::getContent()->sortBy('name'),
            'data_suc' => $data_destino,
            'data_prov' => $data_provider,
            'categories' => Category::where('categories.categoria_padre', 0)->orderBy('name', 'asc')->get(),
            'unidades' => Unidad::orderBy('nombre', 'asc')->get(),
            'marcas' => Marca::select('nombre')->orderBy('nombre', 'asc')
                ->get(),
            'subcat' => Category::where('categories.categoria_padre', $this->selected_id2)
                ->where('categories.categoria_padre', '!=', 'Elegir')
                ->get()
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function verPermisos()
    {

        $ss = Destino::pluck('codigo_almacen', 'id');

        foreach ($ss as $key => $value) {
            if ($value != null) {

                if (Auth::user()->hasPermissionTo($value)) {

                    array_push($this->vs, $key);
                }
            }
        }
    }
    public function increaseQty($productId, $cant = 1, $precio_compra = 0)
    {
        $product = Product::select('products.*')
            ->where('products.id', $productId)->first();


        $precio_compra = Lote::where('product_id', $productId)->latest('created_at')->value('costo');

        $exist = Compras::get($product->id);
        $attributos = [
            'precio' => $product->precio_venta,
            'codigo' => $product->codigo,
            'fecha_compra' => $this->fecha_compra
        ];

        if ($precio_compra == null) {
            $precio_compra = 0;
        }


        $products = array(
            'id' => $product->id,
            'name' => $product->nombre,
            'price' => $precio_compra,
            'quantity' => $cant,
            'attributes' => $attributos
        );
        Compras::add($products);
        // Compras::add($product->id, $product->name, $precio_compra, $cant);

        $this->total = Compras::getTotal();
        $this->itemsQuantity = Compras::getTotalQuantity();
        $this->subtotal = Compras::getTotal();
        $this->total_compra = $this->subtotal - $this->dscto;
    }
    public function addProvider()
    {
        $obj = new Prov;
        $obj->nombre_prov = strtoupper($this->nombre_prov);
        $obj->apellido = strtoupper($this->apellido);
        $obj->direccion = strtoupper($this->direccion);
        $obj->correo = $this->correo;
        $obj->telefono = $this->telefono;
        $obj->nit = $this->nit;
        $obj->image = $this->image;

        $obj->Store();
        $this->provider = Provider::where('nombre_prov', $this->nombre_prov)->first()->nombre_prov;
        $this->resetProv();

        $this->emit('prov_added', 'Proveedor Registrado');
    }
    public function GenerateCode()
    {
        $min = 10000;
        $max = 99999;
        $this->codigo = Carbon::now()->format('ymd') . mt_rand($min, $max);
    }
    public function StoreCategory()
    {

        $rules = ['name' => 'required|unique:categories|min:3'];
        $messages = [
            'name.required' => 'El nombre de la categoría es requerido',
            'name.unique' => 'Ya existe el nombre de la categoría',
            'name.min' => 'El nombre de la categoría debe tener al menos 3 caracteres'
        ];
        $this->validate($rules, $messages);
        $category = Category::create([
            'name' => $this->name,
            'descripcion' => $this->descripcion,
            'categoria_padre' => 0
        ]);

        $category->save();
        $this->resetCategory();
        $this->emit('cat-added', 'Categoría Registrada');
    }
    public function resetCategory()
    {
        $this->name = "";
        $this->descripcion = "";
    }
    public function Store()
    {
        $prod = new Products;
        $prod->selected_id2 = $this->selected_id2;
        $prod->nombre = $this->nombre;
        $prod->costo = $this->costo;
        $prod->precio_venta = $this->precio_venta;

        $prod->codigo = $this->codigo;
        $prod->caracteristicas = $this->caracteristicas;
        $prod->lote = $this->lote;
        $prod->unidad = $this->unidad;
        $prod->marca = $this->marca;
        $prod->cantidad_minima = $this->cantidad_minima;
        $prod->garantia = $this->garantia;
        $prod->industria = $this->industria;
        $prod->categoryid = $this->categoryid;
        $prod->Store();
        $this->emit('products_added', 'ahola');
        $pr = Product::where('nombre', $this->nombre)->pluck('id');
        $this->increaseQty($pr);
        $this->resetUI();
    }
    public function UpdateQty($productId, $cant = 3)
    {

        $product = Product::select('products.*')
            ->where('products.id', $productId)->first();

        $exist = Compras::get($productId);
        $prices = $exist->price;
        $precio_venta = $exist->attributes->precio;
        $codigo = $exist->attributes->codigo;


        $this->removeItem($productId);

        if ($cant > 0) {


            //Compras::add($product->id, $product->name,$prices, $cant);
            $attributos = [
                'precio' => $precio_venta,
                'codigo' => $codigo,
                'fecha_compra' => $this->fecha_compra
            ];

            $products = array(
                'id' => $product->id,
                'name' => $product->nombre,
                'price' => $prices,
                'quantity' => $cant,
                'attributes' => $attributos
            );


            Compras::add($products);
            $this->subtotal = Compras::getTotal();
            $this->itemsQuantity = Compras::getTotalQuantity();
            $this->subtotal = Compras::getTotal();
            $this->total_compra = $this->subtotal - $this->dscto;
        }
    }
    public function UpdatePrice($productId, $price = 20)
    {
        $product = Product::select('products.*')
            ->where('products.id', $productId)->first();
        $exist = Compras::get($productId);
        $quantitys = $exist->quantity;
        $precio_venta = $exist->attributes->precio;
        $codigo = $exist->attributes->codigo;
        $this->removeItem($productId);

        if ($price > 0) {

            $attributos = [
                'precio' => $precio_venta,
                'codigo' => $codigo,
                'fecha_compra' => $this->fecha_compra
            ];

            $products = array(
                'id' => $product->id,
                'name' => $product->nombre,
                'price' => $price,
                'quantity' => $quantitys,
                'attributes' => $attributos
            );

            Compras::add($products);

            $this->subtotal = Compras::getTotal();
            $this->itemsQuantity = Compras::getTotalQuantity();
            $this->total_compra = $this->subtotal - $this->dscto;
        }
    }
    public function aplicarDescto()
    {
        $this->dscto = $this->descuento;
        $this->emit('dscto_added', 'Descuento aplicado satisfactoriamente');
        $this->total_compra = $this->subtotal - $this->dscto;
    }
    public function cancelDscto()
    {
        $this->descuento = null;
        $this->porcentaje = 0;
    }
    public function UpdatePrecioVenta($productId, $price = 20)
    {
        $product = Product::select('products.*')
            ->where('products.id', $productId)->first();
        // $precio_compra= Lote::where('product_id',$productId)->latest('created_at')->value('costo');
        $exist = Compras::get($productId);
        $quantitys = $exist->quantity;
        $precio_compra = $exist->price;
        $codigo = $exist->attributes->codigo;

        $this->removeItem($productId);

        if ($price > 0) {

            $attributos = [
                'precio' => $price,
                'codigo' => $codigo,
                'fecha_compra' => $this->fecha_compra
            ];

            $new_price = Product::find($productId);
            $new_price->update([
                'precio_venta' => $price
            ]);
            $new_price->save();

            $products = array(
                'id' => $product->id,
                'name' => $product->nombre,
                'price' => $precio_compra,
                'quantity' => $quantitys,
                'attributes' => $attributos
            );
            Compras::add($products);

            $this->subtotal = Compras::getTotal();
            $this->itemsQuantity = Compras::getTotalQuantity();
            $this->subtotal = Compras::getTotal();
            $this->total_compra = $this->subtotal - $this->dscto;
        }
    }
    public function removeItem($productId)
    {
        Compras::remove($productId);

        $this->subtotal = Compras::getTotal();
        $this->itemsQuantity = Compras::getTotalQuantity();

        if ($this->itemsQuantity <= 0) {
            $this->dscto = 0;
        }

        $this->total_compra = $this->subtotal - $this->dscto;
        $this->descuento_change();
        if ($this->descuento > 0) {

            $this->porcentaje = (round($this->descuento / $this->subtotal, 2)) * 100;
        }
    }
    public function exit()
    {
        Compras::clear();
        $this->resetUI();
        redirect('/compras');
    }
    public function resetUI()
    {
        $this->selected_id = null;
        $this->selected_id2 = null;
        $this->costo = '';
        $this->nombre = '';
        $this->precio_venta = '';
        $this->caracteristicas = '';
        $this->codigo = '';
        $this->estado = 'Elegir';
        $this->lote = '';
        $this->unidad = 'Elegir';
        $this->marca = 'Elegir';
        $this->industria = '';
        $this->garantia = null;
        $this->cantidad_minima = null;
        $this->categoryid = null;
        $this->image = null;
        $this->imagen = 'noimagenproduct.png';
        $this->marca = null;
        $this->unidad = null;
        $this->cont_lote = null;
        $this->stockswitch = false;
        $this->costoTotal = 0;
        $this->costoUnitario = 0;
        $this->cantidad = 1;
        $this->destino = null;
        $this->precioVenta = 0;


        Compras::clear();
        $this->resetValidation();
    }
    public function resetProv()
    {
        $this->nombre_prov = null;
        $this->apellido = null;
        $this->direccion = null;
        $this->correo = null;
        $this->telefono = null;
        $this->nit = null;
        $this->image = null;
        $this->resetValidation();
    }
    public function descuento_change()
    {
        if ($this->subtotal > 0 && $this->descuento > 0 && $this->descuento < $this->subtotal) {

            //$this->total_compra= $this->subtotal-$this->descuento;
            $this->porcentaje = (round($this->descuento / $this->subtotal, 2)) * 100;
        } else {
            $this->descuento = 0;
        }
    }
    public function validateCarrito()
    {
        if (Compras::getTotalQuantity() == 0) {
            $this->emit('empty_cart', 'No tiene productos en el detalle de compra');
            return false;
        } else {
            return true;
        }
    }
    public function guardarCompra()
    {
        $rules = [
            'provider' => 'required|exists:providers,nombre_prov',
            'destinocompra' => 'required|not_in:Elegir',

        ];
        $messages = [
            'provider.required' => 'El nombre del proveedor es requerido.',
            'provider.exists' => 'El proveedor es inexistente.',
            'destinocompra.required' => 'Elige un destinocompra',
            'destinocompra.not_in' => 'Elija un destinocompra del producto',

        ];

        $this->validate($rules, $messages);
        $this->validateCarrito();

        /*if ($this->subtotal<= 0) 
        {
            $this->emit('sale-error', 'Agrega productos a la compra');
            return;
        }*/

        if ($this->tipo_transaccion == "Credito") {
            $this->saldo = $this->total_compra - $this->pago_parcial;
            $this->importe = $this->pago_parcial;
        } else {
            $this->importe = $this->total_compra;
        }

        if ($this->validateCarrito()) {
            DB::beginTransaction();

            try {
                $Compra_encabezado = Compra::create([

                    'importe_total' => $this->total_compra,
                    'descuento' => $this->descuento,
                    'fecha_compra' => $this->fecha_compra,
                    'transaccion' => $this->tipo_transaccion,
                    'saldo' => $this->saldo,
                    'tipo_doc' => $this->tipo_documento,
                    'nro_documento' => $this->nro_documento,
                    'observacion' => $this->observacion,
                    'proveedor_id' => Provider::select('providers.id')->where('nombre_prov', $this->provider)->value('providers.id'),
                    'estado_compra' => $this->estado_compra,
                    'status' => $this->status,
                    'destino_id' => $this->destinocompra,
                    'user_id' => Auth()->user()->id

                ]);
                if ($this->ordencompraselected != null) {

                    OrdenCompraAsignada::create([
                        'orden_compra' => $this->ordencompraselected,
                        'compra_id' => $Compra_encabezado->id
                    ]);

                    $mm = OrdenCompra::find($this->ordencompraselected);
                    $mm->update([
                        'estado_entrega' => 'RECIBIDO'
                    ]);
                }


                if ($this->tipo_transaccion === 'Contado' || $this->pago_parcial > 0) {

                    $Movimiento = Movimiento::create([
                        'type' => "COMPRAS",
                        'status' => "ACTIVO",
                        'saldo' => $this->saldo,
                        'on_account' => $this->pago_parcial,
                        'import' => $this->importe,
                        'user_id' => Auth()->user()->id
                    ]);
                }


                if ($Compra_encabezado) {

                    $items = Compras::getContent();
                    //dd($items);
                    if ($this->tipo_documento == 'FACTURA') {
                        foreach ($items as $item) {
                            $lot = Lote::create([
                                'existencia' => $item->quantity,
                                'costo' => $item->price,
                                'status' => 'Activo',
                                'product_id' => $item->id,
                                'pv_lote' => $item->attributes->precio
                            ]);

                            CompraDetalle::create([
                                'precio' => $item->price * 0.87,
                                'cantidad' => $item->quantity,
                                'product_id' => $item->id,
                                'compra_id' => $Compra_encabezado->id,
                                'lote_compra' => $lot->id


                            ]);



                            /*DB::table('productos_destinos')
                            ->updateOrInsert(['stock'],$item->quantity, ['product_id' => $item->id, 'destino_id'=>$this->destinocompra]);*/

                            $q = ProductosDestino::where('product_id', $item->id)
                                ->where('destino_id', $this->destinocompra)->value('stock');

                            ProductosDestino::updateOrCreate(['product_id' => $item->id, 'destino_id' => $this->destinocompra], ['stock' => $q + $item->quantity]);
                        }
                    } else {
                        foreach ($items as $item) {

                            $lot = Lote::create([
                                'existencia' => $item->quantity,
                                'costo' => $item->price,
                                'status' => 'Activo',
                                'product_id' => $item->id,
                                'pv_lote' => $item->attributes->precio
                            ]);


                            //dump($lot);
                            CompraDetalle::create([
                                'precio' => $item->price,
                                'cantidad' => $item->quantity,
                                'product_id' => $item->id,
                                'compra_id' => $Compra_encabezado->id,
                                'lote_compra' => $lot->id
                            ]);

                            /*DB::table('productos_destinos')
                            ->updateOrInsert(['stock'],$item->quantity, ['product_id' => $item->id, 'destino_id'=>$this->destinocompra]);*/

                            $q = ProductosDestino::where('product_id', $item->id)
                                ->where('destino_id', $this->destinocompra)->value('stock');

                            ProductosDestino::updateOrCreate(['product_id' => $item->id, 'destino_id' => $this->destinocompra], ['stock' => $q + $item->quantity]);
                        }
                    }
                }

                DB::commit();

                Compras::clear();
                $this->total_compra = 0;
                $this->subtotal = 0;
                $this->provider = "";
                $this->destinocompra = "";
                $this->descuento = 0;
                $this->porcentaje = 0;
                $this->tipo_transaccion = "Contado";
                $this->pago_parcial = "";
                $this->tipo_documento = "Factura";
                $this->nro_documento = "";
                $this->observacion = "";

                $this->total = Compras::getTotal();
                $this->itemsQuantity = Compras::getTotalQuantity();
                $this->emit('save-ok', 'venta registrada con exito');

                redirect('/compras');
                //$this->emit('print-ticket', $sale->id);
            } catch (Exception $e) {
                DB::rollback();
                dd($e->getMessage());
            }
        }
    }
    public function mostrarOrdenes()
    {
        $this->orden = OrdenCompra::whereIn('destino_id', $this->vs)->where('estado_entrega', 'NORECIBIDO')->get();
        $this->emit('verOrdenes');
    }
    public function recibirOrden(OrdenCompra $id)
    {
        $this->ordencompraselected = $id->id;
        $this->provider=$id->proveedor->nombre_prov;
        $this->destinocompra=$id->destino->id;

        foreach ($id->detallecompra as $data) {
            $this->increaseQty($data->product_id, $data->cantidad, $data->precio);
        }

        $this->emit('ordenes_close');
    }
    public function mostrarOperacionInicial()
    {
        if ($this->stockswitch == true) {
            $this->stockswitch = false;
        } else {
            $this->stockswitch = true;
        }
    }


    public function updatedCostoUnitario()
    {

        if ($this->costoUnitario >= 0 and $this->costoUnitario != "") {

            $this->costoTotal = $this->costoUnitario * $this->cantidad;
        }
    }

    public function updatedCostoTotal()
    {
        if ($this->costoTotal > 0 and $this->cantidad != null) {
            $this->costoUnitario = $this->costoTotal / $this->cantidad;
        }
    }

    
public function stockChange(){
    if ($this->cantidad>0) {
        
        $this->costoTotal=$this->costoUnitario*$this->cantidad;
    }

}
}