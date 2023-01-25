<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\CarteraMov;
use App\Models\Sucursal;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CajasController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public  $search, $nombre, $estado, $sucursal_id, $selected_id, $mensaje_toast, $caja_id, $estado2;
    public  $pageTitle, $componentName;
    private $pagination = 15;

    public $mostrar_sucursal;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->estado2 = "Activo";
        $this->pageTitle = 'Listado';
        $this->componentName = 'Cajas';
        $this->sucursal_id = 'Elegir';
        $this->selected_id = 0;
    }
    public function render()
    {
        if (strlen($this->search) > 0)
        {
            $caja = Caja::join('sucursals as s', 's.id', 'cajas.sucursal_id')
            ->select('cajas.*', 's.name as sucursal')
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->where("cajas.id", "<>",1)
            ->paginate($this->pagination);
        }
        else
        {
            $caja = Caja::join('sucursals as s', 's.id', 'cajas.sucursal_id')
            ->select('cajas.*', 's.name as sucursal')
            ->where("cajas.id", "<>",1)
            ->paginate($this->pagination);
        }
            



        $sucursales = Sucursal::where("estado","ACTIVO")->orderBy('name', 'asc')->get();



        return view('livewire.cajas.component', [
            'data' => $caja,
            'sucursales' => $sucursales
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    public function Agregar()
    {
        $this->mostrar_sucursal = true;
        $this->resetUI();
        $this->emit('show-modal', 'show modal!');
    }
    public function Store()
    {
        $rules = [
            'nombre' => 'required|unique:cajas',
            'sucursal_id' => 'required|not_in:Elegir',
        ];
        $messages = [
            'nombre.required' => 'El nombre de la caja es requerido.',
            'nombre.unique' => 'Ya existe una caja con ese nombre.',
            'sucursal_id.not_in' => 'Seleccione una sucursal diferente de Elegir',
        ];
        $this->validate($rules, $messages);

        $caja = Caja::create([
            'nombre' => $this->nombre,
            'estado' => 'Cerrado',
            'sucursal_id' => $this->sucursal_id
        ]);

        Cartera::create([
            'nombre' => 'Efectivo-'.$caja->nombre,
            'saldocartera' => '0',
            'descripcion' => 'Cuenta de dinero en efectivo',
            'tipo' => 'efectivo',
            'estado' => 'ACTIVO',
            'caja_id' => $caja->id
        ]);

        $this->resetUI();
        $this->mensaje_toast = 'Caja Registrada';
        $this->emit('item-added', 'Caja Registrada');
    }
    public function Edit(Caja $caja)
    {
        $this->selected_id = $caja->id;
        $this->nombre = $caja->nombre;
        $this->sucursal_id = $caja->sucursal_id;
        $this->estado2 = $caja->status;
        $this->mostrar_sucursal = false;
        $this->emit('show-modal', 'show modal!');
    }
    public function Update()
    {
        $rules = [
            'nombre' => "required|unique:cajas,nombre,{$this->selected_id}",
            'sucursal_id' => 'required|not_in:Elegir',
        ];
        $messages = [
            'nombre.required' => 'El nombre de la caja es requerido.',
            'nombre.unique' => 'Ya existe una caja con ese nombre.',
            'sucursal_id.not_in' => 'Seleccione una sucursal diferente de Elegir',
        ];
        $this->validate($rules, $messages);
        $Caj = Caja::find($this->selected_id);
        $Caj->update([
            'nombre' => $this->nombre,
            'sucursal_id' => $this->sucursal_id
        ]);
        $Caj->save();



        if($this->estado2 == "Activo")
        {
            $lista_carteras = Cartera::where("carteras.caja_id",$this->selected_id)->get();
            foreach($lista_carteras as $cartera)
            {
                $cartera->update([
                    'estado' => "ACTIVO"
                ]);
                $cartera->save();
            }

            $caja = Caja::find($this->selected_id);

            $caja->update([
                'estado' => "Cerrado",
                'status' => "Activo"
            ]);
            $caja->save();
        }


        $this->resetUI();
        $this->mensaje_toast = 'Caja Actualizada';
        $this->emit('item-updated', 'Caja Actualizada');
    }
    protected $listeners = [
        'deleteRow' => 'Destroy',
        'cancelRow' => 'Cancel',
        'verificarcarteras' => 'verificar_carteras'
    ];
    public function Cancel()
    {
        $lista_carteras = Cartera::where("carteras.caja_id",$this->caja_id)->get();
        foreach($lista_carteras as $cartera)
        {
            $cartera->update([
                'estado' => "INACTIVO"
            ]);
            $cartera->save();
        }

        $caja = Caja::find($this->caja_id);

        $caja->update([
            'estado' => "Inactivo",
            'status' => "Inactivo"
        ]);
        $caja->save();


        $this->mensaje_toast = 'Caja Inactivada';
        $this->emit('item-deleted');
    }


    //Verifica que todas las carteras de la caja no tengan movimientos
    public function verificar_carteras($idcaja)
    {
        $caja_seleccionada = Caja::find($idcaja);

        if($caja_seleccionada->estado == "Abierto")
        {
            $this->emit("no-se-puede");
        }
        else
        {
            $lista_carteras = Cartera::where("carteras.caja_id",$idcaja)->get();
            $contador = 0;
            foreach($lista_carteras as $c)
            {
                $verificar = CarteraMov::where("cartera_movs.cartera_id",$c->id)->get();
                if($verificar->count() > 0)
                {
                    $contador++;
                    break;
                }
            }
            if($contador > 0)
            {
                $this->caja_id = $idcaja;
                $this->emit("no-eliminar");
            }
            else
            {
                $this->caja_id = $idcaja;
                $this->emit("confirmar");
            }
        }
    }
    public function Destroy()
    {
        $lista_carteras = Cartera::where("carteras.caja_id",$this->caja_id)->get();
        foreach($lista_carteras as $cartera)
        {
            $cartera->delete();
        }

            $caja = Caja::find($this->caja_id);
            $caja->delete();
        $this->mensaje_toast = 'Caja Eliminada';
        $this->emit('item-deleted', 'Caja Eliminada');
    }
    public function resetUI()
    {
        $this->nombre = '';
        $this->sucursal_id = 'Elegir';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
}
