<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Compra as ModelsCompra;
use App\Models\Destino;
use App\Models\DetalleTransferencia;
use App\Models\Estado_Transferencia;
use App\Models\EstadoTrans_Detalle;
use App\Models\EstadoTransDetalle;
use App\Models\EstadoTransferencia;
use App\Models\Location;
use App\Models\Lote;
use App\Models\Product;
use App\Models\ProductosDestino;
use App\Models\Sucursal;
use App\Models\Transference;
use App\Models\transferencia_detalle;
use App\Models\TransferenciaLotes;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


use Darryldecode\Cart\Facades\TransferenciasFacade as Transferencia;
use Exception;
use Illuminate\Support\Facades\Auth;

class TransferirProductoController extends Component
{
    
    use WithPagination;

    public $selected_id,$search,$cantidad,
    $itemsQuantity,$selected_3,$selected_origen=0,$selected_destino,$observacion,$tipo_tr,$estado,$vs=[];
 
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    
    public function mount()
    {
     $this->verPermisos();
    }
    public function render()
    {
   
        $this->itemsQuantity = Transferencia::getTotalQuantity();
        if($this->selected_origen !== 0 && strlen($this->search) > 0){
                                        $almacen= ProductosDestino::join('products as prod','prod.id','productos_destinos.product_id')
                                        ->join('destinos as dest','dest.id','productos_destinos.destino_id')
                                        ->where('dest.id',$this->selected_origen)
                                        ->where('productos_destinos.stock','>',0)
                                        ->where(function($query){
                                            $query->where('prod.nombre', 'like', '%' . $this->search .'%')
                                            ->orWhere('prod.codigo','like','%'.$this->search.'%')
                                            ->orWhere('prod.marca','like','%'.$this->search.'%')
                                            ->orWhere('prod.id','like','%'.$this->search.'%');
                                        })
                                        ->select('prod.nombre as name','prod.codigo','dest.nombre as nombre_destino','dest.id as dest_id','prod.id as prod_id','productos_destinos.stock as stock')
                                        ->orderBy('prod.nombre','desc')
                                        ->take(6)
                                        ->get();
                                        }
                                        else{
                                         $almacen=null;
                                        }
                                        $sucursal_ubicacion=Destino::join('sucursals as suc','suc.id','destinos.sucursal_id')
                                        ->select ('suc.name as sucursal','destinos.nombre as destino','destinos.id as destino_id')
                                        ->whereIn('destinos.id',$this->vs)
                                        ->orderBy('suc.name','asc');
                                        $sucursal_ubicacion2=Destino::join('sucursals as suc','suc.id','destinos.sucursal_id')
                                        ->where('destinos.id','!=',$this->selected_origen)
                                        ->select ('suc.name as sucursal','destinos.nombre as destino','destinos.id as destino_id')
                                        ->orderBy('suc.name','asc');

                                    

        return view('livewire.transferencia.creartransferencia',['destinos_almacen'=>$almacen,'data_origen' =>  $sucursal_ubicacion->get(),
        'data_destino' =>  $sucursal_ubicacion2->get(),
        'cart' => Transferencia::getContent(),'data_cat'=>Category::select('categories.name')->where('categories.categoria_padre','0')->get()
        ])  
        ->extends('layouts.theme.app')
        ->section('content');
    }
    public function verPermisos(){
           
        $ss= Destino::pluck('codigo_almacen','id');
     
        foreach ($ss as $key=>$value) {
            if ($value!=null) {
          
                if (Auth::user()->hasPermissionTo($value)) {
                    
                    array_push($this->vs,$key);
                }
            }
            }
        
    }
    public function increaseQty(Product $productId)

