<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CarteraController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public  $search, $nombre, $descripcion, $tipo, $telefonoNum, $selected_id, $caja_id, $mensaje_toast;
    public  $pageTitle, $componentName, $variable, $estados;
    private $pagination = 10;

    public $mostrar_caja;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Carteras';
        $this->caja_id = 'Elegir';
        $this->tipo = 'Elegir';
        $this->variable = 0;
        $this->telefonoNum = 0;
        $this->selected_id = 0;
        $this->estados = true;
    }

    public function render()
    {

        if($this->estados)
        {
            if(strlen($this->search) > 0)
            {
                $data = Cartera::select('carteras.*',DB::raw('0 as movimientos'))
                ->where('nombre', 'like', '%' . $this->search . '%')
                ->where('estado','ACTIVO')
                ->orwhere('tipo', 'like', '%' . $this->search . '%')
                ->paginate($this->pagination);
            }
            else
            {
                $data = Cartera::select('carteras.*', DB::raw('0 as movimientos'))
                ->where('estado','ACTIVO')
                ->orderBy('id', 'desc')
                ->paginate($this->pagination);
            }
        }
        else
        {
            if (strlen($this->search) > 0)
            {
                $data = Cartera::select('carteras.*', DB::raw('0 as movimientos'))
                ->where('estado','INACTIVO')
                ->where('nombre', 'like', '%' . $this->search . '%')
                ->orwhere('tipo', 'like', '%' . $this->search . '%')
                ->paginate($this->pagination);
            }
            else
            {
                $data = Cartera::select('carteras.*', DB::raw('0 as movimientos'))
                ->where('estado','INACTIVO')
                ->orderBy('id', 'desc')
                ->paginate($this->pagination);
            }
        }









        // CONTAR MOVIMIENTOS DE LA CARTERA PARA PERMITIR O NO PERMITIR ELIMINARLA
        foreach ($data as $value) {
            $movimientos = Cartera::join('cartera_movs as cm', 'cm.cartera_id', 'carteras.id')
                ->where('carteras.id', $value->id)
                ->where('cm.tipoDeMovimiento', '!=', 'EGRESO/INGRESO')
                ->where('cm.tipoDeMovimiento', '!=', 'CORTE')
                ->get();
            $value->movimientos = $movimientos->count();
        }

        if($this->tipo != 'Elegir')
        {
            if($this->tipo == 'Telefono' || $this->tipo == 'Sistema')
            {
                $this->variable = 1;
            }
            else
            {
                $this->variable = 0;
            }
        }

        return view('livewire.cartera.component', [
            'data' => $data,
            'cajas' => Caja::orderBy('nombre', 'asc')->get()
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    public function Agregar()
    {
        $this->mostrar_caja = true;
        $this->resetUI();
        $this->emit('show-modal', 'show modal!');
    }
    public function Store()
    {
        $rules = [
            'nombre' => 'required|unique:carteras|max:255',

       
            'descripcion' => 'required|max:255',     
            // 'telefonoNum' => 'required_if:variable,==,1',
        ];
        $messages = [
            'nombre.required' => 'Nombre de la cartera requerido.',
            'descripcion.required' => ' Descripción requerido.',
            'nombre.max' => 'Texto no mayor a 255 caracteres',
            'descripcion.max' => 'Texto no mayor a 255 caracteres',
            'nombre.unique' => 'Ese nombre de cartera ya existe.'
    
            // 'telefonoNum.required_if' => 'El teléfono es requerido.',
        ];

        $this->validate($rules, $messages);
        if ($this->VerificarCartera() == false)
        {
            Cartera::create([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'tipo' =>'digital',
                'telefonoNum' => 0,
                'caja_id' => 1
            ]);

            $this->resetUI();
            $this->mensaje_toast = 'Cartera Registrada';
            $this->emit('item-added', 'Cartera Registrada');
        }
        else
        {
            $this->emit('alert');
        }
    }
    public function VerificarCartera()
    {
        if($this->tipo == "efectivo")
        {
            $consulta = Cartera::select("carteras.nombre")
            ->where("carteras.tipo", "efectivo")
            ->where("carteras.caja_id", $this->caja_id)
            ->get();
            if ($consulta->count() > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }


        
    }
    //Cambia la variable estados para los filtros de activo e inactivo
    public function cambioestado()
    {
        if($this->estados)
        {
            $this->estados = false;
        }
        else
        {
            $this->estados = true;
        }
    }
    public function Edit(Cartera $cartera)
    {
        $this->selected_id = $cartera->id;
        $this->nombre = $cartera->nombre;
        $this->descripcion = $cartera->descripcion;
        $this->tipo = $cartera->tipo;
        $this->telefonoNum = $cartera->telefonoNum;
        $this->caja_id = $cartera->caja_id;
        $this->mostrar_caja = false;
        $this->emit('show-modal', 'show modal!');
    }
    public function Update()
    {
        $rules = [
            'nombre' => "required|unique:carteras,nombre,{$this->selected_id}|max:255",
            'caja_id' => 'required|not_in:Elegir',
            'tipo' => 'required|not_in:Elegir',
            'descripcion' => 'required|max:255',  
        ];
        $messages = [
            'nombre.required' => 'Nombre de la cartera requerido.',
            'descripcion.required' => ' Descripción requerido.',
            'nombre.max' => 'Texto no mayor a 255 caracteres',
            'descripcion.max' => 'Texto no mayor a 255 caracteres',
            'nombre.unique' => 'Ese nombre de cartera ya existe.',
            'caja_id.required' => 'La caja es requerido.',
            'caja_id.not_in' => 'La caja debe ser distinto de Elegir.',
            'tipo.required' => 'El tipo es requerido.',
            'tipo.not_in' => 'El tipo debe ser distinto de Elegir.'
        ];

        $this->validate($rules, $messages);



        if($this->tipo != "efectivo")
        {
            $cartera = Cartera::find($this->selected_id);
            $cartera->update([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'tipo' => $this->tipo,
                'telefonoNum' => $this->telefonoNum,
                'caja_id' => $this->caja_id
            ]);
            $cartera->save();
            $this->resetUI();
            $this->mensaje_toast = 'Cartera Actualizada';
            $this->emit('item-updated', 'Cartera Actualizada');
    
        }
        else
        {
            $caja = Caja::join("carteras as c","c.caja_id","cajas.id")
            ->select("cajas.id as cajaid")
            ->where("c.id",$this->selected_id)
            ->first();



            $consulta = Cartera::select("carteras.id as idcartera")
            ->where("carteras.tipo", "efectivo")
            ->where("carteras.caja_id", $caja->cajaid)
            ->where("carteras.id", $this->selected_id)
            ->get();

            if ($consulta->count() > 0)
            {
                if($consulta->first()->idcartera == $this->selected_id)
                {
                    $cartera = Cartera::find($this->selected_id);
                    $cartera->update([
                        'nombre' => $this->nombre,
                        'descripcion' => $this->descripcion,
                        'tipo' => $this->tipo,
                        'telefonoNum' => $this->telefonoNum,
                        'caja_id' => $this->caja_id
                    ]);
                    $cartera->save();
                    $this->resetUI();
                    $this->mensaje_toast = 'Cartera Actualizada';
                    $this->emit('item-updated', 'Cartera Actualizada');
                }
                else
                {
                    $this->emit('alert');
                }
            }
            else
            {
                $this->emit('alert');
            }
        }




    }
    protected $listeners = [
        'deleteRow' => 'Destroy',
        'cancelRow' => 'cancel',
        'activarRow' => 'activar'
    ];
    public function Destroy(Cartera $cartera)
    {
         
        $cartera->delete();
        $this->resetUI();
        $this->mensaje_toast = 'Cartera Eliminada';
        $this->emit('item-deleted', 'Cartera Eliminada'); 
    }
    public function cancel($idcartera)
    {
        $cartera = Cartera::find($idcartera);
        $cartera->update([
            'estado' => "INACTIVO"
        ]);
        $cartera->save();
    }
    public function activar($idcartera)
    {
        $cartera = Cartera::find($idcartera);
        $cartera->update([
            'estado' => "ACTIVO"
        ]);
        $cartera->save();
    }
    public function resetUI()
    {
        $this->nombre = '';
        $this->descripcion = '';
        $this->tipo = '';
        $this->search = '';
        $this->caja_id = 'Elegir';
        $this->tipo = 'Elegir';
        $this->telefonoNum = '';
        $this->selected_id = 0;
        $this->variable = 0;
        $this->resetValidation();
    }
}
