<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\ClienteMov;
use App\Models\Origen;
use App\Models\ProcedenciaCliente;
use Carbon\Carbon;
use Facade\FlareClient\Http\Client;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ClienteController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public  $search, $nombre, $cedula, $celular, $direccion, $email, $fnacim, $razonsocial, $nit, $procedencia, $selected_id, $image, $cliente_id;
    public  $pageTitle, $componentName;
    private $pagination = 40;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Cliente';
        $this->selected_id = 0;
        $this->nombre = '';
        $this->direccion = '';
        $this->email = '';
        $this->razonsocial = '';
        $this->image = '';
        $this->procedencia = "Elegir";
        $this->fnacim =  Carbon::parse(Carbon::now())->format('Y-m-d');
    }

    public function render()
    {
        if (strlen($this->search) > 0)
            $cliente = Cliente::join('procedencia_clientes as pc', 'clientes.procedencia_cliente_id', 'pc.id')
                ->select('clientes.*', 'pc.procedencia as procedencia')
                ->where('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('cedula', 'like', '%' . $this->search . '%')
                ->orWhere('celular', 'like', '%' . $this->search . '%')
                ->orWhere('nit', 'like', '%' . $this->search . '%')
                ->orWhere('procedencia', 'like', '%' . $this->search . '%')
                ->orderBy('id', 'desc')
                ->paginate($this->pagination);
        else
            $cliente = Cliente::join('procedencia_clientes as pc', 'clientes.procedencia_cliente_id', 'pc.id')
                ->select('clientes.*', 'pc.procedencia as procedencia')
                ->orderBy('id', 'desc')
                ->paginate($this->pagination);
        return view('livewire.cliente.component', [
            'data' => $cliente,
            'procedenciaClientes' => ProcedenciaCliente::orderBy('id', 'asc')->get()
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
            'nombre' => 'required|max:255',
            'cedula' => 'required|min:5|max:10,unique|unique:clientes',
            'celular' => 'required|min:8',
            'procedencia' => 'required|not_in:Elegir',
            'email' => 'max:100',
            'direccion' => 'max:255',
            'nit' => 'max:12',
            'razonsocial' => 'max:255',
        ];
        $messages = [
            'nombre.required' => 'El nombre es requerido.',
            'nombre.max' => 'Numero de caracteres no mayor a 255',
            'cedula.required' => 'Numero de cédula es requerido.',
            'cedula.max' => 'Numero de caracteres no mayor a 10',
            'cedula.min' => 'Ingrese un numero de cédula superior a 5 dígitos.',
            'cedula.unique' => 'El CI ya existe',
            'celular.required' => 'Numero de celular es requerido.',
            'celular.min' => 'Ingrese un celular superior a 7 dígitos.',
            'email.max'  => 'Numero de caracteres no mayor a 100',
            'nit.max'  => 'Numero de caracteres no mayor a 100',
            'razonsocial.max'  => 'Numero de caracteres no mayor a 255',
            'direccion.max'  => 'Numero de caracteres no mayor a 255',
            'procedencia.required' => 'Selecciona procedencia',
            'procedencia.not_in' => 'Selecciona procedencia',
        ];
        $this->validate($rules, $messages);




        Cliente::create([
            'nombre' => $this->nombre,
            'cedula' => $this->cedula,
            'celular' => $this->celular,
            'direccion' => $this->direccion,
            'email' => $this->email,
            'fecha_nacim' => $this->fnacim,
            'razon_social' => $this->razonsocial,
            'nit' => $this->nit,
            'procedencia_cliente_id' => $this->procedencia,
        ]);

        $this->resetUI();
        $this->emit('item-added', 'Cliente Registrado');
    }

    public function Edit(Cliente $cli)
    {
        $this->selected_id = $cli->id;
        $this->nombre = $cli->nombre;
        $this->cedula = $cli->cedula;
        $this->celular = $cli->celular;
        $this->email = $cli->email;
        $this->fnacim = $cli->fecha_nacim;
        $this->nit = $cli->nit;
        $this->direccion = $cli->direccion;
        $this->razonsocial = $cli->razon_social;
        $this->procedencia = $cli->procedencia_cliente_id;

        $this->emit('show-modal', 'show modal!');
    }

    public function Update()
    {
        // $rules = [
        //     'cedula' => "required|min:5|unique:clientes,cedula,{$this->selected_id}",
        //     'celular' => 'required|min:8'
        // ];
        // $messages = [
        //     'cedula.required' => 'Numero de cédula es requerido.',
        //     'cedula.min' => 'Ingrese un numero de cédula superior a 5 dígitos.',
        //     'cedula.unique' => 'El CI ya existe',
        //     'celular.required' => 'Numero de celular es requerido.',
        //     'celular.min' => 'Ingrese un celular superior a 7 dígitos.'
        // ];
        // $this->validate($rules, $messages);

        $cliente = Cliente::find($this->selected_id);
        $cliente->update([
            'nombre' => $this->nombre,
            'cedula' => $this->cedula,
            'celular' => $this->celular,
            'direccion' => $this->direccion,
            'email' => $this->email,
            'fecha_nacim' => $this->fnacim,
            'razon_social' => $this->razonsocial,
            'nit' => $this->nit,
            'procedencia_cliente_id' => $this->procedencia
        ]);

        $this->resetUI();
        $this->emit('item-updated', 'Cliente Actualizado');
    }

    //Verifica que el cliente no tenga movimientos en el sistema para ser eliminado
    public function VerificarMovimientos($id)
    {
        $movimientos = ClienteMov::where("cliente_id",$id)->get();

        $this->cliente_id = $id;

        if($movimientos->count() > 0)
        {
            $this->emit("inactivar-cliente");
        }
        else
        {
            $this->emit("eliminar-cliente");
        }
    }

    protected $listeners = [
        'deleteRow' => 'Destroy',
        'cancelRow' => 'Cancel',
    ];

    public function Destroy()
    {
        $cli = Cliente::find($this->cliente_id);
        $cli->delete();
        $this->resetUI();
    }
    public function Cancel()
    {
        $cliente = Cliente::find($this->cliente_id);
        $cliente->update([
            'estado' => 'INACTIVO'
        ]);
        $cliente->save();
    }

    public function resetUI()
    {
        $this->selected_id = 0;
        $this->nombre = '';
        $this->cedula = '';
        $this->celular = '';
        $this->email = '';
        $this->fnacim =  Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->reset(['nit']);
        $this->procedencia = 'Elegir';
        $this->direccion = '';
        $this->razonsocial = '';
        $this->resetValidation();
    }
}
