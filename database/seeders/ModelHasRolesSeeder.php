<?php

namespace Database\Seeders;

use App\Models\ModelHasRoles;
use Illuminate\Database\Seeder;

class ModelHasRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelHasRoles::create([     /* Soporte Sistema - ROL Sistema */
            'role_id' => 3, 
            'model_type' => 'App\Models\User',
            'model_id' => 1,
        ]);
        ModelHasRoles::create([     /* Edwin Choque Tinta - ROL Administrador */
            'role_id' => 1,
            'model_type' => 'App\Models\User',
            'model_id' => 2,
        ]);
        ModelHasRoles::create([     /* Rosa Ortiz - ROL Administrador */
            'role_id' => 1,
            'model_type' => 'App\Models\User',
            'model_id' => 3,
        ]);
        ModelHasRoles::create([     /* Armando Cahuaya - ROL Cajero */
            'role_id' => 2,
            'model_type' => 'App\Models\User',
            'model_id' => 4,
        ]);
        ModelHasRoles::create([     /* Yazmin Torres - ROL Cajero */
            'role_id' => 2,
            'model_type' => 'App\Models\User',
            'model_id' => 5,
        ]);
    }
}