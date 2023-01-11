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

    public $name, $descripcion, $search, $categoryid, $selected_id, $pageTitle, $componentName, $categoria_padre, $data2, $estados, $mensaje_toast;
    private $pagination = 20;
    public $category_s = 0;
    public $subcat_s = false;


    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Categoria';
        $this->componentSub = 'Subcategorias';
        $this->subcat_fill = 'Elegir';
        $this->estados = 'TODOS';
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
                    ->when($this->estados != 'TODOS', function ($query) {
                        return $query->where('status', $this->estados);
                    });
            })->paginate($this->pagination);

        // if (strlen($this->search) > 0)
        //     $data = Category::where('name', 'like', '%' . $this->search . '%')
        //     ->where('categoria_padre',$this->category_s)->where('name','!=','No definido')
        //     ->paginate($this->pagination);
        // else
        //     $data = Category::where('categoria_padre',$this->category_s)->where('name','!=','No definido')
        //     ->orderBy('id', 'asc')
        //     ->paginate($this->pagination);

        $this->data2 = Category::where('categoria_padre', $this->selected_id)
            ->select('categories.*')->get();

        return view('livewire.category.categories', ['categories' => $data, 'subcat' => $this->data2])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function Edit($id)
    {
        $this->emit('hide_modal_sub');
        $record = Category::find($id, ['id', 'name', 'descripcion', 'status']);

        $this->selected_id = $record->id;
        $this->name = $record->name;
        $this->descripcion = $record->descripcion;
        $this->estado = $record->status;
        $this->emit('show-modal');
    }
    public function Ver(Category $category)
    {
        $this->selected_id = $category->id;
        //dd($this->data2);
        $this->emit('modal_sub', 'show modal!');
    }

    public function asignarCategoria($cat)
    {

        $this->selected_id = 0;
        $this->categoria_padre = $cat;
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
        $this->selected_id = 0;

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
        $this->resetUI();
        $this->selected_id = 0;
        $this->mensaje_toast = 'Subcategoria Registrada';
        $this->emit('sub_added');
        $this->emit('modal_sub', 'show modal!');
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
            'status' => $this->estado
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
        if ($imageName != null) {
            unlink('storage/categorias/' . $imageName);
        }
        $this->resetUI();
        $this->mensaje_toast = 'Categoria Eliminada';
        $this->emit('item-deleted', 'Categoria eliminada');
    }

    public function resetUI()
    {
        $this->reset('name', 'descripcion', 'categoria_padre');
        $this->selected_id = 0;

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
}
