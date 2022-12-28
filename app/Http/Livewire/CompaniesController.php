<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CompaniesController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $imagen,$imagen_horizontal, $nombre_empresa, $nombre_corto, $direccion, $telefono, $nit_id, $updated_at;

    public $logoprincipal,$logohorizontal;

    public function mount()
    {
        $empresa = Company::all()->first();

        $this->nombre_empresa = $empresa->name;
        $this->imagen = $empresa->image;
        $this->imagen_horizontal = $empresa->horizontal_image;
        $this->nombre_corto = $empresa->shortname;
        $this->direccion = $empresa->adress;
        $this->telefono = $empresa->phone;
        $this->nit_id = $empresa->nit_id;
        $this->updated_at = $empresa->updated_at;
    }
    public function render()
    {
        // $empresa = Company::all()->first();
        // $this->imagen = $empresa->image;

        return view('livewire.company.component', [
            'asd' => "asd",
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    //Escucha los eventos javascript de la vista
    protected $listeners = [
        'update_company' => 'actualizar_empresa'
    ];


    public function actualizar_empresa()
    {



        $rules = [
            'nombre_empresa' => 'required|max:255',
            'nombre_corto' => 'required|max:11',
            'direccion' => 'required|max:500',
            'telefono' => 'required|max:10',
            'nit_id' => 'required|max:20',
        ];
        $messages = [
            'nombre_empresa.required' => 'Ingrese el nombre de la empresa',
            'nombre_empresa.max' => 'Texto no mayor a 255 caracteres',

            'nombre_corto.required' => 'Ingrese el nombre de la empresa',
            'nombre_corto.max' => 'Texto no mayor a 11 caracteres',
            
            'direccion.required' => 'Ingrese la dirección de la empresa',
            'direccion.max' => 'Texto no mayor a 500 caracteres',

            'telefono.required' => 'Ingrese el teléfono de la empresa',
            'telefono.max' => 'Texto no mayor a 10 caracteres',
            
            'nit_id.required' => 'Ingrese nit de la empresa',
            'nit_id.max' => 'Texto no mayor a 20 caracteres',
        ];
        $this->validate($rules, $messages);






        $empresa = Company::find(1);

        $empresa->update([
            'name' => $this->nombre_empresa,
            'shortname' => $this->nombre_corto,
            'adress' => $this->direccion,
            'phone' => $this->telefono,
            'nit_id' => $this->nit_id,
        ]);
        $empresa->save();



        return Redirect::to('companies');



    }

    public function UpdateLogoPrincipal()
    {
        $empresa = Company::find(1);

        $customFileName = uniqid() . '_.' . $this->logoprincipal->extension();
        $this->logoprincipal->storeAs('public/iconos', $customFileName);
        
        $empresa->update([
            'image' => $customFileName,
        ]);
        $empresa->save();



        return Redirect::to('companies');



    }

    public function UpdateLogoHorizontal()
    {
        $empresa = Company::find(1);

        $customFileName2 = uniqid() . '_.' . $this->logohorizontal->extension();
        $this->logohorizontal->storeAs('public/iconos', $customFileName2);
        
        $empresa->update([
            'horizontal_image' => $customFileName2,
        ]);
        $empresa->save();



        return Redirect::to('companies');



    }

    
}
