<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\ProcedenciaCliente;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProcedenciaController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public  $search, $procedencia, $estado, $selected_id, $estado_0, $mensaje_toast;
    public  $pageTitle, $componentName, $estados;
    private $pagination = 5;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->estados = true;
        $this->estado = 'Activo';
        $this->estado_0 = "Elegir";
        $this->pageTitle = 'Listado';
        $this->componentName = 'Procedencias';
        $this->selected_id = 0;
    }

    public function render()
    {
        if (strlen($this->search) > 0)
        {
            $procedencia = ProcedenciaCliente::where('procedencia', 'like', '%' . $this->search . '%')
            ->orWhere('estado', $this->estado)
            ->paginate($this->pagination);
        }
        else
        {
            $procedencia = ProcedenciaCliente::where('estado', $this->estado)
            ->paginate($this->pagination);
        }


        return view('livewire.procedencia.component', [
            'data' => $procedencia,
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
            'procedencia' => 'required|unique:procedencia_clientes',
            'estado_0' => 'required|not_in:Elegir'
        ];
        $messages = [
            'procedencia.required' => 'El nombre de la procedencia es requerido.',
            'procedencia.unique' => 'El nombre de la procedencia debe ser único.',
            'estado_0.required' => 'El estado es requerido.',
            'estado_0.not_in' => 'El estado debe ser distinto de Elegir.'
        ];
        $this->validate($rules, $messages);

        ProcedenciaCliente::create([
            'procedencia' => $this->procedencia,
            'estado' => $this->estado_0
        ]);

        $this->resetUI();
        $this->mensaje_toast = 'Procedencia Registrada';
        $this->emit('item-added', 'Procedencia Registrada');
    }

    public function Edit(ProcedenciaCliente $proced)
    {
        $this->selected_id = $proced->id;
        $this->procedencia = $proced->procedencia;
        $this->estado_0 = $proced->estado;

        $this->emit('show-modal', 'show modal!');
    }

    public function Update()
    {
        $rules = [
            'procedencia' => "required|unique:procedencia_clientes,procedencia,{$this->selected_id}",
            'estado_0' => 'required|not_in:Elegir'
        ];
        $messages = [
            'procedencia.required' => 'El nombre de la procedencia es requerido.',
            'procedencia.unique' => 'El nombre de la procedencia debe ser único.',
            'estado_0.required' => 'El estado es requerido.',
            'estado_0.not_in' => 'El estado debe ser distinto de Elegir.'
        ];
        $this->validate($rules, $messages);

        $pro = ProcedenciaCliente::find($this->selected_id);

        $pro->update([
            'procedencia' => $this->procedencia,
            'estado' => $this->estado_0
        ]);

        $pro->save();

        $this->resetUI();
        $this->mensaje_toast = 'Procedencia Actualizada';
        $this->emit('item-updated', 'Procedencia Actualizada');
    }

    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(ProcedenciaCliente $pro)
    {

        $verificar = Cliente::where("clientes.procedencia_cliente_id", $pro->id)->get();

        if ($verificar->count() == 0) {
            $pro->delete();
            $this->resetUI();
            $this->mensaje_toast = 'Procedencia Eliminada';
            $this->emit('item-deleted', 'Procedencia Eliminada');
        } else {
            $this->emit('alerta-procedencia');
        }
    }

    public function resetUI()
    {
        $this->procedencia = '';
        // $this->estado = 'Elegir';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }

    public function cambioestado()
    {
        if ($this->estados == true)
        {
            $this->estados = false;
            $this->estado = "Desactivado";
        }
        else
        {
            $this->estado = "Activo";
            $this->estados = true;
        }
    }
}
