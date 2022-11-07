<?php

namespace Database\Seeders;

use App\Models\Sucursal;
use Illuminate\Database\Seeder;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sucursal::create([
            'name' => 'Sucursal Central',
            'adress' => 'Avenida América casi esquina G René Moreno',
            'telefono' => '4240013',
            'celular' => '79771777',
            'nit_id' => '8796546',
            'company_id' => '1'
        ]);
    }
}
