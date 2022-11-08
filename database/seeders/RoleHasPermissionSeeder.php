<?php

namespace Database\Seeders;

use App\Http\Livewire\PermisosController;
use App\Models\Permission;
use App\Models\RoleHasPermissions;
use Illuminate\Database\Seeder;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 1; $x <= 29; $x++) {  /* TODOS LOS PERMISOS PARA EL ROL ADMINISTRADOR */
            RoleHasPermissions::create([
                'permission_id' => $x,
                'role_id' => 1
            ]);
        }

    }

}
