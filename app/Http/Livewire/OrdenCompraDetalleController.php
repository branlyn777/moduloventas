<?php

namespace App\Http\Livewire;

use App\Models\Destino;
use App\Models\DetalleOrdenCompra;
use App\Models\Lote;
use App\Models\OrdenCompra;
use App\Models\Product;
use App\Models\Provider;
use App\Models\SaleDetail;
use App\Models\Sucursal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrdenCompraDetalleController extends Component
{

public $fecha,$search,$provider,$vs=[],$order=1,$itemsQuantity,$prod,$destino,$observacion,$tipo,$dias,$fromDate,$toDate,$ult_dias,$calculado,$mensaje_toast;
    public $exp,$prod_exp;
    public function updatingTipo(){
        $this->ult_dias=null;
        $this->dias=null;
    }
    public function mount()
    {
     
        $this->verPermisos();
        $this->cart = collect([]);
        $this->calculado=0;
  
    }
    public function render()
    {
        if (strlen($this->search) > 0)
        $this->prod = Product::select('products.*')
        ->where('nombre', 'like', '%' . $this->search . '%')
        ->where('status','ACTIVO')
        ->orWhere('codigo','like','%'.$this->search.'%')
        ->orWhere('marca','like','%'.$this->search.'%')
        ->orWhere('id','like','%'.$this->search.'%')
        ->take(5)
        ->get();
    
        $data_provider= Provider::where('status','ACTIVO')->select('providers.*')->get();
        $data_destino= Sucursal::join('destinos as dest','sucursals.id','dest.sucursal_id')
        ->whereIn('dest.id',$this->vs)
        ->select('dest.*','dest.id as destino_id','sucursals.*')
        ->get();
        if ($this->ult_dias != null and $this->dias != null) {
            
            //dd($this->prod_exp);
            $this->exp= SaleDetail::where('product_id',$this->prod_exp)
            ->when($this->tipo == 'xdias',function($query){
                return $query->whereBetween('created_at', [ Carbon::now()->subDays($this->ult_dias),
            Carbon::now()
                ]);
            })->sum('quantity');
            $unidxdia=$this->exp/$this->ult_dias;

            $this->calculado=round($unidxdia*$this->dias);
        
        
        }
        if ($this->fromDate != null and $this->toDate!=null) {
            $this->exp= SaleDetail::where('product_id',$this->prod_exp)
            ->when($this->tipo == 'rango_fechas',function($query){
                return $query->whereBetween('created_at', [ Carbon::parse($this->fromDate)->format('Y-m-d'),
           Carbon::parse($this->toDate)->format('Y-m-d')  . ' 23:59:59'
                ]);
            })->sum('quantity');
            $from=Carbon::parse($this->fromDate);
            $to=Carbon::parse($this->toDate);

       
            $unidxdia=$this->exp/$from->diffInDays($to);

            $this->calculado=round($unidxdia*$this->dias);
        }

        return view('livewire.ordencompra.orden-compra-detalle',[
            'data_prov'=>$data_provider,
            'data_suc'=>$data_destino,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    public function verPermisos(){
       
        $ss= Destino::select('destinos.id','destinos.nombre')->get();
        $arr=[];
        foreach ($ss as $item){
            $arr[$item->nombre.'_'.$item->id]=($item->id);
            
        }

       foreach ($arr as $key => $value) {
        if (Auth::user()->hasPermissionTo($key)) {
            array_push($this->vs,$value);
        }
       }

    }


    public function InsertarProducto(Product $prod)
    {
        $champ=$this->cart->where('product_id', $prod->id);
        //dd($champ);
        if (!$champ->isEmpty()) {
            
            $exist= $this->cart->where('product_id', $prod->id)->first()['quantity'];
            $result = $this->cart->where('product_id', $prod->id);
            $this->cart->pull($result->keys()->first());
            $this->cart->push([
               
                'product_id' => $prod->id,
                'product_name' => $prod->nombre,
                'quantity' => $exist!=null?$exist+1:1,
                'price'=>Lote::where('product_id',$prod->id)->latest('created_at')->value('costo'),
                'order'=>$this->order
               
            ]);
            $this->order++;
            $this->total= $this->cart->sum(function($value){
                return $value['quantity']*$value['price'];
            });
            $this->itemsQuantity=$this->cart->sum('quantity');
        }
        else{
            $this->cart->push([
               
                'product_id' => $prod->id,
                'product_name' => $prod->nombre,
                'quantity' => 1,
                'price'=>Lote::where('product_id',$prod->id)->latest('created_at')->value('costo'),
                'order'=>$this->order
               
            ]);
            $this->order++;
            $this->total= $this->cart->sum(function($value){
                return $value['quantity']*$value['price'];
            });
            $this->itemsQuantity=$this->cart->sum('quantity');
        }
   
    }

    public function quitarProducto(Product $prod)
    {
        //Buscamos el elemento en la colección
        $result = $this->cart->where('product_id', $prod->id);
        //Eliminando la fila del elemento en coleccion
        $this->cart->pull($result->keys()->first());
        $this->total= $this->cart->sum(function($value){
            return $value['quantity']*$value['price'];
        });
        $this->total= $this->cart->sum(function($value){
            return $value['quantity']*$value['price'];
        });
        $this->itemsQuantity=$this->cart->sum('quantity');
    }

    public function actualizarCantidad(Product $prod,$cant){
        $order = $this->cart->where('product_id', $prod->id)->first()['order'];
        $precio=$this->cart->where('product_id', $prod->id)->first()['price'];
        $result = $this->cart->where('product_id', $prod->id);
        $this->cart->pull($result->keys()->first());

        $this->cart->push([
            'product_id'=>$prod->id,
            'product_name'=>$prod->nombre,
            'quantity'=>$cant,
            'price'=>$precio,
            'order'=>$order
        ]);
        $this->total= $this->cart->sum(function($value){
            return $value['quantity']*$value['price'];
        });
        $this->itemsQuantity=$this->cart->sum('quantity');
    }

    public function actualizarPrecio(Product $prod,$precio){
        $order = $this->cart->where('product_id', $prod->id)->first()['order'];
        $cant=$this->cart->where('product_id', $prod->id)->first()['quantity'];
        $result = $this->cart->where('product_id', $prod->id);
        $this->cart->pull($result->keys()->first());

        $this->cart->push([
            'product_id'=>$prod->id,
            'product_name'=>$prod->nombre,
            'quantity'=>$cant,
            'price'=>$precio,
            'order'=>$order
        ]);

        $this->total= $this->cart->sum(function($value){
            return $value['quantity']*$value['price'];
        });
        $this->itemsQuantity=$this->cart->sum('quantity');


       
    }

    public function calcularStock(Product $id){

      $this->prod_exp=$id->id;
        $this->emit('show-modal');

    }

    public function aplicarPronostico(Product $prod){
      
       
        $this->actualizarCantidad($prod,$this->calculado);
        $this->mensaje_toast="Cantidad aplicada con exito.";
        $this->emit('cantidad_ok');
        $this->resetCalculo();
    }

    public function resetCalculo(){
        $this->calculado=null;
        $this->dias=null;
        $this->ult_dias=null;
        $this->tipo=null;
    }

    public function resetOrdenCompra(){
        $this->total=null;
        $this->observacion=null;
        $this->provider=null;
        $this->destino=null;
    }

    public function guardarOrdenCompra(){
        //dd('finalizar orden de compra');
       $orcompra= OrdenCompra::create([
            'importe_total'=>$this->total,
            'observacion'=>$this->observacion,
            'proveedor_id'=>Provider::where('nombre_prov',$this->provider)->first()->id,
            'status'=>'Activo',
            'destino_id'=>$this->destino,
            'user_id'=>Auth()->user()->id,
            'estado_entrega'=>'NORECIBIDO'
        ]);
        
        foreach ($this->cart as $data) {
            DetalleOrdenCompra::create([
                'orden_compra'=>$orcompra->id,
                'product_id'=>$data['product_id'],
                'precio'=>$data['price'],
                'cantidad'=>$data['quantity']
            ]);
        }
        $this->resetOrdenCompra();
        redirect('/orden_compras');
    }

    public function resetUI()
    {
        //dd('vaciar orden de compra');
        $this->provider = 'Elegir Proveedor';
        $this->destino = 'Elegir Destino';
        $this->resetOrdenCompra();
        
        
    }

    public function exit()
    {
        //dd('ir a orden de compras');
        redirect('/orden_compras');
    }

}
