<?php

namespace App\Http\Livewire;


use App\Models\Provider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProvidersController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public  $search, $nombre_prov,$apellido,$direccion,$telefono,$correo, $selected_id,$nit,$estado,$estados;
    public  $pageTitle, $componentName;
    private $pagination = 5;
    
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Proveedores';
        $this->selected_id = 0;
        $this->estados='ACTIVO';
    }

    public function render()
    {
        
            if (strlen($this->search) > 0)
                $suplier = Provider::select('providers.*')
                ->where('status',$this->estados)
                ->where(function($querys){
                    $querys->where('nombre_prov', 'like', '%' . $this->search . '%')
                ->orWhere('apellido','like','%'.$this->search.'%')
                ->orWhere('direccion','like','%'.$this->search.'%');
                })->paginate($this->pagination);
            else
            $suplier = Provider::where('status',$this->estados)->select('providers.*')
            ->paginate($this->pagination);

            return view('livewire.i_suplier.component', [
                'data_proveedor' => $suplier
            ])
                ->extends('layouts.theme.app')
                ->section('content');
        
    }
    public function Store()
    {
        $rules = [
            'nombre_prov' => 'required|unique:providers',
        ];
        $messages = [
            'nombre_prov.required'=> 'El nombre del proveedor es requerido.',
            'nombre_prov.unique'=> 'Ya existe un proveedor  con ese nombre.'
        ];
        $this->validate($rules, $messages);

        

        Provider::create([

            'nombre_prov' => $this->nombre_prov,
            'apellido'=>$this->apellido,
            'nit'=>$this->nit,
            'direccion' => $this->direccion,
            'telefono'=>$this->telefono,
            'correo'=>$this->correo
            
        ]);

        $this->resetUI();
        $this->emit('proveedor-added', 'proveedor Registrada');
    }
    public function Edit(Provider $sup)
    {
        $this->selected_id = $sup->id;
        $this->nombre_prov = $sup->nombre_prov;
        $this->apellido = $sup->apellido;
        $this->direccion = $sup->direccion;
        $this->telefono = $sup->telefono;
        $this->correo = $sup->correo;
        $this->estado=$sup->status;
        $this->nit=$sup->nit;

        $this->emit('show-modal', 'show modal!');
    }
    public function Update()
    {
        $rules = [
            'nombre_prov.required' => 'El nombre del proveedor es requerido.',
            'nombre_prov.unique' => 'Ya existe un proveedor  con ese nombre.',
    
        ];
        $messages = [
            'nombre_prov.required' => 'El nombre del proveedor es requerido.',
            'nombre_prov.unique' => 'Ya existe un proveedor  con ese nombre.',
   

        ];
        $this->validate($rules, $messages);
        $uni = Provider::find($this->selected_id);
        $uni->update([
            'nombre_prov' => $this->nombre_prov,
            'apellidos'=>$this->apellido,
            'direccion' => $this->direccion,
            'telefono'=>$this->telefono,
            'correo'=>$this->correo,
            'nit'=>$this->nit,
            'status'=>$this->estado
            
        ]);
        $uni->save();

        $this->resetUI();
        $this->emit('proveedor-updated', 'proveedor Actualizado');
    }
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Provider $uni)
    {
        $uni->delete();
        $this->resetUI();
        $this->emit('proveedor-deleted', 'Unidad Eliminada');
    }

    public function resetUI()
    {
        $this->nombre_prov = '';
        $this->selected_id=0;
        $this->apellido='';
        $this->direccion='';
        $this->telefono='';
        $this->correo='';
    }
}
