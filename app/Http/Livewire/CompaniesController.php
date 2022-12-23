<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CompaniesController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $nombre_empresa, $imagen, $nombre_corto, $direccion, $telefono, $celular, $nit_id, $updated_at;


    public function mount()
    {

    }
    public function render()
    {
        $empresa = Company::all()->first();

        $this->nombre_empresa = $empresa->name;
        $this->imagen = $empresa->image;
        $this->nombre_corto = $empresa->shortname;
        $this->direccion = $empresa->adress;
        $this->telefono = $empresa->telefono;
        $this->celular = $empresa->celular;
        $this->nit_id = $empresa->nit_id;
        $this->updated_at = $empresa->updated_at;



        return view('livewire.company.component', [
            'nombre_empresa' => $this->nombre_empresa,
            'imagen' => $this->imagen,
            'nombre_corto' => $this->nombre_corto,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'celular' => $this->celular,
            'nit_id' => $this->nit_id,
            'updated_at' => $this->updated_at,
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    public function actualizar()
    {
        $empresa = Company::find(1);



        $customFileName = uniqid() . '_.' . $this->image->extension();
        $this->image->storeAs('public/iconos', $customFileName);

        $empresa->update([
            'name' => $this->g_nombre_empresa,
            'image' => $customFileName
        ]);
        $empresa->save();
    }
}
