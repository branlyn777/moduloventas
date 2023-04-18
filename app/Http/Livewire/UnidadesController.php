<?php

namespace App\Http\Livewire;

use App\Models\Marca;
use App\Models\Unidad;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UnidadesController extends Component
{
    use WithPagination;
    use WithFileUploads;



    //UNIDADES



    public  $search, $nombre, $selected_id, $mensaje_toast;
    public  $pageTitle, $componentName;
    private $pagination = 25;


    //MARCAS

    public $search_marca, $nombre_marca, $selected_id_marca;
    private $pagination_marca = 25;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Unidades';
        $this->selected_id = 0;
    }
    public function render()
    {
        //UNIDADES
            if (strlen($this->search) > 0)
                $uni = Unidad::select('unidads.*')
                ->where('nombre', 'like', '%' . $this->search . '%')
                ->paginate($this->pagination);
            else
            $uni = Unidad::select('unidads.*')
            ->paginate($this->pagination);







        //MARCAS
        if (strlen($this->search_marca) > 0)
        {
            $marcas = Marca::select('marcas.*')
            ->where('nombre', 'like', '%' . $this->search_marca . '%')->paginate($this->pagination_marca);
        }
        else
        {
            $marcas = Marca::select('marcas.*')->paginate($this->pagination_marca);
        }





            return view('livewire.unidad.component', [
                'data_unidad' => $uni,
                'marcas' => $marcas
            ])
                ->extends('layouts.theme.app')
                ->section('content');
        
    }
    public function Store()
    {
        $rules = [
            'nombre' => 'required|unique:unidads',
            
        ];
        $messages = [
            'nombre.required' => 'El nombre de la unidad es requerido.',
            'nombre.unique' => 'Ya existe una unidad con ese nombre.',
        ];
        $this->validate($rules, $messages);

        Unidad::create([
            'nombre' => $this->nombre
        ]);

        $this->resetUI();
        $this->mensaje_toast = 'Unidad Registrada';
        $this->emit('unidad-added', 'Unidad Registrada');
    }
    public function Edit(Unidad $unity)
    {
        $this->selected_id = $unity->id;
        $this->nombre = $unity->nombre;
        $this->emit('show-modal', 'show modal!');
    }
    public function Update()
    {
        $rules = [
            'nombre' => 'required'
        ];
        $messages = [
            'nombre.required' => 'El nombre de la unidad es requerido, ingrese la unidad.',
            

        ];
        $this->validate($rules, $messages);
        $uni = Unidad::find($this->selected_id);
        $uni->update([
            'nombre' => $this->nombre,
            
        ]);
        $uni->save();

        $this->resetUI();
        $this->mensaje_toast = 'Unidad Actualizada';
        $this->emit('unidad-updated', 'Unidad Actualizada');
    }
    public function Destroy(Unidad $uni)
    {
        $uni->delete();
        $this->resetUI();
        $this->mensaje_toast = 'Unidad Eliminada';
        $this->emit('unidad-deleted', 'Unidad Eliminada');
    }
    public function resetUI()
    {
        $this->nombre = '';
        $this->selected_id=0;
       
    }




    protected $listeners = [
        'deleteRow' => 'Destroy',
        'deleteRowMarca' => 'Destroy_marca'
    ];




    //MARCAS
    public function Store_marca()
    {
        $rules = [
            'nombre_marca' => 'required',
            
        ];
        $messages = [
            'nombre_marca.required' => 'El nombre de la unidad es requerido.',
        ];
        $this->validate($rules, $messages);
        
        Marca::create([
            'nombre' => $this->nombre_marca
        ]);

        $this->resetUI_marca();
        $this->mensaje_toast = 'Marca Registrada';
        $this->emit('marca-added', 'Marca Registrada');
    }
    public function Edit_marca(Marca $unity)
    {
        $this->selected_id_marca = $unity->id;
        $this->nombre_marca = $unity->nombre;
        
       

        $this->emit('show-modal_marca', 'show modal!');
    }
    public function Update_marca()
    {
        $rules = [
            'nombre_marca' => 'required'
        ];
        $messages = [
            'nombre_marca.required' => 'El nombre de la marca es requerido',
            

        ];
        $this->validate($rules, $messages);
        $uni = Marca::find($this->selected_id_marca);
        $uni->update([
            'nombre' => $this->nombre_marca,
        ]);
        $uni->save();

        $this->resetUI_marca();
        $this->mensaje_toast = 'Marca Actualizada';
        $this->emit('marca-updated', 'Marca Actualizada');
    }
    public function resetUI_marca()
    {
        $this->nombre_marca = '';
        $this->selected_id_marca=0;
       
    }
    public function Destroy_marca(Marca $uni)
    {
        $uni->delete();
        $this->resetUI();
        $this->mensaje_toast = 'Marca Eliminada';
        $this->emit('marca-deleted', 'Marca Eliminada');
    }
}
