<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Destino;
use App\Models\DestinoSucursal;
use App\Models\Permission;
use App\Models\Sucursal;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SucursalController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public  $search, $name, $adress, $telefono, $celular, $nit_id, $company_id, $selected_id;
    public  $pageTitle, $componentName;
    private $pagination = 5;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Sucursales';
        $this->company_id = 'Elegir';
        $this->selected_id = 0;
    }
    public function render()
    {
        if (strlen($this->search) > 0)
        {
            $sucursal = Sucursal::join('companies as c', 'c.id', 'sucursals.company_id')
            ->select('sucursals.*', 'c.name as company')
            ->where('sucursals.name', 'like', '%' . $this->search . '%')
            ->paginate($this->pagination);
        }
        else
        {
            $sucursal = Sucursal::join('companies as c', 'c.id', 'sucursals.company_id')
            ->select('sucursals.*', 'c.name as company')
            ->paginate($this->pagination);
        }
        return view('livewire.sucursales.component', [
            'data' => $sucursal,
            'empresas' => Company::orderBy('name', 'asc')->get()
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    
    public function Agregar()
    {
        $this->resetUI();
        $this->emit('show-modal');
    }

    public function Store()
    {
        $rules = [
            'name' => 'required|unique:sucursals'
        ];
        $messages = [
            'name.required' => 'El nombre de la empresa es requerido.',
            'name.unique' => 'Ya existe una empresa con ese nombre.'
        ];
        $this->validate($rules, $messages);


        $sucursal = Sucursal::create([
            'name' => $this->name,
            'adress' => $this->adress,
            'telefono' => $this->telefono,
            'celular' => $this->celular,
            'nit_id' => $this->nit_id,
            'company_id' => 1
        ]);
        $sucursal->save();

        //Creando el destino que servira para realizar las ventas de la sucursal recien creada
        $destino = Destino::create([
            'nombre' => "Tienda " . $this->name,
            'observacion' => "Destino donde se almacenarán todos los productos para la venta de la sucursal " . $this->name,
            'sucursal_id' => $sucursal->id
        ]);
        $destino->save();

        Permission::create([
            'name' => $destino->nombre .'_'. $destino->id ,
            'guard_name' => 'web',
            'areaspermissions_id' => '2',
            'descripcion' => 'Ingresar al destino',
        ]);


        DestinoSucursal::create([
            'destino_id' => $destino->id,
            'sucursal_id' => $sucursal->id
        ]);



        $this->resetUI();
        $this->emit('item-added', 'Sucursal Registrada');
    }
    public function Edit(Sucursal $sucursal)
    {
        $this->selected_id = $sucursal->id;
        $this->name = $sucursal->name;
        $this->adress = $sucursal->adress;
        $this->telefono = $sucursal->telefono;
        $this->celular = $sucursal->celular;
        $this->nit_id = $sucursal->nit_id;
        $this->company_id = $sucursal->company_id;

        $this->emit('show-modal', 'show modal!');
    }
    public function Update()
    {
        $rules = [
            'name' => "required|unique:companies,name,{$this->selected_id}",
            'company_id' => 'required|not_in:Elegir'
        ];
        $messages = [
            'name.required' => 'El nombre de la empresa es requerido.',
            'name.unique' => 'Ya existe una empresa con ese nombre.',
            'company_id.not_in' => 'Seleccione un nombre de Empresa diferente de Elegir',

        ];
        $this->validate($rules, $messages);
        $suc = Sucursal::find($this->selected_id);
        $suc->update([
            'name' => $this->name,
            'adress' => $this->adress,
            'telefono' => $this->telefono,
            'celular' => $this->celular,
            'nit_id' => $this->nit_id,
            'company_id' => $this->company_id
        ]);
        $suc->save();

        $this->resetUI();
        $this->emit('item-updated', 'Sucursal Actualizada');
    }
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Sucursal $sucursal)
    {
        $sucursal->delete();
        $this->resetUI();
        $this->emit('item-deleted', 'Sucursal Eliminada');
    }

    public function resetUI()
    {
        $this->name = '';
        $this->adress = '';
        $this->telefono = '';
        $this->celular = '';
        $this->nit_id = '';
        $this->company_id = 'Elegir';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
}
