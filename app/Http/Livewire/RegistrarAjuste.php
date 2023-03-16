<?php

namespace App\Http\Livewire;

use App\Imports\StockImport;
use App\Models\Ajustes;
use App\Models\Destino;
use App\Models\DetalleAjustes;
use App\Models\DetalleEntradaProductos;
use App\Models\DetalleSalidaProductos;
use App\Models\IngresoProductos;
use App\Models\Lote;
use App\Models\Product;
use App\Models\ProductosDestino;
use App\Models\SalidaLote;
use App\Models\SalidaProductos;
use App\Models\Sucursal;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;

class RegistrarAjuste extends Component
{
    use WithFileUploads;
    public  $fecha, $buscarproducto = 0, $selected, $registro, $tipo_de_operacion, $qq, $lotecantidad, $precioventa, $sucursales, $destinos, $sucursal,
        $archivo, $searchproduct, $mensaje_toast, $costo, $sm, $concepto, $destino, $detalle, $tipo_proceso, $col, $show1, $show2, $show,
        $destinosucursal, $observacion, $file, $cantidad, $result, $arr, $id_operacion, $destino_delete, $nextpage, $fromDate, $toDate, $failures, $active1, $active2, $active3, $lugar;
    private $pagination = 15;

    public function mount()
    {
        $this->col = collect([]);
        $this->tipo_proceso = "Elegir";
        $this->registro = 'Manual';
        $this->sucursal = Auth()->user()->sucursalusers->where('estado', 'ACTIVO')->first()->sucursal_id;

        $this->destino = null;
        $this->concepto = "Elegir";
        $this->tipo_proceso = null;
        $this->active1 = 'js-active';
        $this->active2 = null;
        $this->active3 = null;
        $this->show = 'js-active';
    }





    public function render()
    {
        if (strlen($this->searchproduct) > 0) {

            if ($this->tipo_proceso == 'Salida') {
                $st = Product::join('productos_destinos as pd', 'pd.product_id', 'products.id')
                    ->join('destinos', 'destinos.id', 'pd.destino_id')
                    ->select('products.*', 'pd.stock as pstock')
                    ->where(function ($query) {
                        $query->where('products.nombre', 'like', '%' . $this->searchproduct . '%')
                            ->orWhere('products.codigo', 'like', '%' . $this->searchproduct . '%');
                    })
                    ->where('destinos.id', $this->destino)
                    ->where('pd.stock', '>', 0)

                    ->get()
                    ->take(3);
                //Extraemos en un array todos los registros que ya se encuentran en la colleccion de items
                $arr = $this->col->pluck('product_id');

                //Filtramos de la coleccion de productos los productos seleccionados
                $this->sm = $st->whereNotIn('id', $arr);
            } else {

                $st = Product::select('products.*')
                    ->where('products.nombre', 'like', '%' . $this->searchproduct . '%')
                    ->orWhere('products.codigo', 'like', '%' . $this->searchproduct . '%')
                    ->get()->take(3);

                $arr = $this->col->pluck('product_id');
                $this->sm = $st->whereNotIn('id', $arr);
            }
        }

        $this->sucursales = Sucursal::all();

        $this->destinos = Destino::where('sucursal_id', $this->sucursal)
            ->get();


        return view('livewire.entradas_salidas.registrarajuste')
            ->extends('layouts.theme.app')
            ->section('content');
    }



    public function updatedDestino()
    {
        if ($this->col->isNotEmpty()) {
            $this->emit('vaciarlista');
        }
        if ($this->failures != null and $this->archivo != null) {

            $this->failures = null;
            $this->archivo = null;
        }

        $this->show = '';
        $this->show1 = 'js-active';
        $this->active1 = 'js-active';
        $this->active2 = 'js-active';
        $this->active3 = '';
        $this->show2 = '';


        $this->lugar = Sucursal::find($this->sucursal)->name . '-' . Destino::find($this->destino)->nombre;
    }

