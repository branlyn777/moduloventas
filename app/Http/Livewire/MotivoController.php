<?php

namespace App\Http\Livewire;

use App\Models\Motivo;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MotivoController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public  $search, $nombre,$tipo, $selected_id;
    public  $pageTitle, $componentName;
    private $pagination = 5;
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Motivos';
        $this->tipo = 'Elegir';
        $this->selected_id = 0;
    }
    public function render()
    {
        if (strlen($this->search) > 0)
            $motivo = Motivo::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        else
            $motivo = Motivo::orderBy('id', 'desc')->paginate($this->pagination);
        return view('livewire.motivo.component', [
            'data' => $motivo,
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    
    public function Agregar()
    {
        $this->resetUI();
        $this->emit('show-modal', 'show modal!');
    }
    
    public function Store()
    {
        $rules = [
            'nombre' => 'required|unique:motivos',
            'tipo' => 'required|not_in:Elegir'
        ];
        $messages = [
            'nombre.required' => 'Nombre del motivo requerido.',
            'nombre.unique'=> 'El nombre del motivo debe ser único.',
            'tipo.required'=> 'El tipo es requerido.',
            'tipo.not_in'=> 'El tipo debe ser distinto de Elegir.'
        ];
        $this->validate($rules, $messages);
        
        Motivo::create([
            'nombre' => $this->nombre,
            'tipo' => $this->tipo            
        ]);
        
        $this->resetUI();
        $this->emit('item-added', 'Motivo Registrado');
    }
    public function Edit(Motivo $Motiv)
    {
        $this->selected_id = $Motiv->id;
        $this->nombre = $Motiv->nombre;
        $this->tipo = $Motiv->tipo;

        $this->emit('show-modal', 'show modal!');
    }
    public function Update()
    {
        $rules = [
            'nombre' => "required|unique:motivos,nombre,{$this->selected_id}",
            'tipo' => 'required|not_in:Elegir'
        ];
        $messages = [
            'nombre.required' => 'Nombre del motivo requerido.',
            'nombre.unique'=> 'El nombre del motivo debe ser único.',
            'tipo.required'=> 'El tipo es requerido.',
            'tipo.not_in'=> 'El tipo debe ser distinto de Elegir.'           
        ];
        $this->validate($rules, $messages);
        $mot = Motivo::find($this->selected_id);
        $mot->update([
            'nombre' => $this->nombre,
            'tipo' => $this->tipo  
        ]);
        $mot->save();

        $this->resetUI();
        $this->emit('item-updated', 'Motivo Actualizado');
    }
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Motivo $motivo)
    {
        $motivo->delete();
        $this->resetUI();
        $this->emit('item-deleted', 'Motivo Eliminado');
    }
    
    public function resetUI()
    {
        $this->nombre = '';
        $this->search = '';
        $this->tipo = 'Elegir';
        $this->selected_id = 0;
        $this->resetValidation();
    }
}
