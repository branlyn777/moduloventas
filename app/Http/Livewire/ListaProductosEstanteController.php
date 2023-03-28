<?php

namespace App\Http\Livewire;

use App\Models\Location;
use App\Models\LocationProducto;
use App\Models\Product;
use App\Models\ProductosDestino;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;


class ListaProductosEstanteController extends Component
{
    use WithPagination;

    public $estante,$search,$pagination,$message,$search2,$arr=[],$col,$data_prod_mob;

    public function mount($id){
        $this->col=collect();
        $this->estante=Location::find($id);
        $this->pagination=30;
        $pr=LocationProducto::where('location',$this->estante->id)->get();
        foreach ($pr as $value) {
           
            array_push($this->arr, $value->product);
        }
      

    }
    
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }



    public function render()
    {
         $listaproductos=Location::join('location_productos','location_productos.id','locations.id')
        ->join('products','products.id','location_productos.product')
        ->where('locations.id',$this->estante->id)
        ->when($this->search != null, function ($query) {
            $query->where('products.nombre', 'like', '%' . $this->search . '%')
            ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
        })
        ->select('products.*',DB::raw('0 as cantidad'), DB::raw('0 as otrosestantes'))
        ->paginate($this->pagination);

        foreach ($listaproductos as $value) {
            $value->otrosestantes=$this->buscarOtrosEstantes($value->id);
            $value->cantidad=$this->destinoCantidad($value->id);
        }

        if (strlen($this->search2) > 0)
        {
           
     
            $this->data_prod_mob = Product::whereNotIn('products.id',$this->arr)
                            ->where('nombre', 'like', '%' . $this->search2 . '%')
                            ->orWhere('codigo','like','%'.$this->search2.'%')
                            ->take(10)
                            ->get();

                           
    
         
        }
      
        return view('livewire.localizacion.verdetalle',['productos'=>$listaproductos,'estante'=>$this->estante])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    protected $listeners = ['quitarProducto' => 'sacarProducto'];


    public function sacarProducto($id_producto){
        
            LocationProducto::where('location_productos.product',$id_producto)->delete();
            $this->message="Producto quitado exitosamente";
            $this->emit('succes_deleted');
    }

    public function buscarOtrosEstantes($id){

        $data=LocationProducto::join('locations','locations.id','location_productos.location')
        ->join('products','location_productos.product','products.id')
        ->where('products.id',$id)
        ->select('locations.codigo as codigo')
        ->get();

        return $data;
    }

    public function destinoCantidad($id){
        $data=ProductosDestino::where('product_id',$id)->where('destino_id',$this->estante->destino_id)->get();
        if ($data->count() != 0) {
          
            $data=$data->first()->stock;
            return $data;
          
        }
        return 0;
    }


    public function resetAsignar(){

        $this->search2=null;
        $this->data_prod_mob=null;
    }

    public function asignaridmob($id){

        $this->resetAsignar();
   
        $loc=LocationProducto::where('location',$this->id_est)->get('product');
        
        foreach ($loc as $data) {
            
            array_push($this->arr, $data->product);

        }
        $this->emit('show-modal');

        

    }

    public function addProd( Product $product){  
   
    
        $this->col->push(['product_id'=> $product->id,'product_name'=>$product->nombre,'product_codigo'=>$product->codigo]);
        array_push($this->arr, $product->id);
        $this->search2=null;
       
    
        }


        public function asignarMobiliario()
        {
            
    
    
             foreach ($this->col as $data) {
               
    
                 LocationProducto::create([
                     'product'=>$data['product_id'],
                     'location'=>$this->location
                 ]);
            }
    
            $this->resetUI();
            $this->emit('localizacion-assigned', 'Mobiliario asignado Exitosamente');
        }

        public function quitarProducto($id){
            $item=0;
            foreach ($this->col as $key => $value) {
       
                if ($value['product_codigo'] == $id) {
                   $item=$key;
                   break;
                    }
                   }
               
                 $this->col->pull($item);
    
    
        }
    
}
