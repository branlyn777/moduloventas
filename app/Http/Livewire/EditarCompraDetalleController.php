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
use App\Models\Product;
use App\Models\ProductosDestino;
use App\Models\Provider;
use App\Models\SaleLote;
use App\Models\SalidaLote;
use App\Models\Sucursal;
use App\Models\TransferenciaLotes;
use App\Models\Unidad;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


use Darryldecode\Cart\Facades\EditarFacade as EditarCompra;
use Error;
use Exception;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Foreach_;

class EditarCompraDetalleController extends Component
{


    use WithPagination;
    use WithFileUploads;
    public  $nro_compra, $search, $provider, $fecha_compra, $vs = [], $auxi, $erroresedicion = [],
        $usuario, $metodo_pago, $pago_parcial = 0, $tipo_documento, $nro_documento, $observacion, $selected_id, $descuento = 0, $saldo = 0, 
        $subtotal, $cantidad_minima, $passed,
        $estado_compra, $total_compra, $itemsQuantity, $price, $status, $tipo_transaccion, $destino, $porcentaje, $importe, $dscto = 0,
         $aplicar = false, $lote_compra, $destino1, $datalistcarrito,$ide,$aux;

    public $nombre_prov, $apellido_prov, $direccion_prov, $correo_prov,
        $telefono_prov, $col, $mensaje_toast, $descripcion, $stockswitch;

    public $nombre, $costo, $precio_venta, $barcode, $codigo, $caracteristicas, $lote, $unidad, $marca, $garantia, $industria,
        $categoryid, $component, $selected_categoria, $image, $selected_id2;

    public function mount()
    {
        $this->ide = session('id_compra');
        EditarCompra::clear();
        $this->aux = Compra::find($this->ide);
        //dd($this->ide);
        $this->cargarCarrito();
        $this->col = collect();

        $this->componentName = "Editar Compras";
        $this->fecha_compra = Compra::where('compras.id', $this->ide)->value('created_at');
        $this->usuario = $this->aux->user->name;
        $this->estado_compra = "finalizada";
        $this->selected_id = 0;
        $this->tipo_transaccion = $this->aux->transaccion;
        $this->pago_parcial = $this->aux->saldo > 0 ? $this->aux->importe_total - $this->aux->saldo : 0;
        $this->destino = $this->aux->destino_id;
        $this->destino2 = $this->aux->destino_id;
        $this->tipo_transaccion = $this->aux->transaccion;
        $this->tipo_documento = $this->aux->tipo_doc;
        $this->total_compra = $this->aux->importe_total;
        $this->subtotal = EditarCompra::getTotal();
        $this->imagen = 'noimagenproduct.png';
        $this->provider = Provider::where('id', $this->aux->proveedor_id)->pluck('nombre_prov');
        $this->nro_documento = $this->aux->nro_documento;
        $this->lote_compra = $this->aux->lote_compra;

        $this->porcentaje = $this->aux->descuento > 0 ? ($this->aux->descuento / $this->aux->importe_total) : 0;

        $this->verPermisos();
    }

