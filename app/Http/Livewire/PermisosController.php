<?php

namespace App\Http\Livewire;

use App\Models\Areaspermissions;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use App\Models\User;

class PermisosController extends Component
{
    use WithPagination;
    public $permissionName,$permissionArea,$permissionDescripcion, $search, $selected_id, $pageTitle, $componentName, $mensaje_toast;
    private $pagination = 20;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->permissionArea = "Elegir";
        $this->pageTitle = 'Listado';
        $this->componentName = 'Permisos';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
        {
            $permisos = Permission::join("areaspermissions as a", "a.id", "permissions.areaspermissions_id")
            ->select("permissions.id as id","permissions.name as name","permissions.descripcion as descripcion","a.name as area")
            ->orderBy('name', 'asc')
            ->where('permissions.name', 'like', '%' . $this->search . '%')
            ->orWhere('a.name', 'like', '%' . $this->search . '%')
            ->paginate($this->pagination);


        }
        else
        {
            $permisos = Permission::join("areaspermissions as a", "a.id", "permissions.areaspermissions_id")
            ->select("permissions.id as id","permissions.name as name","permissions.descripcion as descripcion","a.name as area")
            ->orderBy('name', 'asc')
            ->paginate($this->pagination);
        }

        $areas = Areaspermissions::OrderBy("areaspermissions.id","asc")->get();


        return view('livewire.permisos.component', [
            'areas' => $areas,
            'data' => $permisos,
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    
    public function Agregar()
    {
        $this->resetUI();
        $this->emit('show-modal', 'show modal!');
    }

    public function CreatePermission()
    {
        $rules = [
            'permissionArea' => 'required|not_in:Elegir',
            'permissionName' => 'required|min:2|unique:permissions,name'
        ];

        $messages = [
            'permissionArea.not_in' => 'Elegir un tipo diferente de elegir',
            'permissionName.required' => 'El nombre del permiso es requerido',
            'permissionName.unique' => 'El permiso ya existe',
            'permissionName.min' => 'El nombre del permiso debe tener al menos 2 caracteres'
        ];

        $this->validate($rules, $messages);


        Permission::create([
            'name' => $this->permissionName,
            'areaspermissions_id' => $this->permissionArea,
            'descripcion' => $this->permissionDescripcion
        ]);

        $this->emit('item-added', 'Se registró el permiso con éxito');
        $this->resetUI();
    }

    public function Edit(Permission $permiso)
    {
        $this->selected_id = $permiso->id;
        $this->permissionName = $permiso->name;
        $this->permissionArea = $permiso->area;
        $this->permissionDescripcion = $permiso->descripcion;


        $this->permissionArea = $permiso->areaspermissions_id;

        $this->emit('show-modal', 'Show modal ');
    }

    public function UpdatePermission()
    {
        $rules = ['permissionName' => "required|min:2|unique:permissions,name, {$this->selected_id}"];

        $messages = [
            'permissionName.required' => 'El nombre del permiso es requerido',
            'permissionName.unique' => 'El permiso ya existe',
            'permissionName.min' => 'El nombre del permiso debe tener al menos 2 caracteres'
        ];

        $this->validate($rules, $messages);

        $role = Permission::find($this->selected_id);
        $role->name = $this->permissionName;
        $role->areaspermissions_id = $this->permissionArea;
        $role->descripcion = $this->permissionDescripcion;
        $role->save();

        $this->mensaje_toast = 'Se actualizó el permiso con éxito';
        $this->emit('item-update', 'Se actualizó el permiso con éxito');
        $this->resetUI();
    }

    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy($id)
    {
        $rolesCount = Permission::find($id)->getRoleNames()->count();

        if ($rolesCount > 0)
        {
            $this->emit('message-toast');
            return;
        }

        Permission::find($id)->delete();
        $this->emit('item-deleted', 'Se eliminó el permiso con exito');
    }
    public function resetUI()
    {
        $this->permissionName = '';
        $this->permissionArea = "Elegir";
        $this->permissionDescripcion = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
}
