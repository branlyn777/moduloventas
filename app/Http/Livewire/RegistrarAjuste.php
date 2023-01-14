<?php

namespace App\Http\Livewire;

use App\Imports\StockImport;
use App\Models\Destino;
use App\Models\DetalleEntradaProductos;
use App\Models\DetalleSalidaProductos;
use App\Models\IngresoProductos;
use App\Models\Lote;
use App\Models\Product;
use App\Models\ProductosDestino;
use App\Models\SalidaLote;
use App\Models\SalidaProductos;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class RegistrarAjuste extends Component
{
    public  $fecha, $buscarproducto = 0, $selected, $registro, $tipo_de_operacion, $qq, $lotecantidad,
        $archivo, $searchproduct, $mensaje_toast, $costo, $sm, $concepto, $destino, $detalle, $tipo_proceso, $col, $destinosucursal, $observacion, $cantidad, $result, $arr, $id_operacion, $destino_delete, $nextpage, $fromDate, $toDate;
    private $pagination = 15;

    public function mount()
    {
        $this->col = collect([]);
        $this->tipo_proceso = "Elegir";
        $this->registro = 'Manual';
        $this->destino = 'Elegir';
        $this->concepto = "Elegir";
    }



    public function render()
    {
        if (strlen($this->searchproduct) > 0) {

            $st = Product::select('products.*')
                ->where('products.nombre', 'like', '%' . $this->searchproduct . '%')
                ->orWhere('products.codigo', 'like', '%' . $this->searchproduct . '%')
                ->get()->take(3);

            $arr = $this->col->pluck('product-name');
            $this->sm = $st->whereNotIn('nombre', $arr);

            $this->sm = $st->whereNotIn('codigo', $arr);


            //dd($this->sm);

            $this->buscarproducto = 1;
        }

        $destinosuc = Destino::join('sucursals as suc', 'suc.id', 'destinos.sucursal_id')
            ->select('suc.name as sucursal', 'destinos.nombre as destino', 'destinos.id as destino_id')
            ->get();
        return view('livewire.entradas_salidas.registrarajuste', ['destinosp' => $destinosuc])
            ->extends('layouts.theme.app')
            ->section('content');
    }


    public function addProduct(Product $id)
    {
        if ($this->tipo_proceso == 'Salida') {
            $this->col->push(['product_id' => $id->id, 'product-name' => $id->nombre, 'costo' => $this->costo, 'cantidad' => $this->cantidad]);

            $pd = ProductosDestino::where('product_id', $id->id)->where('destino_id', $this->destino)->select('stock')->value('stock');

            if ($pd > 0 and $this->cantidad < $pd) {

                $rules = [
                    'result' => 'required',
                    'cantidad' => 'required'
                ];

                $messages = [   

                    'result.required' => 'El producto es requerido',
                    'cantidad.required' => 'La cantidad es requerida'
                ];

                $this->validate($rules, $messages);

                $this->col->push(['product_id' => $id->id, 'product-name' => $id->nombre, 'cantidad' => $this->cantidad]);

                $this->result = null;
                $this->cantidad = null;
                $this->costo = null;
            } else {
                $this->emit('stock-insuficiente');
            }
        }
        else{
            $this->col->push(['product_id' => $id->id, 'product-name' => $id->nombre, 'costo' => $this->costo, 'cantidad' => $this->cantidad]);
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


    
    public function GuardarOperacion(){
        //dd($this->col);
        if ($this->concepto === "INICIAL" && $this->registro === "Documento") {
         
            try {
                //$import->import('import-users.xlsx');
                Excel::import(new StockImport($this->destino,$this->concepto,$this->observacion),$this->archivo);
                return redirect()->route('operacionesinv');
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {

                 $this->failures = $e->failures();
                 dd($this->failures);
               
            }
        }
      
        
        if ($this->tipo_proceso == 'Entrada' and $this->col->isNotEmpty()) {
                DB::beginTransaction();
                try {
                
                $rs=IngresoProductos::create([
                    'destino'=>$this->destino,
                    'user_id'=>Auth()->user()->id,
                    'concepto'=>$this->concepto,
                    'observacion'=>$this->observacion
                   ]);
                foreach ($this->col as $datas) {
                   
    
                                   $lot= Lote::create([
                                    'existencia'=>$datas['cantidad'],
                                    'costo'=>$datas['costo'],
                                    'status'=>'Activo',
                                    'product_id'=>$datas['product_id']
                                ]);
                
                                   DetalleEntradaProductos::create([
                                        'product_id'=>$datas['product_id'],
                                        'cantidad'=>$datas['cantidad'],
                                        'costo'=>$datas['costo'],
                                        'id_entrada'=>$rs->id,
                                        'lote_id'=>$lot->id
                                   ]);
    
                                   $q=ProductosDestino::where('product_id',$datas['product_id'])
                        ->where('destino_id',$this->destino)->value('stock');
    
                        ProductosDestino::updateOrCreate(['product_id' => $datas['product_id'], 'destino_id'=>$this->destino],['stock'=>$q+$datas['cantidad']]); 
                    
                
                }

                DB::commit();
            }
             catch (Exception $e)
            {
            DB::rollback();
            dd($e->getMessage());

            }
                
            $this->mensaje_toast="Operacion Registrada";
            $this->emit('operacion-added');
            $this->resetui();
            }
            elseif($this->col->isNotEmpty()){
                
                try {
    
                    $operacion= SalidaProductos::create([
        
                        'destino'=>$this->destino,
                        'user_id'=> Auth()->user()->id,
                        'concepto'=>$this->concepto,
                        'observacion'=>$this->observacion]);
                        // dd($auxi2->pluck('stock')[0]);

                foreach ($this->col as $datas) {

                    $auxi=DetalleSalidaProductos::create([
                    'product_id'=>$datas['product_id'],
                    'cantidad'=> $datas['cantidad'],
                    'id_salida'=>$operacion->id
                ]);


                $lot=Lote::where('product_id',$datas['product_id'])->where('status','Activo')->get();

                //obtener la cantidad del detalle de la venta 
                $this->qq=$datas['cantidad'];//q=8
                foreach ($lot as $val) { //lote1= 3 Lote2=3 Lote3=3
                  $this->lotecantidad = $val->existencia;
                  //dd($this->lotecantidad);
                   if($this->qq>0){
                    //true//5//2
                       //dd($val);
                       if ($this->qq > $this->lotecantidad) {
                           $ss=SalidaLote::create([
                               'salida_detalle_id'=>$auxi->id,
                               'lote_id'=>$val->id,
                               'cantidad'=>$val->existencia
                               
                           ]);
                           $val->update([
                               
                               'existencia'=>0,
                               'status'=>'Inactivo'
                               
                            ]);
                            $val->save();
                            $this->qq=$this->qq-$this->lotecantidad;
                            //dump("dam",$this->qq);
                       }
                       else{
                        //dd($this->lotecantidad);
                        $ss=SalidaLote::create([
                           'salida_detalle_id'=>$auxi->id,
                           'lote_id'=>$val->id,
                           'cantidad'=>$this->qq
                           
                       ]);
                         
       
                           $val->update([ 
                               'existencia'=>$this->lotecantidad-$this->qq
                           ]);
                           $val->save();
                           $this->qq=0;
                           //dd("yumi",$this->qq);
                       }
                   }
       
       
            
                     }

                     
                     $q=ProductosDestino::where('product_id',$datas['product_id'])
                     ->where('destino_id',$this->destino)->value('stock');
 
                     ProductosDestino::updateOrCreate(['product_id' => $datas['product_id'], 'destino_id'=>$this->destino],['stock'=>$q-$datas['cantidad']]); 
                }
  
                    DB::commit();
         }
                 catch (Exception $e)
                {
                DB::rollback();
                dd($e->getMessage());
                }
                
                            $this->mensaje_toast="Operacion Registrada";
                            $this->emit('operacion-added');
                            $this->resetui();
            }
            else{

                $this->emit('sinproductos');
            }
            
  
               

}

public function resetui(){
    $this->tipo_proceso=null;
    $this->archivo=null;
    $this->concepto= 'Elegir';
    $this->registro= "Manual";
    $this->destino= 'Elegir';
    $this->nextpage=false;
    $this->reset([
    'costo'
    ,'destinosucursal'
    ,'observacion'
    ,'cantidad']);


    foreach ($this->col as $key => $value)
    {
        $this->col->pull($key);
    }

}

public function Exit(){
   // dd("S");
    $this->resetui();
    $this->resetErrorBag();
    $this->redirect('inicio');
}
}