    public function updatingDestino()
    {
        $this->col = collect();
        $this->cambioDestino();
    }
    public function render()
    {
        if (strlen($this->search) > 0)
            $prod = Product::select('products.*')
                ->where('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('codigo', 'like', '%' . $this->search . '%')
                ->orWhere('marca', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%')
                ->get();
        else
            $prod = "cero";
        //---------------Select destino de la compra----------------------//
        $data_destino = Sucursal::join('destinos as dest', 'sucursals.id', 'dest.sucursal_id')
            ->whereIn('dest.id', $this->vs)
            ->select('dest.*', 'dest.id as destino_id', 'sucursals.*')
            ->get();

        //--------------------Select proveedor---------------------------//
        $data_provider = Provider::select('providers.*')->get();
        return view('livewire.compras.editcomponent', [
            'data_prod' => $prod,
            'cart' => EditarCompra::getContent()->sortBy('name'),
            'data_suc' => $data_destino,
            'data_prov' => $data_provider,
            'categories' => Category::where('categories.categoria_padre', 0)->orderBy('name', 'asc')->get(),
            'unidades' => Unidad::orderBy('nombre', 'asc')->get(),
            'marcas' => Marca::select('nombre')->orderBy('nombre', 'asc')->get(),
            'subcat' => Category::where('categories.categoria_padre', $this->selected_id2)->where('categories.categoria_padre', '!=', 'Elegir')->get()
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }


    public function cargarCarrito()
    {
        $this->datalistcarrito = Compra::join('compra_detalles', 'compra_detalles.compra_id', 'compras.id')
            ->join('products', 'products.id', 'compra_detalles.product_id')
            ->join('lotes', 'lotes.id', 'compra_detalles.lote_compra')
            ->select('compras.*', 'products.id as product_id', 'products.codigo as codigo_prod', 'products.nombre as product_nombre', 'compra_detalles.cantidad as cantidad', 'compra_detalles.precio as precio', 'lotes.pv_lote', 'lotes.costo')
            ->where('compras.id', $this->ide)
            ->where('compra_detalles.deleted_at',null)
            ->get();
        //$bn =EditarTransferencia::getContent();

        //dd($this->datalistcarrito);

        foreach ($this->datalistcarrito as $value) {

            $attributos = [
                'precio' => $value->pv_lote,
                'codigo' => $value->codigo_prod,

            ];

            $products = array(
                'id' => $value->product_id,
                'name' => $value->product_nombre,
                'price' => $value->costo,
                'quantity' => $value->cantidad,
                'attributes' => $attributos
            );

            EditarCompra::add($products);
        }
    }

    public function increaseQty($productId, $cant = 1, $precio_compra = 0)
    {

        $product = Product::select('products.*')
            ->where('products.id', $productId)->first();



        $attributos = [
            'precio' => $product->precio_venta,
            'codigo' => $product->codigo,
            'fecha_compra' => $this->fecha_compra
        ];

        $products = array(
            'id' => $product->id,
            'name' => $product->nombre,
            'price' => $precio_compra,
            'quantity' => $cant,
            'attributes' => $attributos
        );

        EditarCompra::add($products);
        // Compras::add($product->id, $product->name, $precio_compra, $cant);

        $this->total = EditarCompra::getTotal();
        $this->itemsQuantity = EditarCompra::getTotalQuantity();

        $this->subtotal = EditarCompra::getTotal();
        $this->total_compra = $this->subtotal - $this->descuento;
    }
    public function addProvider()
    {
        $obj = new Prov;
        $obj->nombre_prov = $this->nombre_prov;
        $obj->apellido = $this->apellido_prov;
        $obj->direccion = $this->direccion_prov;
        $obj->correo = $this->correo_prov;
        $obj->telefono = $this->telefono_prov;

        $obj->Store();
        $this->resetProv();
        $this->emit('prov_added', 'Proveedor Registrado');
    }
    public function GenerateCode()
    {

        $min = 10000;
        $max = 99999;
        $this->codigo = Carbon::now()->format('ymd') . mt_rand($min, $max);
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
        $this->resetUI();
        $this->emit('products_added', 'ahola');
    }

    public function UpdateQty($productId, $cant)
    {
        $ss = $this->aux->compraDetalle;

        if ($ss->where('product_id', $productId)->isNotEmpty()) {
            $lote = $ss->where('product_id', $productId)->first()->lote_compra;
            //dd($lote);
            $ventas = SaleLote::where('lote_id', $lote)->get();
            $salidas = SalidaLote::where('lote_id', $lote)->get();
            $transferencias = TransferenciaLotes::where('lote_id', $lote)->get();
            if (!$ventas->isEmpty() or !$salidas->isEmpty() or !$transferencias->isEmpty()) {
                $this->mensaje_toast = 'La cantidad editada del producto esta incorrecta por que ya fue distribuido.';
                $this->emit('error-item');
                return;
            } else {

                $product = Product::select('products.*')
                    ->where('products.id', $productId)->first();

                $exist = EditarCompra::get($productId);
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

                    EditarCompra::add($products);
                    $this->subtotal = EditarCompra::getTotal();
                    $this->itemsQuantity = EditarCompra::getTotalQuantity();

                    $this->subtotal = EditarCompra::getTotal();
                    $this->total_compra = $this->subtotal - $this->descuento;


                    $this->mensaje_toast = 'Cantidad actualizada';
                    $this->emit('item-updated');
                }
            }
        } else {

            $product = Product::select('products.*')
                ->where('products.id', $productId)->first();

            $exist = EditarCompra::get($productId);
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

                EditarCompra::add($products);
                $this->subtotal = EditarCompra::getTotal();
                $this->itemsQuantity = EditarCompra::getTotalQuantity();

                $this->subtotal = EditarCompra::getTotal();
                $this->total_compra = $this->subtotal - $this->descuento;


                $this->mensaje_toast = 'Cantidad actualizada';
                $this->emit('item-updated');
            }
        }
    }

    public function UpdatePrice($productId, $price = 20)
    {
        $title = '';
        $product = Product::select('products.*')
            ->where('products.id', $productId)->first();

        $exist = EditarCompra::get($productId);
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

            EditarCompra::add($products);

            $this->subtotal = EditarCompra::getTotal();
            $this->itemsQuantity = EditarCompra::getTotalQuantity();

            $this->subtotal = EditarCompra::getTotal();
            $this->total_compra = $this->subtotal - $this->descuento;
        }
    }

    public function UpdatePrecioVenta($productId, $price = 20)
    {

        $product = Product::select('products.*')
            ->where('products.id', $productId)->first();

        $exist = EditarCompra::get($productId);
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

            EditarCompra::add($products);

            $this->subtotal = EditarCompra::getTotal();
            $this->itemsQuantity = EditarCompra::getTotalQuantity();

            $this->subtotal = EditarCompra::getTotal();
            $this->total_compra = $this->subtotal - $this->descuento;
            $this->mensaje_toast = 'Se actualizo el detalle de este item con exito.';
            $this->emit('modificiacion_exitosa');
        }
    }


