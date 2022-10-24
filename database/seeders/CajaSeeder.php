<?php

namespace Database\Seeders;

use App\Models\Caja;
use Illuminate\Database\Seeder;

class CajaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Caja::create([
            'nombre' => 'Caja General',
            'monto_base' => 100,
            'estado' => 'Cerrado',
            'estado' => 'Cerrado',
            'sucursal_id' => '1',
        ]);
        Caja::create([
            'nombre' => 'Caja Ejemplo',
            'monto_base' => 100,
            'estado' => 'Cerrado',
            'sucursal_id' => '1',
        ]);
    }
}