    public function updatedConcepto()
    {


        if ($this->col->isNotEmpty()) {
            $this->emit('vaciarlista');
        }
        if ($this->failures != null and $this->archivo != null) {

            $this->failures = null;
            $this->archivo = null;
        }

        $this->show = 'js-active';
        $this->show1 = '';
        $this->active1 = 'js-active';
        $this->active2 = '';
        $this->active3 = '';
        $this->show2 = '';
    }


    public function addProduct(Product $id)
    {
        if ($this->tipo_proceso == 'Salida') {
            try {
                $pd = ProductosDestino::where('product_id', $id->id)->where('destino_id', $this->destino)->select('stock')->value('stock');
                if ($pd > 0) {
                    $this->col->push(['product_id' => $id->id, 'product_name' => $id->nombre, 'product_codigo' => $id->codigo, 'cantidad' => 1]);
                } else {
                    $this->emit('stock-insuficiente');
                }
            } catch (Exception $e) {
                //cuando el producto no esta registrado
                $this->mensaje_toast = "Error de salida de productos";
                $this->emit('error_salida');
            }
        } else {
            $pd = ProductosDestino::where('product_id', $id->id)->where('destino_id', $this->destino)->select('stock')->value('stock');
            $r = $this->datalote($id->id);
            if ($r != null) {
                $costo = $r->costo;
                $precio = $r->pv_lote;
            } else {
                $costo = 0;
                $precio = 0;
            }

            if ($this->tipo_proceso == 'INGRESO' or $this->concepto == 'Inventario Inicial') {
                $this->col->push([
                    'product_id' => $id->id,
                    'product_name' => $id->nombre,
                    'product_codigo' => $id->codigo,
                    'costo' => $costo,
                    'precioventa' => $precio,
                    'cantidad' => 1
                ]);
            } else {

                $this->col->push([
                    'product_id' => $id->id,
                    'product_name' => $id->nombre,
                    'product_codigo' => $id->codigo,
                    'stockactual' =>  $pd != null ? $pd : 0,
                    'recuento' => 0,
                    'costo' => $costo,
                    'pv_lote' => $precio

                ]);
            }
        }
    }

    public function eliminaritem($id)
    {

        $item = null;
        foreach ($this->col as $key => $value) {

            if ($value['product_id'] == $id) {
                $item = $key;
                break;
            }
        }

        $this->col->pull($item);
    }


