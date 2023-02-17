<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sucursal;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class NivelInventariosController extends Component
{
    use WithPagination;
    public $sub;
    public $selected_categoria,$selected_sub,$pagination;
    public $search,$searchData,$sucursal_id;

    


    public function mount(){
        $this->pagination=5000;
        $this->sucursal_id = "Todos";
    }
    public function render()
    {
        
        $sucursales = Sucursal::where("sucursals.estado", "ACTIVO")->get();
   
        $this->sub = Category::where('categories.categoria_padre', $this->selected_categoria)
        ->get();

        if ($this->sucursal_id != 'Todos') {
            
        $prod = Product::join('categories as c', 'products.category_id', 'c.id')
        ->join('productos_destinos','productos_destinos.product_id','products.id')
        ->join('destinos','destinos.id','productos_destinos.destino_id')
        ->join('lotes','lotes.product_id','products.id')
        ->where('products.status','ACTIVO')
        ->where('destinos.sucursal_id',$this->sucursal_id)
        ->where('lotes.existencia','>',0)
        ->select('products.*','productos_destinos.stock as total_existencia', DB::raw('AVG(lotes.costo)*productos_destinos.stock as total_costo'))
        ->when($this->selected_categoria!=null and $this->selected_sub == null ,function($query){
                $query->where('c.id', $this->selected_categoria)
                        ->where('c.categoria_padre',0);
            })
        ->when($this->selected_sub!=null,function($query){
                $query->where('c.id', $this->selected_sub)
                ->where('categoria_padre','!=',0);
            })
        ->groupBy('products.id','productos_destinos.stock')

            
        ->orderBy('products.created_at', 'desc');

        
        } else {
           
        $prod = Product::join('categories as c', 'products.category_id', 'c.id')
        ->join('lotes','lotes.product_id','products.id')
        ->where('products.status','ACTIVO')
        ->where('lotes.existencia','>',0)
        ->select('products.*', DB::raw('SUM(lotes.existencia) as total_existencia'), DB::raw('SUM(lotes.existencia*lotes.costo) as total_costo'))
        ->when($this->selected_categoria!=null and $this->selected_sub == null ,function($query){
                $query->where('c.id', $this->selected_categoria)
                        ->where('c.categoria_padre',0);
            })
        ->when($this->selected_sub!=null,function($query){
                $query->where('c.id', $this->selected_sub)
                ->where('categoria_padre','!=',0);
            })
        ->groupBy('products.id')
            
        ->orderBy('products.created_at', 'desc');

        }
        


        return view('livewire.nivelinventarios.nivel-inventarios',[
            'data' => $prod->paginate($this->pagination),
            'categories' => Category::where('categories.categoria_padre', 0)->orderBy('name', 'asc')->get(),
            'sucursales' => $sucursales

        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    public function resetCategorias()
    {
        $this->selected_sub = null;
        $this->selected_categoria = null;
        $this->search = null;
        $this->searchData = [];
    }
    public function resetSubcategorias()
    {
        $this->selected_sub = null;
    }


}