    public function removeItem($productId)
    {


        EditarCompra::remove($productId);

        $this->subtotal = EditarCompra::getTotal();
        $this->itemsQuantity = EditarCompra::getTotalQuantity();

        $this->subtotal = EditarCompra::getTotal();
        $this->total_compra = $this->subtotal - $this->descuento;
    }

    public function deleteItem($productId)
    {
        //verificar si es un producto que no estaba antes en el detalle de compra
        //$prod=CompraDetalle::where('compra_id',$this->aux->id)->get();
        $positivo=$this->aux->compradetalle->contains('product_id', $productId);
    
        if ($positivo ==true) {

            $lotes = CompraDetalle::where('compra_id', $this->aux->id)->where('product_id',$productId)->first()->lote_compra;
            $ventas = SaleLote::where('lote_id', $lotes)->get();
            $salidas = SalidaLote::where('lote_id', $lotes)->get();

            if (!$ventas->isEmpty() or !$salidas->isEmpty()) {
                $this->mensaje_toast = 'No puede modificar ni quitar este producto.';
                $this->emit('error-item');
                return;
            } else {
                EditarCompra::remove($productId);
                $this->mensaje_toast = 'Se actualizo el detalle de este item con exito.';
                $this->emit('modificiacion_exitosa');
                $this->subtotal = EditarCompra::getTotal();
                $this->total_compra = $this->subtotal - $this->descuento;
            }
        } else {
            $this->mensaje_toast = 'Se actualizo el detalle de este item con exito.';
            $this->emit('modificiacion_exitosa');
            EditarCompra::remove($productId);
            $this->itemsQuantity = EditarCompra::getTotalQuantity();
            $this->subtotal = EditarCompra::getTotal();
            $this->total_compra = $this->subtotal - $this->descuento;
        }
    }

    public function resetUI()
    {

        $this->costo = '';
        $this->nombre = '';
        $this->precio_venta = '';
        $this->caracteristicas = '';
        $this->codigo = '';

        $this->lote = '';
        $this->unidad = '';
        $this->marca = null;
        $this->industria = '';
        $this->garantia = null;
        $this->cantidad_minima = null;
        $this->categoryid = 'Elegir';
        $this->image = null;

        $this->resetValidation();
    }
    public function resetProv()
    {
        $this->nombre_prov = '';
        $this->apellido_prov = '';
        $this->direccion_prov = '';
        $this->correo_prov = '';
        $this->telefono_prov = '';
        $this->resetValidation();
    }

