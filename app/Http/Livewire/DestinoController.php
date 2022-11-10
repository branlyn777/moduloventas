<?php

namespace App\Http\Livewire;

use App\Models\Destino;
use App\Models\DestinoSucursal;
use App\Models\Location;
use Spatie\Permission\Models\Permission;
use App\Models\Sucursal;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Database\Seeders\DestinoSeeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DestinoController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public  $pageTitle, $componentName;
    private $pagination;

public $nombre,$sucursal,$observacion,$selected_id,$search,$estados,$estadosmodal,$sucursal_id, $verificar;
    
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
    $this->sucursal_id = "Todos";
    $this->verificar = false;
}
    public function render()
    {
        if (strlen($this->search) == 0)
        {
            if($this->sucursal_id != "Todos")
            {
                if($this->estados == 'TODOS')
                {
                    $destinos = Destino::join('sucursals as s','s.id','destinos.sucursal_id')
                    ->select('destinos.id as iddestino','destinos.nombre as nombredestino','destinos.status as estado', DB::raw('0 as venta'),
                    'destinos.created_at as creacion','destinos.updated_at as actualizacion','destinos.observacion as observacion','s.name as nombresucursal')
                    ->where("destinos.sucursal_id", $this->sucursal_id)
                    ->paginate($this->pagination);
                }
                else
                {
                    $destinos = Destino::join('sucursals as s','s.id','destinos.sucursal_id')
                    ->select('destinos.id as iddestino','destinos.nombre as nombredestino','destinos.status as estado', DB::raw('0 as venta'),
                    'destinos.created_at as creacion','destinos.updated_at as actualizacion','destinos.observacion as observacion','s.name as nombresucursal')
                    ->where("destinos.sucursal_id", $this->sucursal_id)
                    ->where('destinos.status', $this->estados)
                    ->paginate($this->pagination);
                }
            }
            else
            {
                if($this->estados == 'TODOS')
                {
                    $destinos = Destino::join('sucursals as s','s.id','destinos.sucursal_id')
                    ->select('destinos.id as iddestino','destinos.nombre as nombredestino','destinos.status as estado', DB::raw('0 as venta'),
                    'destinos.created_at as creacion','destinos.updated_at as actualizacion','destinos.observacion as observacion','s.name as nombresucursal')
                    ->paginate($this->pagination);
                }
                else
                {
                    $destinos = Destino::join('sucursals as s','s.id','destinos.sucursal_id')
                    ->select('destinos.id as iddestino','destinos.nombre as nombredestino','destinos.status as estado', DB::raw('0 as venta'),
                    'destinos.created_at as creacion','destinos.updated_at as actualizacion','destinos.observacion as observacion','s.name as nombresucursal')
                    ->where('destinos.status', $this->estados)
                    ->paginate($this->pagination);
                }
            }
        }
        else
        {
            $destinos = Destino::join('sucursals as s','s.id','destinos.sucursal_id')
            ->select('destinos.id as iddestino','destinos.nombre as nombredestino','destinos.status as estado', DB::raw('0 as venta'),
            'destinos.created_at as creacion','destinos.updated_at as actualizacion','destinos.observacion as observacion','s.name as nombresucursal')
            ->where('destinos.nombre', 'like', '%' . $this->search . '%')
            ->paginate($this->pagination);
        }


        foreach($destinos as $d)
        {
            $verificar = DestinoSucursal::where("destino_sucursals.destino_id", $d->iddestino)->get();

            if($verificar->count() == 0)
            {
                $d->venta = "No";
            }
            else
            {
                $d->venta = "Si";
            }

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
        $verificar = DestinoSucursal::where("destino_sucursals.destino_id", $destino->id)->get();

        if($verificar->count() == 0)
        {
            $this->verificar = true;
        }
        else
        {
            $this->verificar = false;
        }

        $this->selected_id = $destino->id;
        $this->nombre = $destino->nombre;
        $this->observacion = $destino->observacion;
        $this->sucursal = $destino->sucursal_id;
        $this->estadosmodal = $destino->status;
        
        $this->emit('show-modal');
    }
    //Obtener el Id de la Sucursal donde esta el Usuario
    public function idsucursal()
    {
        $idsucursal = User::join("sucursal_users as su","su.user_id","users.id")
        ->select("su.sucursal_id as id","users.name as n")
        ->where("users.id",Auth()->user()->id)
        ->where("su.estado","ACTIVO")
        ->get()
        ->first();
        return $idsucursal->id;
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
