<?php

namespace Database\Seeders;

use App\Models\SucursalUser;
use Illuminate\Database\Seeder;

class SucursalUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SucursalUser::create([
            'user_id' => '1',
            'sucursal_id' => '1',
            'estado' => 'ACTIVO',
            'fecha_fin' => null,
        ]);
        SucursalUser::create([
            'user_id' => '2',
            'sucursal_id' => '1',
            'estado' => 'ACTIVO',
            'fecha_fin' => null,
        ]);
        SucursalUser::create([
            'user_id' => '3',
            'sucursal_id' => '1',
            'estado' => 'ACTIVO',
            'fecha_fin' => null,
        ]);
    }
}