    public function import()
    {

        try {
            //$import->import('import-users.xlsx');
            Excel::import(new StockImport($this->destino, 'Inventario Inicial', $this->observacion), $this->archivo);
            return redirect()->route('operacionesinv');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {

            $this->failures = $e->failures();
        } catch (FileNotFoundException $errorarchivo) {
            $this->emit('sinarchivo');
        } catch (Exception $e) {


            $this->emit('errorarchivo');
        }
    }



    public function GuardarOperacion()
    {

        $this->ValidarDatos();
        if ($this->tipo_proceso == 'INGRESO' or $this->concepto == 'Inventario Inicial' and $this->col->isNotEmpty()) {
            DB::beginTransaction();
            try {
                $rs = IngresoProductos::create([
                    'destino' => $this->destino,
                    'user_id' => Auth()->user()->id,
                    'concepto' => $this->tipo_proceso == 'INGRESO' ? 'INGRESO' : 'INICIAL',
                    'observacion' => $this->observacion
                ]);
                foreach ($this->col as $datas) {


                    $lot = Lote::create([
                        'existencia' => $datas['cantidad'],
                        'costo' => $datas['costo'],
                        'status' => 'Activo',
                        'product_id' => $datas['product_id'],
                        'pv_lote' => $datas['precioventa']
                    ]);

                    DetalleEntradaProductos::create([
                        'product_id' => $datas['product_id'],
                        'cantidad' => $datas['cantidad'],
                        'costo' => $datas['costo'],
                        'id_entrada' => $rs->id,
                        'lote_id' => $lot->id
                    ]);

                    $q = ProductosDestino::where('product_id', $datas['product_id'])
                        ->where('destino_id', $this->destino)->value('stock');

                    ProductosDestino::updateOrCreate(['product_id' => $datas['product_id'], 'destino_id' => $this->destino], ['stock' => $q + $datas['cantidad']]);
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                dd($e->getMessage());
            }

            $this->mensaje_toast = "Operacion Registrada";
            $this->emit('operacion-added');
            return Redirect::to('operacionesinv');
            $this->resetui();
        } elseif ($this->tipo_proceso == 'Salida' and $this->col->isNotEmpty()) {

            try {

                $operacion = SalidaProductos::create([
                    'destino' => $this->destino,
                    'user_id' => Auth()->user()->id,
                    'concepto' => 1,
                    'observacion' => $this->observacion
                ]);


                foreach ($this->col as $datas) {

                    $auxi = DetalleSalidaProductos::create([
                        'product_id' => $datas['product_id'],
                        'cantidad' => $datas['cantidad'],
                        'id_salida' => $operacion->id
                    ]);


                    $lot = Lote::where('product_id', $datas['product_id'])->where('status', 'Activo')->get();

                    //obtener la cantidad del detalle de la venta 
                    $this->qq = $datas['cantidad']; //q=8
                    foreach ($lot as $val) {
                        //lote1= 3 Lote2=3 Lote3=3
                        $this->lotecantidad = $val->existencia;
                        //dd($this->lotecantidad);
                        if ($this->qq > 0) {
                            //true//5//2
                            //dd($val);
                            if ($this->qq >= $this->lotecantidad) {
                                $ss = SalidaLote::create([
                                    'salida_detalle_id' => $auxi->id,
                                    'lote_id' => $val->id,
                                    'cantidad' => $val->existencia
                                ]);
                                $val->update([

                                    'existencia' => 0,
                                    'status' => 'Inactivo'

                                ]);
                                $val->save();
                                $this->qq = $this->qq - $this->lotecantidad;
                                //dump("dam",$this->qq);
                            } else {
                                //dd($this->lotecantidad);
                                $ss = SalidaLote::create([
                                    'salida_detalle_id' => $auxi->id,
                                    'lote_id' => $val->id,
                                    'cantidad' => $this->qq

                                ]);


                                $val->update([
                                    'existencia' => $this->lotecantidad - $this->qq
                                ]);
                                $val->save();
                                $this->qq = 0;
                                //dd("yumi",$this->qq);
                            }
                        }
                    }


                    $q = ProductosDestino::where('product_id', $datas['product_id'])
                        ->where('destino_id', $this->destino)->value('stock');

                    $varm = $datas['cantidad'];


                    ProductosDestino::updateOrCreate(['product_id' => $datas['product_id'], 'destino_id' => $this->destino], ['stock' => $q - $varm]);
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                dd($e->getMessage());
            }

            $this->mensaje_toast = "Operacion Registrada";
            $this->emit('operacion-added');
            $this->resetui();
            return Redirect::to('operacionesinv');
        } elseif ($this->concepto == 'Ajuste Inventarios' and $this->col->isNotEmpty()) {
            try {

                $ajuste = Ajustes::create([
                    'destino' => $this->destino,
                    'user_id' => Auth()->user()->id,
                    'observacion' => $this->observacion
                ]);


                foreach ($this->col as $datas) {

                    $auxi = DetalleAjustes::create([
                        'product_id' => $datas['product_id'],
                        'recuentofisico' => $datas['recuento'],
                        'diferencia' => $datas['recuento'] - $datas['stockactual'] > 0 ? $datas['recuento'] - $datas['stockactual'] : ($datas['recuento'] - $datas['stockactual']) * -1,
                        'tipo' => $datas['recuento'] - $datas['stockactual'] > 0 ? 'positiva' : 'negativa',
                        'id_ajuste' => $ajuste->id

                    ]);

                    if ($datas['recuento'] > $datas['stockactual']) {


                        $lot = Lote::where('product_id', $datas['product_id'])->where('status', 'Activo')->first();

                        if ($lot != null) {
                            $lot->update([

                                'existencia' => $lot->existencia + ($datas['recuento'] - $datas['stockactual'])
                            ]);
                            $lot->save();
                            ProductosDestino::updateOrCreate(['product_id' => $datas['product_id'], 'destino_id' => $this->destino], ['stock' => $datas['recuento']]);
                        } else {
                            $lot = Lote::create([
                                'existencia' => $datas['recuento'],
                                'costo' => $datas['costo'],
                                'pv_lote' => $datas['pv_lote'],
                                'status' => 'Activo',
                                'product_id' => $datas['product_id']
                            ]);
                        }
                    } else {


                        $lot = Lote::where('product_id', $datas['product_id'])->where('status', 'Activo')->get();
                        //obtener la cantidad del detalle de la venta 
                        $this->qq = $datas['stockactual'] - $datas['recuento']; //q=8
                        foreach ($lot as $val) {
                            //lote1= 3 Lote2=3 Lote3=3
                            $this->lotecantidad = $val->existencia;
                            //dd($this->lotecantidad);
                            if ($this->qq >= 0) {
                                //true//5//2
                                //dd($val);
                                if ($this->qq >= $this->lotecantidad) {

                                    $val->update([

                                        'existencia' => 0,
                                        'status' => 'Inactivo'

                                    ]);
                                    $val->save();
                                    $this->qq = $this->qq - $this->lotecantidad;
                                    //dump("dam",$this->qq);
                                } else {
                                    //dd($this->lotecantidad);



                                    $val->update([
                                        'existencia' => $this->lotecantidad - $this->qq
                                    ]);
                                    $val->save();
                                    $this->qq = 0;
                                    //dd("yumi",$this->qq);
                                }
                            }
                        }
                    }
                    $q = ProductosDestino::where('product_id', $datas['product_id'])
                        ->where('destino_id', $this->destino)->value('stock');

                    ProductosDestino::updateOrCreate(['product_id' => $datas['product_id'], 'destino_id' => $this->destino], ['stock' => $datas['recuento']]);
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                dd($e->getMessage());
            }

            $this->mensaje_toast = "Operacion Registrada";
            $this->emit('operacion-added');
            $this->resetui();
            return Redirect::to('operacionesinv');
        } else {
            $this->emit('sinproductos');
        }
    }

    public function resetui()
    {
        $this->tipo_proceso = null;
        $this->archivo = null;
        $this->concepto = 'Elegir';
        $this->registro = "Manual";
        $this->destino = 'Elegir';
        $this->nextpage = false;
        $this->reset([
            'costo', 'destinosucursal', 'observacion', 'cantidad'
        ]);


        foreach ($this->col as $key => $value) {
            $this->col->pull($key);
        }
    }
    public function UpdateCosto(Product $product, $costo)
    {
        $item = $this->col->where('product_id', $product->id);
        $cantidad = $item->first()['cantidad'];
        $precioventa = $item->first()['precioventa'];
        // $costo=$item->first()['costo'];
        $this->col->pull($item->keys()->first());
        $this->col->push([
            'product_id' => $product->id,
            'product_name' => $product->nombre,
            'product_codigo' => $product->codigo,
            'costo' => $costo,
            'precioventa' => $precioventa,
            'cantidad' => $cantidad
        ]);
    }
    public function UpdatePrecioVenta(Product $product, $preciov)
    {

        $item = $this->col->where('product_id', $product->id);
        $cantidad = $item->first()['cantidad'];
        $costo = $item->first()['costo'];
        $this->col->pull($item->keys()->first());
        $this->col->push([
            'product_id' => $product->id,
            'product_name' => $product->nombre,
            'product_codigo' => $product->codigo,
            'costo' => $costo,
            'precioventa' => $preciov,
            'cantidad' => $cantidad
        ]);

        //dd($this->col);
    }
    public function UpdateQty(Product $product, $cant)
    {
        $item = $this->col->where('product_id', $product->id);
        if ($this->tipo_proceso == "INGRESO" or $this->concepto == 'Inventario Inicial') {
            if ($cant == 0) {
                $this->col->pull($item->keys()->first());
            } else {
                $precioventa = $item->first()['precioventa'];
                $costo = $item->first()['costo'];

                $this->col->push([
                    'product_id' => $product->id,
                    'product_name' => $product->nombre,
                    'product_codigo' => $product->codigo,
                    'costo' => $costo,
                    'precioventa' => $precioventa,
                    'cantidad' => $cant
                ]);
                $this->col->pull($item->keys()->first());
            }
        } else {
            if ($cant == 0) {
                $this->col->pull($item->keys()->first());
            } else {
                if ($this->concepto == 'Inventario Inicial') {
                    $stock_p = ProductosDestino::where('product_id', $product->id)
                        ->where('destino_id', $this->destino)->select('stock')->value('stock');
                    if ($cant <= $stock_p) {

                        $this->col->pull($item->keys()->first());
                        $this->col->push([
                            'product_id' => $product->id,
                            'product_name' => $product->nombre,
                            'product_codigo' => $product->codigo,
                            'cantidad' => $cant
                        ]);
                    } else {

                        $this->emit('stock-insuficiente');
                    }
                } else {
                }
            }
        }
    }

    public function UpdateRecuento(Product $product, $cant, $costo = 0, $precio = 0)
    {
        $item = $this->col->where('product_id', $product->id);
        $st = $item->first()['stockactual'];
        $r = $this->datalote($product->id);

        if ($r != null) {
            $costo = $r->costo;
            $precio = $r->pv_lote;
        } else {
            $costo = 0;
            $precio = 0;
        }

        $this->col->pull($item->keys()->first());
        $this->col->push([
            'product_id' => $product->id,
            'product_name' => $product->nombre,
            'product_codigo' => $product->codigo,
            'stockactual' =>  $st,
            'recuento' => $cant,
            'costo' => $costo,
            'pv_lote' => $precio,

        ]);
    }

    public function UpdateCostoLote(Product $product, $costo)
    {
        $item = $this->col->where('product_id', $product->id);
        $st = $item->first()['stockactual'];
        $data_lote = Lote::where('product_id', $product->id)->where('status', 'Activo');
        $precio = $item->first()['pv_lote'];
        $recuento = $item->first()['recuento'];


        $this->col->pull($item->keys()->first());
        $this->col->push([
            'product_id' => $product->id,
            'product_name' => $product->nombre,
            'product_codigo' => $product->codigo,
            'stockactual' =>  $st,
            'recuento' =>  $recuento,
            'costo' => $costo,
            'pv_lote' => $precio
        ]);
    }
    public function UpdatePrecioVentaLote(Product $product, $precio)
    {
        $item = $this->col->where('product_id', $product->id);
        $st = $item->first()['stockactual'];
        $data_lote = Lote::where('product_id', $product->id)->where('status', 'Activo');
        $costo = $item->first()['costo'];
        $recuento = $item->first()['recuento'];



        $this->col->pull($item->keys()->first());
        $this->col->push([
            'product_id' => $product->id,
            'product_name' => $product->nombre,
            'product_codigo' => $product->codigo,
            'stockactual' =>  $st,
            'recuento' => $recuento,
            'costo' => $costo,
            'pv_lote' => $precio


        ]);
    }


    public function UpdateR(Product $product, $cant)
    {
        $item = $this->col->where('product_id', $product->id);
        $st = $item->first()['stockactual'];

        $this->col->pull($item->keys()->first());
        $this->col->push([
            'product_id' => $product->id,
            'product_name' => $product->nombre,
            'product_codigo' => $product->codigo,
            'stockactual' =>  $st,
            'recuento' => $cant,

        ]);
    }

    protected $listeners = ['clear-Product' => 'removeItem', 'confirmarvaciar' => 'vaciarlistaop'];

    public function removeItem(Product $product)
    {

        $item = $this->col->where('product_id', $product->id);
        $this->col->pull($item->keys()->first());
    }

    public function vaciarlistaop()
    {
        $this->col = collect();
        $this->arr = null;
        $this->searchproduct = null;
        $this->destino = null;
    }
    public function anterior()
    {

        if ($this->col->isNotEmpty()) {
            $this->vaciarlistaop();
        }
        $this->show = 'js-active';
        $this->show1 = '';
        $this->show2 = '';
        $this->active1 = 'js-active';
        $this->active2 = '';
        $this->active3 = '';
        $this->failures = null;
    }


    public function Exit()
    {
        // dd("S");
        $this->resetui();
        $this->resetErrorBag();
        $this->redirect('inicio');
    }






    public function resetes()
    {
        $this->failures = false;
    }

    public function ValidarDatos()
    {
        $rules = [
            'destino' => 'required|not_in:Elegir',
            'observacion' => 'required',
            'concepto' => 'required|not_in:Elegir'
        ];

        $messages = [
            'destino.required' => 'El destino del producto es requerido',
            'concepto.required' => 'El concepto es un dato requerido',
            'destino.not_in' => 'Elija una ubicacion del producto.',
            'concepto.not_in' => 'Elija un concepto diferente.',
            'observacion.required' => 'Agregue una observacion'
        ];

        $this->validate($rules, $messages);



        $this->nextpage = true;
    }
    public function proxima()
    {
        $rules = [

            'observacion' => 'required',
            'concepto' => 'required|not_in:Elegir'
        ];

        $messages = [

            'concepto.required' => 'El concepto es un dato requerido',

            'concepto.not_in' => 'Elija un concepto diferente.',
            'observacion.required' => 'Agregue una observacion',
        ];

        $this->validate($rules, $messages);

        if ($this->concepto == "Varios") {

            $rules2 = [
                'tipo_proceso' => 'required|not_in:Elegir',
            ];

            $message = [
                'tipo_proceso.required' => 'El tipo de proceso es requerido',

            ];

            $this->validate($rules2, $message);
        }

        $this->show = '';
        $this->show1 = 'js-active';
        $this->active1 = 'js-active';
        $this->active2 = 'js-active';
        $this->failures = null;
    }
    public function proxima2()
    {
        $rules = [


            'destino' => 'required|not_in:Elegir'
        ];

        $messages = [
            'destino.required' => 'El destino es requerido',
            'destino.not_in' => 'Elija un destino.',

        ];

        $this->validate($rules, $messages);

        $this->show = '';
        $this->show1 = '';
        $this->show2 = 'js-active';
        $this->active1 = 'js-active';
        $this->active2 = 'js-active';
        $this->active3 = 'js-active';
        $this->failures = null;
    }

    public function GuardarSubir()
    {
        $this->import();
    }

    public function datalote($p_id)
    {
        $data_lote = Lote::where('product_id', $p_id)->get();
        //$ultimo_lote = Lote::latest()->where('product_id', $p_id)->get()->isEmpty() == true ? 0 : Lote::latest()->where('product_id', $p_id)->get();
        if ($data_lote->isNotEmpty()) {
            $ms = $data_lote->where('status', 'Activo')->first();
            if ($ms != null) {

                return  $ms;
            } else {
                return $data_lote->last()->first();
            }
        } else {
            return null;
        }
    }
}
