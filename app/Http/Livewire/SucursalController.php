<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
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
    public  $search, $name, $adress, $telefono, $celular, $nit_id, $company_id, $selected_id,$sucursal_id, $mensaje_toast;
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
            'name' => "required|max:255",
            'adress' => "required|max:500",
            'telefono' => "max:10",
            'celular' => "max:10",
            'nit_id' => "max:20",
        ];
        $messages = [

            'name.required' => 'El nombre de la empresa es requerido.',
            'name.max' => 'Texto no mayor a 255 caracteres',


            'adress.required' => 'El nombre de la direccion es requerido.',
            'adress.max' => 'Texto no mayor a 500 caracteres',
            'telefono.max' => 'Texto no mayor a 10 caracteres',
            'celular.max' => 'Texto no mayor a 10 caracteres',
            'nit_id.max' => 'Texto no mayor a 20 caracteres',


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
        \Illuminate\Support\Facades\Artisan::call('cache:clear');

        DestinoSucursal::create([
            'destino_id' => $destino->id,
            'sucursal_id' => $sucursal->id
        ]);



        $this->resetUI();
        $this->mensaje_toast = 'Sucursal Registrada';
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
            'name' => "required|unique:companies,name,{$this->selected_id}|max:255",
            'adress' => "required|unique:companies,adress,{$this->selected_id}|max:500",
            'telefono' => "unique:companies,adress,{$this->selected_id}|max:10",
            'celular' => "unique:companies,adress,{$this->selected_id}|max:10",
            'nit_id' => "unique:companies,adress,{$this->selected_id}|max:20",
            'company_id' => 'required|not_in:Elegir'
        ];
        $messages = [





            'name.required' => 'El nombre de la empresa es requerido.',
            'name.unique' => 'Ya existe una empresa con ese nombre.',
            'name.max' => 'Texto no mayor a 255 caracteres',


            'adress.required' => 'El nombre de la direccion es requerido.',
            'adress.unique' => 'Ya existe una dirección con ese nombre.',
            'adress.max' => 'Texto no mayor a 500 caracteres',


            'telefono.unique' => 'Ya existe un telefono con ese numero.',
            'telefono.max' => 'Texto no mayor a 10 caracteres',


            'celular.unique' => 'Ya existe un celular con ese numero.',
            'celular.max' => 'Texto no mayor a 10 caracteres',


            'nit_id.unique' => 'Ya existe un nit con ese nombre.',
            'nit_id.max' => 'Texto no mayor a 20 caracteres',
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
        $this->mensaje_toast = 'Sucursal Actualizada';
        $this->emit('item-updated', 'Sucursal Actualizada');
    }
    //Verifica que la sucursal tiene movimientos
    public function verificarmovimientos($idsucursal)
    {
        $movimientos = Sucursal::join("sucursal_users as su","su.sucursal_id","sucursals.id")
        ->where("sucursals.id",$idsucursal)
        ->get();

        $this->sucursal_id = $idsucursal;
        if($movimientos->count() > 0)
        {
            $this->emit("ConfirmarAnular");
        }
        else
        {
            $this->emit("ConfirmarEliminar");
        }
    }
    protected $listeners = [
        'deleteRow' => 'Destroy',
        'cancelRow' => 'Cancel'
    ];

    public function Destroy()
    {
        $destinosucursal = DestinoSucursal::where("destino_sucursals.sucursal_id",$this->sucursal_id)->get();
        foreach($destinosucursal as $sd)
        {
            $sd->delete();
        }

        

        $destinos = Destino::where("destinos.sucursal_id",$this->sucursal_id)->get();
        foreach($destinos as $d)
        {
            $d->delete();
        }






        $sucursal = Sucursal::find($this->sucursal_id);
        $sucursal->delete();
        $this->resetUI();
        $this->mensaje_toast = 'Sucursal Eliminada';
        $this->emit('item-deleted', 'Sucursal Eliminada');
    }
    public function Cancel()
    {
        $sucursal = Sucursal::find($this->sucursal_id);

        $sucursal->update([
            'estado' => "INACTIVO"
        ]);
        $sucursal->save();



        //Inactivando todas las cajas
        $cajas = Caja::where("cajas.sucursal_id",$this->sucursal_id)
        ->where("cajas.id","<>",1)
        ->get();

        foreach($cajas as $c)
        {
            $c->update([
                'estado' => "Inactivo"
            ]);
            $c->save();


            $carteras = Cartera::where("carteras.caja_id",$c->id)->get();


            foreach($carteras as $car)
            {
                $car->update([
                    'estado' => "INACTIVO"
                ]);
                $car->save();
            }



        }










        //Inactivando todas las carteras que esten en las cajas inactivadas


        



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
