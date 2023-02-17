<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class NivelInventariosController extends Component
{
    use WithPagination;
    public $sub;
    public $selected_categoria,$selected_sub,$pagination;

    


    public function mount(){
        $this->pagination=5000;
    }
    public function render()
    {
        $this->sub = Category::where('categories.categoria_padre', $this->selected_categoria)
        ->get();

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


        return view('livewire.nivelinventarios.nivel-inventarios',[
            'data' => $prod->paginate($this->pagination),
            'categories' => Category::where('categories.categoria_padre', 0)->orderBy('name', 'asc')->get(),

        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
