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
        for ($i=1; $i < 6; $i++)
        { 
            SucursalUser::create([
                'user_id' => $i,
                'sucursal_id' => '1',
                'estado' => 'ACTIVO',
                'fecha_fin' => null,
            ]);
        }
    }
}
