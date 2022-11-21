<?php

namespace App\Http\Livewire;

use App\Models\Destino;
use App\Models\Lote;
use App\Models\Product;
use App\Models\Provider;
use App\Models\SaleDetail;
use App\Models\Sucursal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrdenCompraDetalleController extends Component
{
    public $fecha,$search,$provider,$vs=[],$order=1,$itemsQuantity,$prod,$destino,$observacion,$tipo,$dias,$fromDate,$toDate,$ult_dias,$calculado;
    public $exp,$prod_exp;
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
if ($this->ult_dias != null) {
    
    //dd($this->prod_exp);
    $this->exp= SaleDetail::where('product_id',$this->prod_exp)
    ->when($this->tipo == 'xdias',function($query){

        return $query->whereBetween('created_at', [Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00',
         Carbon::parse(Carbon::now()->subDays($this->ult_dias))->format('Y-m-d') . ' 23:59:59']);
     })->sum('quantity');
     dd($this->exp);
}

        return view('livewire.compras.orden-compra-detalle',[
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




}
