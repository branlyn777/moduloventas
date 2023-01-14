<?php

namespace App\Http\Livewire;

use App\Imports\CategoryImport;
use App\Imports\SubCategoryImport;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CategoriesController extends Component
{

    use WithFileUploads;
    use WithPagination;

    public $name, $descripcion, $search, $categoryid, $selected_id, $pageTitle, $componentName, $categoria_padre, $data2, $estadocategoria,$estados,$subcat, $mensaje_toast;
    private $pagination = 20;
    public $category_s = 0;
    public $subcat_s = false;


    public function mount()
    {
        $this->componentName = 'Categoria';
        $this->estados = 'ACTIVO';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        $data = Category::select('categories.*')
            ->where(function ($querys) {
                $querys->where('name', 'like', '%' . $this->search . '%')->where('categoria_padre', 0)
                    ->where('name', '!=', 'No definido')
                   ->where('status', $this->estados==true?'ACTIVO':'INACTIVO');
                  
            })->paginate($this->pagination);



        return view('livewire.category.categories', ['categories' => $data])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function Edit($id)
    {
        // $this->emit('hide_modal_sub');

        $record = Category::find($id, ['id', 'name', 'descripcion', 'status']);
        //dd($record);
        $this->selected_id = $record->id;

        $this->name = $record->name;
        $this->descripcion = $record->descripcion;
        $this->estadocategoria = $record->status;
        $this->emit('show-modal');
    }

    public function EditSubcategoria($id)
    {
        // $this->emit('hide_modal_sub');

        $record = Category::find($id, ['id', 'name', 'descripcion', 'status']);
        //dd($record);
        $this->selected_id = $record->id;

        $this->name = $record->name;
        $this->descripcion = $record->descripcion;
        $this->estadocategoria = $record->status;
        $this->emit('sub-show');
    }
    public function Ver($category)
    {

      $this->categoria_padre=$category;
        $this->subcat = Category::where('categoria_padre', $category)
        ->select('categories.*')->get();

        $this->emit('modal_sub', 'show modal!');
    }

    public function asignarCategoria()
    {

        $this->resetUI();
        $this->emit('hide_modal_sub');
        $this->emit('sub-show');
    }

    public function Store()
    {
        $this->selected_id = 0;
        $rules = [
            'name' => 'required|unique:categories|min:3',
            'name' => 'required|unique:categories|max:255'
            // 'descripcion' => 'required|unique:categories|max:255'
        ];
        $messages = [
            'name.required' => 'El nombre de la categoría es requerido',
            'name.unique' => 'Ya existe el nombre de la categoría',
            'name.min' => 'El nombre de la categoría debe tener al menos 3 caracteres',
            'name.max' => 'El nombre de la categoría no debe pasar los 255 caracteres'
            // 'descripcion.max' =>'La descripción no debe pasar los 255 caracteres' 
        ];
        $this->validate($rules, $messages);
        if ($this->categoria_padre) {
            $category = Category::create([
                'name' =>  strtoupper($this->name),
                'descripcion' => $this->descripcion,
                'categoria_padre' => $this->categoria_padre
            ]);
        } else {

            $category = Category::create([
                'name' =>  strtoupper($this->name),
                'descripcion' => $this->descripcion
            ]);
        }

        $category->save();
        $this->resetUI();
        $this->mensaje_toast = 'Categoría Registrada';
        $this->emit('item-added', 'Categoría Registrada');
    }



    public function Store_Subcategoria()
    {
  

        $rules = [
            'name' => 'required|unique:categories|min:3',
            'name' => 'required|unique:categories|max:255'

        ];
        $messages = [
            'name.required' => 'El nombre de la categoría es requerido',
            'name.unique' => 'Ya existe el nombre de la categoría',
            'name.min' => 'El nombre de la categoría debe tener al menos 3 caracteres',
            'name.max' => 'El nombre de la categoría no debe pasar los 255 caracteres'
        ];
        $this->validate($rules, $messages);

        $category = Category::create([
            'name' => $this->name,
            'descripcion' => $this->descripcion,
            'categoria_padre' => $this->categoria_padre
        ]);

        $category->save();
        
        $this->mensaje_toast = 'Subcategoria Registrada';
        $this->emit('sub_added');
 
        $this->Ver($this->categoria_padre);
        $this->resetUI();
        // $this->emit('modal_sub', 'show modal!');
    }

    public function Update()
    {
        $rules = [
            'name' => "required|min:3|unique:categories,name,{$this->selected_id}",
            'name' => "required|max:255|unique:categories,name,{$this->selected_id}"
            // 'descripcion' => "required|max:255|unique:categories,descripcion,{$this->selected_id}"
        ];
        $messages = [
            'name.required' => 'El nombre de la categoría es requerido',
            'name.unique' => 'Ya existe el nombre de la categoría',
            'name.min' => 'El nombre de la categoría debe tener al menos 3 caracteres',
            'name.max' => 'El nombre de la categoría no debe pasar los 255 caracteres'
            // 'descripcion.max' => 'La descripcion no debe pasar los 255 caracteres'
        ];
        $this->validate($rules, $messages);
        $category = Category::find($this->selected_id);
        $category->update([
            'name' => $this->name,
            'descripcion' => $this->descripcion,
            'status' => $this->estadocategoria
        ]);
        $this->resetUI();
        $this->mensaje_toast = 'Categoria Actualizada';
        $this->emit('item-updated', 'Categoria Actualizada');
    }

    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Category $category)
    {
        $imageName = $category->image;
        $category->delete();
  
        $this->resetUI();
        $this->mensaje_toast = 'Categoria Eliminada';
        if ($this->categoria_padre != null) {
      
            $this->Ver($this->categoria_padre);
        }
        $this->emit('item-deleted');
    }

    public function resetUI()
    {
        $this->reset('name', 'descripcion','selected_id');
        $this->resetValidation();
    }

    public function import(Request $request)
    {

        $file = $request->file('import_file');

        Excel::import(new CategoryImport, $file);


        return redirect()->route('categorias');
    }
    public function importsub(Request $request)
    {

        $file = $request->file('import_file');

        Excel::import(new SubCategoryImport, $file);


        return redirect()->route('categorias');
    }

    public function cambioestado()
    {
        if ($this->estados) {
            $this->estados = false;
        } else {
            $this->estados = true;
        }
    }
}