    public function compraCredito()
    {
        if ($this->tipo_transaccion == 'CONTADO') {
            $this->saldo_por_pagar = 0;
            $this->pago_parcial = $this->total_compra;
        } else {
            $this->saldo_por_pagar = $this->total_compra - $this->pago_parcial;
        }
    }

    public function descuento_change()
    {
        if ($this->subtotal > 0 && $this->descuento > 0 && $this->descuento < $this->subtotal) {

            $this->total_compra = $this->subtotal - $this->descuento;
            $this->porcentaje = (round($this->descuento / $this->subtotal, 2)) * 100;
        } else {
            $this->descuento = 0;
        }
    }
    public function validateCarrito()
    {
        if (EditarCompra::getTotalQuantity() == 0) {
            $this->emit('empty_cart', 'No tiene productos en el detalle de compra');
        }
    }

    public function guardarCompra()
    {

        $rules = [
            'provider' => 'required',
            'destino' => 'required|not_in:Elegir'
        ];
        $messages = [
            'provider.required' => 'El nombre del proveedor es requerido.',
            'destino.required' => 'Elige un destino',
            'destino.not_in' => 'Elija un destino del producto'
        ];

        $this->validate($rules, $messages);
        $this->validateCarrito();

        if ($this->subtotal <= 0) {
            $this->emit('sale-error', 'Agrega productos a la compra');
            return;
        }

        //  $this->compraCredito();


        try {
            DB::beginTransaction();


            if ($this->ide) {

                $items = EditarCompra::getContent();

                foreach ($this->aux->compradetalle as $comp) {

                    $presente = $items->contains('id', $comp->product_id);
                    if ($presente == false) {
                        $comp->Delete();
                        Lote::find($comp->lote_compra)->delete();
                    }

                    $q = ProductosDestino::where('product_id', $comp->product_id)
                        ->where('destino_id', $this->destino2)->value('stock');

                    ProductosDestino::updateOrCreate(['product_id' => $comp->product_id, 'destino_id' => $this->destino2], ['stock' => $q - $comp->cantidad]);
                }

                foreach ($items as $item) {
                    //buscamos el item del carrito en la compra detalle, si se encuentra solo lo modicamos, caso contrario creamos un nuevo registro
                    $producto = $this->aux->compradetalle->contains('product_id', $item->id);

                    if ($producto == true) {
                        //modificamos el detalle producto
                        $detalle=$this->aux->compradetalle->where('product_id', $item->id)->first()->id;
                   
                        CompraDetalle::find($detalle)->update([
                            'precio' => $this->tipo_documento == 'FACTURA' ? $item->price * 0.87 : $item->price,
                            'cantidad' => $item->quantity,

                        ]);
                        $lote_edit = $this->aux->compradetalle->where('product_id', $item->id)->first()->lote_compra;
                        Lote::where('id', $lote_edit)->update([
                            'existencia' => $item->quantity,
                            'costo' => $item->price,
                            'product_id' => $item->id,
                            'pv_lote' => $item->attributes->precio
                        ]);
                    } else {


                        $lot = Lote::create([
                            'existencia' => $item->quantity,
                            'costo' => $item->price,
                            'status' => 'Activo',
                            'product_id' => $item->id,
                            'pv_lote' => $item->attributes->precio
                        ]);

                        CompraDetalle::create([
                            'precio' => $this->tipo_documento == 'FACTURA' ? $item->price * 0.87 : $item->price,
                            'cantidad' => $item->quantity,
                            'product_id' => $item->id,
                            'compra_id' => $this->ide,
                            'lote_compra' => $lot->id
                        ]);
                    }


                    $q = ProductosDestino::where('product_id', $item->id)
                        ->where('destino_id', $this->destino)->value('stock');

                    ProductosDestino::updateOrCreate(['product_id' => $item->id, 'destino_id' => $this->destino], ['stock' => $q + $item->quantity]);
                }
            }

            $auxi2 = Compra::find($this->ide);
            $auxi2->importe_total = $this->total_compra;
            //$auxi2->descuento=$this->descuento;
            $auxi2->transaccion = $this->tipo_transaccion;
            $auxi2->tipo_doc = $this->tipo_documento;
            $auxi2->nro_documento = $this->nro_documento;
            //$auxi2->lote_compra=$this->lote_compra;
            $auxi2->observacion = $this->observacion;
            $auxi2->proveedor_id = Provider::where('nombre_prov', $this->provider)->value('id');
            $auxi2->destino_id = $this->destino;
            $auxi2->user_id = Auth()->user()->id;
            $auxi2->save();

            DB::commit();

            EditarCompra::clear();
            $this->total_compra = 0;
            $this->subtotal = 0;
            $this->provider = "";
            $this->destino = "";
            $this->descuento = 0;
            $this->porcentaje = 0;
            $this->tipo_transaccion = "Contado";
            $this->pago_parcial = "";
            $this->tipo_documento = "Factura";
            $this->nro_documento = "";
            $this->observacion = "";

            $this->total = EditarCompra::getTotal();
            $this->itemsQuantity = EditarCompra::getTotalQuantity();

            redirect('/compras');
        } catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function verificarLotes()
    {

        $auxi = CompraDetalle::where('compra_detalles.compra_id', $this->ide)->get();
        //verificar si la cantidad es menor o igual al lote de ese producto

        foreach ($auxi as $data) {
            //primero se verifica que tenga disponibilidad
            if (TransferenciaLotes::where('lote_id', $data->lote_compra)->exists()) {
            }
        }

        foreach ($auxi as $data) {


            $lotetotal = SaleLote::where('lote_id', $data->lote_compra)->select('cantidad')->value('cantidad');


            //dd($lotetotal);
            if ($lotetotal > 0) {
                $auxiedit = EditarCompra::get($data->product_id);
                if ($auxiedit != null) {

                    if ($auxiedit->quantity < $lotetotal) {
                        //La nueva cantidad asignada al item es menor a lo que ya se distribuyo, error
                        //dd("si ingreso");
                        $this->passed = false;
                        //dd($auxiedit);
                        $this->erroresedicion[$auxiedit->id] = "La cantidad editada del item no puede ser menor a la cantidad de la distribucion.";
                        // dd($this->passed);

                    } elseif ($auxiedit->quantity > $lotetotal) {
                        $lot = Lote::where('id', $data->lote_compra)->where('status', 'Activo');
                        if ($lot != null) {
                            $this->passed = true;
                        } else {
                            //mensaje que el lote ya ha sido distribuido y no esta activo, cree un nuevo lote por favor
                            $this->passed = false;
                            $this->erroresedicion[$auxiedit] = "El lote de esta compra esta inactivo y no puede ser editado.";
                        }
                    } else {
                        $this->passed = true;
                    }
                } else {
                    //se ha eliminado el item pero este item ya fue distribuido, error
                    $this->passed = false;
                    $this->erroresedicion[$auxiedit] = "No puede retirar esta";
                }
                //dd("hasta aqui llego");
            } else {
                $this->passed = true;
            }
        }
    }

    public function exit()
    {
        EditarCompra::clear();
        $this->resetUI();
        redirect('/compras');
    }

    public function cambioDestino()
    {
        $detalles = $this->aux->compradetalle()->get();
        //dd($detalles);

        foreach ($detalles as $detalle) {

            $lotes = CompraDetalle::where('id', $detalle->id)->get('lote_compra');
            $ventas = SaleLote::whereIn('lote_id', $lotes)->get();
            $salidas = SalidaLote::whereIn('lote_id', $lotes)->get();
            $transferencias = TransferenciaLotes::whereIn('lote_id', $lotes)->get();

            if (!$ventas->isEmpty() or !$salidas->isEmpty() or !$transferencias->isEmpty()) {
                $this->col->push('El item ' . $detalle->productos->nombre . ' tiene operaciones realizadas.');
                //$this->col=$detalle->productos()->nombre;
                $this->emit('error-destino');
                return;
            } else {

                $this->mensaje_toast = 'Destino de la compra actualizado.';
                $this->emit('destino_actualizado');
            }
        }
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


    public function mostrarOperacionInicial()
    {
        if ($this->stockswitch == true) {
            $this->stockswitch = false;
        } else {
            $this->stockswitch = true;
        }
    }
}