    {

     
        $exist = Transferencia::get($productId->id);

        $stock=ProductosDestino::where('productos_destinos.product_id',$productId->id)
        ->where('productos_destinos.destino_id',$this->selected_origen)->select('productos_destinos.stock')->value('productos_destinos.stock');

      if ($exist) {
        if ($stock>=(1+$exist->quantity))
        {
            Transferencia::add($productId->id, $productId->nombre,0, 1);
        }
        else{
           
            $this->emit('no-stock','Sin stock disponible');
        }
      }
      else{
   
        Transferencia::add($productId->id, $productId->nombre,0, 1);
      }


    }
    public function UpdateQty(Product $productId, $cant =1)
    {
        
  
        
        $stock=ProductosDestino::where('productos_destinos.product_id',$productId->id)
        ->where('productos_destinos.destino_id',$this->selected_origen)->select('productos_destinos.stock')->value('productos_destinos.stock');
        
        if ($cant > 0 && $stock>=$cant) 
        {
            $this->removeItem($productId);
            Transferencia::add($productId->id, $productId->nombre,0, $cant);
            $this->itemsQuantity = Transferencia::getTotalQuantity();
           
        }
        else{
            $this->emit('no-stock','Sin stock disponible');
            $exist = Transferencia::get($productId->id);
            $this->cantidad=$exist->quantity;

        }
       // dd($this->selected_origen);
    }
    public function removeItem(Product $productId)
    {
        Transferencia::remove($productId->id);
        $this->itemsQuantity = Transferencia::getTotalQuantity();
        //$this->tipo_tr ='Elegir operacion';
  
    }

    public function resetUI()
    {
        Transferencia::clear();
        $this->selected_destino = null;
        $this->selected_origen = null;

    }

    public function exit(){
        $this->resetUI();
        redirect('/all_transferencias');
    }
   
    public function verificarDestino(){
    if ($this->selected_destino == $this->selected_origen) {
        
        $this->emit('empty', 'El destino de la transferencia debe ser diferente al origen');
        return false;
    }
    if($this->selected_destino == null){
        $this->emit('empty', 'No ha seleccionado el destino para la transferencia.');
        return false;

    }
    if (Transferencia::getTotalQuantity() == 0) {
        $this->emit('empty_cart_tr', 'No tiene productos para realizar la transferencia');
        return false;
    }

    return true;
}




  /* public function asignarEstado(){

       if ($this->tipo_tr === "tr_dir") {
           $this->estado = 4;
       }
       else{
           $this->estado=1;
       }

   }*/

    public function finalizar_tr()
    {
        //$this->verificarDestino();
        //$this->asignarEstado();
       

       if ($this->verificarDestino()) {
        DB::beginTransaction();

        try {

            $Transferencia_encabezado = Transference::create([
                'observacion'=>$this->observacion,
                'estado'=>1,//***tiene que depender de modificar la transferencia, esta pendiente
                'id_origen'=>$this->selected_origen,
                'id_destino'=>$this->selected_destino
            ]);

            if ($Transferencia_encabezado)
            {
                $items = Transferencia::getContent();
                foreach ($items as $item)
                {
                   $ss=DetalleTransferencia::create([
                        'product_id' => $item->id,
                        'cantidad' => $item->quantity,
                        'estado'=>1//***tiene que depender de modificar la transferencia, esta pendiente
                    ]);
                    $cc[]=$ss->id;

                    $q=ProductosDestino::where('product_id',$item->id)
                    ->where('destino_id',$this->selected_origen)->value('stock');
                    
                  
                    ProductosDestino::where('product_id',$item->id)
                    ->where('destino_id',$this->selected_origen)
                    ->update(['stock'=>($q-$item->quantity)]);
         

                    // $qq=$item->quantity;
                    // $lot=Lote::where('product_id',$item->id)->where('status','Activo')->get();
                    // foreach ($lot as $val) { 
                    //   $lotecantidad = $val->existencia;
                    //    if($qq>0){
                      
                    //        if ($qq > $lotecantidad) {
                          
                    //         TransferenciaLotes::create([
                    //             'detalle_trans_id'=>$ss->id,
                    //             'lote_id'=>$val->id,
                    //             'cantidad'=>$lotecantidad
                    //         ]);
                    //        }
                    //        else{
                    //         TransferenciaLotes::create([
                    //             'detalle_trans_id'=>$ss->id,
                    //             'lote_id'=>$val->id,
                    //             'cantidad'=>$qq
                    //         ]);
                    //            $qq=0;
                    //        }
                    //    }
                    // }

                }
                   $mm= EstadoTransferencia::create([
                        'estado'=>4,
                        'op'=>1,
                        'id_transferencia'=>$Transferencia_encabezado->id,
                        'id_usuario'=>Auth()->user()->id
                    ]);

                    foreach ($cc as $item) {
                        EstadoTransDetalle::create([
                            'estado_id'=>$mm->id,
                            'detalle_id'=>$item
                        ]);
                    }    
       
            DB::commit();
            $this->resetUI();
           
            $this->itemsQuantity = Transferencia::getTotalQuantity();
            redirect('/all_transferencias');
        
        }
     } 
     catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
       
       
    }

}
}