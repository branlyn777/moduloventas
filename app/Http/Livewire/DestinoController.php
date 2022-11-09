<?php

namespace App\Http\Livewire;

use App\Models\Destino;
use App\Models\Location;
use Spatie\Permission\Models\Permission;
use App\Models\Sucursal;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Carbon;

class DestinoController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public  $pageTitle, $componentName;
    private $pagination;

public $nombre,$sucursal,$observacion,$selected_id,$search,$estados,$estadosmodal;
    
public function paginationView()
{
    return 'vendor.livewire.bootstrap';
}
public function mount()
{
    $this->selected_id = 0;
    $this->estados = 'ACTIVO';
    $this->fecha = Carbon::now();
    $this->pagination = 50;
    $this->pageTitle = 'Listado';
    $this->componentName = 'DESTINOS';
}
    public function render()
    {
        if (strlen($this->search) == 0)
        {
            if($this->estados == 'TODOS')
            {
                $destinos = Destino::join('sucursals as s','s.id','destinos.sucursal_id')
                ->select('destinos.id as iddestino','destinos.nombre as nombredestino','destinos.status as estado',
                'destinos.created_at as creacion','destinos.updated_at as actualizacion','destinos.observacion as observacion','s.name as nombresucursal')
                ->paginate($this->pagination);
            }
            else
            {
                $destinos = Destino::join('sucursals as s','s.id','destinos.sucursal_id')
                ->select('destinos.id as iddestino','destinos.nombre as nombredestino','destinos.status as estado',
                'destinos.created_at as creacion','destinos.updated_at as actualizacion','destinos.observacion as observacion','s.name as nombresucursal')
                ->where('destinos.status', $this->estados)
                ->paginate($this->pagination);
            }
        }
        else
        {
            $destinos = Destino::join('sucursals as s','s.id','destinos.sucursal_id')
            ->select('destinos.id as iddestino','destinos.nombre as nombredestino','destinos.status as estado',
            'destinos.created_at as creacion','destinos.updated_at as actualizacion','destinos.observacion as observacion','s.name as nombresucursal')
            ->where('destinos.nombre', 'like', '%' . $this->search . '%')
            ->paginate($this->pagination);
        }

        

        $sucursales = Sucursal::where("sucursals.estado","ACTIVO")->get();

       
        return view('livewire.destino.destino',[
            'destinos'=> $destinos,
            'sucursales'=> $sucursales
            ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Store()
    {
        $rules = [
            'nombre' => 'required|unique:unidads',
            'sucursal' => 'required'
            
        ];
        $messages = [
            'nombre.required' => 'El nombre de la unidad es requerido.',
            'nombre.unique' => 'Ya existe una unidad con ese nombre.',
            'sucursal.required' => 'La sucursal es requerida'
        ];
        $this->validate($rules, $messages);

        $destino=Destino::create([
            'nombre' => $this->nombre,
            'observacion'=>$this->observacion,
            'sucursal_id'=>$this->sucursal
          
        ]);

        
        $destino->save();
        
        Permission::create([
            'name' => $destino->nombre .'_'. $destino->id ,
            'guard_name' => 'web',
            'areaspermissions_id' => '2',
            'descripcion' => 'Ingresar al destino',
        ]);

        $this->resetUI();
        $this->emit('unidad-added', 'Estancia Registrada');

        

    }
    public function Edit(Destino $destino)
    {
        $this->selected_id = $destino->id;
        $this->nombre = $destino->nombre;
        $this->observacion = $destino->observacion;
        $this->sucursal = $destino->sucursal_id;
        $this->estadosmodal = $destino->status;
        
        $this->emit('show-modal');
    }
    public function Update()
    {
        $rules = [
            'nombre' => 'required|unique:unidads',
            'sucursal' => 'required'
        ];
        $messages = [
            'nombre.required' => 'El nombre de la unidad es requerido.',
            'nombre.unique' => 'Ya existe una unidad con ese nombre.',
            'sucursal.required' => 'La sucursal es requerida'
        
        ];
        $this->validate($rules, $messages);
        $destino = Destino::find($this->selected_id);
        $destino->update([
            'nombre' => $this->nombre,
            'observacion'=>$this->observacion,
            'sucursal_id'=>$this->sucursal,
            'status'=>$this->estadosmodal
        ]);
        $destino->save();
        $this->resetUI();
        $this->emit('unidad-updated', 'Estancia Actualizada');
    }

    public function modalestancia()
    {
        $this->resetUI();
        $this->emit("show-modal");
    }


    protected $listeners = [
        'deleteRow' => 'Destroy',
        'seleccionar' => 'seleccionardestino',
    ];
    public function Destroy(Destino $destino)
    {
        $destino->update([
            'status' => "INACTIVO"
        ]);
        $destino->save();

        $this->resetUI();
        $this->emit('unidad-deleted', 'Estancia Eliminada');
    }
    public function resetUI()
    {
        $this->nombre = '';
        $this->selected_id = 0;
        $this->observacion = '';
        $this->sucursal = '';
    }


}
