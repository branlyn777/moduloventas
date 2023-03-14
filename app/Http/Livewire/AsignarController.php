<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Areaspermissions;
use Livewire\WithPagination;


class AsignarController extends Component
{
    use WithPagination;

    public $role, $componentName, $permisosSelected = [], $old_permissions = [];
    private $pagination = 20;

    public $permisosseleccionado;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->role = 'Elegir';
        $this->componentName = 'Asignar Permisos';

        $this->permisosseleccionado = "Todos";
    }

    public function render()
    {
        //Listar Todas las areas de los permisos
        $listaareas = Areaspermissions::select('id','name')
        ->get();
        
        //listar Todos los Permisos
        if($this->permisosseleccionado == "Todos")
        {
            $permisos = Permission::join('areaspermissions as a','a.id','permissions.areaspermissions_id')
            ->select('permissions.name', 'permissions.id','a.name as area','permissions.descripcion', DB::raw('0 as checked'))
            ->orderBy('permissions.name', 'asc')
            ->paginate($this->pagination);
        }
        else
        {
            $permisos = Permission::join('areaspermissions as a','a.id','permissions.areaspermissions_id')
            ->select('permissions.name', 'permissions.id','a.name as area','permissions.descripcion', DB::raw('0 as checked'))
            ->where("a.id", $this->permisosseleccionado)
            ->orderBy('permissions.name', 'asc')
            ->paginate($this->pagination);
        }
        
        //Listar Todos los Permisos por Area       
            //dd($this->permisosseleccionado);
        $permisosarea = Permission::join('areaspermissions as a','a.id','permissions.areaspermissions_id')
            ->select('permissions.name', 'permissions.id','a.name as area','permissions.descripcion', DB::raw('0 as checked2'))
            ->where('a.id',$this->permisosseleccionado)
            ->orderBy('permissions.name', 'asc')
            ->paginate($this->pagination);    


        if ($this->role != 'Elegir')
        {
            $list = Permission::join('role_has_permissions as rp', 'rp.permission_id', 'permissions.id')
                ->where('role_id', $this->role)->pluck('permissions.id')->toArray();
            $this->old_permissions = $list;
        }

        if ($this->role != 'Elegir')
        {
            
            foreach ($permisos as $permiso)
            {
                $role = Role::find($this->role);
                $tienePermiso = $role->hasPermissionTo($permiso->name);
                if ($tienePermiso)
                {
                    $permiso->checked = 1;
                }
            }

            foreach($permisosarea as $permiso2)
            {
                $role2 = Role::find($this->role);
                $tienePermiso2 = $role2->hasPermissionTo($permiso2->name);
                if ($tienePermiso2)
                {
                    $permiso2->checked2 = 1;
                }
            }
            
        }


        return view('livewire.asignar.component', [
            'roles' => Role::orderBy('name', 'asc')->get(),
            'permisos' => $permisos,
            'permisosarea' => $permisosarea,
            'listaareas' => $listaareas,
        ])->extends('layouts.theme.app')->section('content');
    }

    public $listeners = ['revokeall' => 'RemoveAll'];

    public function RemoveAll()
    {
        if ($this->role == 'Elegir') {
            $this->emit('sync-error', 'Selecciona un rol válido');
            return;
        }

        $role = Role::find($this->role);
        $role->syncPermissions([0]);
        $this->emit('removeall', "Se revocaron todos los permisos al rol $role->name");
    }

    public function SyncAll()
    {
        if ($this->role == 'Elegir') {
            $this->emit('sync-error', 'Selecciona un role válido');
            return;
        }

        $role = Role::find($this->role);
        $permisos = Permission::pluck('id')->toArray();
        $role->syncPermissions($permisos);

        $this->emit('syncall', "Se sincronizaron todos los permisos al rol $role->name");
    }
    public function SyncAll2()
    {
        if ($this->role == 'Elegir') {
            $this->emit('sync-error', 'Selecciona un role válido');
            return;
        }
        $role = Role::find($this->role);
        //dd($this->permisosseleccionado);
        //obtenemos todos los permisos sincronizados de un area
        $permisos = Permission::join('areaspermissions as a','a.id','permissions.areaspermissions_id')
        ->where('a.id',$this->permisosseleccionado)->pluck('permissions.id')->toArray();
        //lista de rol de permisos anteriores
        $list = Permission::join('role_has_permissions as rp', 'rp.permission_id', 'permissions.id')
        ->where('role_id', $this->role)->pluck('permissions.id')->toArray();
        $this->old_permissions = $list;
        //juntamos los 2 arrays obtenidos
        $permisosjuntados=[];
        $permisosjuntados=array_merge($permisos,$this->old_permissions);
        //dd($permisos,'br', $this->old_permissions);
        //dd($permisosjuntados);
        $role->syncPermissions($permisosjuntados);
        $this->emit('syncall', "Se sincronizaron todos los permisos al rol $role->name");
    }

    public function SyncPermiso($state, $permisoName)
    {
        if ($this->role != 'Elegir') {
            $roleName = Role::find($this->role);

            if ($state) {
                $roleName->givePermissionTo($permisoName);
                $this->emit('permi', 'Permiso asignado correctamente');
            } else {
                $roleName->revokePermissionTo($permisoName);
                $this->emit('permi', "Permiso eliminado correctamente");
            }
        } else {
            $this->redirect('asignar');
            $this->emit('sync-error', 'Seleccione un rol válido');
        }
    }
}