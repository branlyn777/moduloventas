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
    public  $pageTitle, $componentName,$image,$mensaje_toast;
    private $pagination = 10;
    
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Proveedores';
        $this->selected_id = 0;
        $this->estados='TODOS';
    }

    public function render()
    {
       
                $suplier = Provider::select('providers.*')
                ->where(function($querys){
                    $querys->where('nombre_prov', 'like', '%' . $this->search . '%')
                    ->when($this->estados !='TODOS',function($query){
                            return $query->where('status',$this->estados);
                     });
                })->paginate($this->pagination);
        
            return view('livewire.i_suplier.component', ['data_proveedor' => $suplier])
                ->extends('layouts.theme.app')
                ->section('content');
        
    }
    public function Store()
    {
        $rules = ['nombre_prov' =>'required|alpha|max:50|unique:providers',
                  'correo'=> 'sometimes|email',
                  'apellido'=>'alpha',
                  'direccion'=>'sometimes|alpha',
                  'nit'=>'numeric',
                  'telefono'=>'numeric'
];
        $messages = ['nombre_prov.required'=> 'El nombre del proveedor es requerido.',
            'nombre_prov.unique'=> 'Ya existe un proveedor  con ese nombre.',
            'nombre_prov.alpha'=>'Nombre no valido, solamente puede ingresar letras.',
            'apellido.alpha'=>'Apellido no valido, solamente puede ingresar letras.',
            'direccion.alpha'=>'Direccion no valida, solamente puede ingresar letras.',
            'correo.email'=>'Ingrese un correo valido.',
            'nit.numeric'=>'El numero de nit solamente puede ser numeros.',
            'telefono.numeric'=>'El numero de telefono debe contener solamente numeros.'

    ];
        $this->validate($rules, $messages);

        $provider=Provider::create([
            'nombre_prov' => strtoupper($this->nombre_prov),
            'apellido'=>strtoupper($this->apellido),
            'nit'=>$this->nit,
            'direccion' =>strtoupper($this->direccion),
            'telefono'=>$this->telefono,
            'correo'=>$this->correo
        ]);

        if ($this->image) {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/proveedores/', $customFileName);
            $provider->image = $customFileName;
            $provider->save();
        }
        else{
            $provider->image='noimage.png';
            $provider->save();
        }

        $this->resetUI();
        $this->mensaje_toast='Proveedor Registrado';
        $this->emit('proveedor-added');
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
        if ($this->image) {
            $customFileName = uniqid() . '_.' . $this->image->extension();

            
            $this->image->storeAs('public/proveedores/', $customFileName);
            $uni->image = $customFileName;
            $uni->save();
        }
       

        $this->resetUI();
        $this->mensaje_toast='Proveedor Actualizado';
        $this->emit('proveedor-updated', 'proveedor Actualizado');
    }
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Provider $uni)
    {
        $uni->delete();
        $this->resetUI();
        $this->mensaje_toast='Proveedor Eliminado con exito';
        $this->emit('proveedor-deleted');
    }

    public function resetUI()
    {
        $this->nombre_prov = '';
        $this->selected_id=0;
        $this->apellido='';
        $this->direccion='';
        $this->telefono='';
        $this->correo='';
        $this->nit=null;
        $this->image=null;
        
    }
}
