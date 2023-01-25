<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Administrador',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'Cajero',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'Sistema',
            'guard_name' => 'web'
        ]);
    }
}
