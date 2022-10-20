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
            'name' => 'Nombre Sucursal',
            'adress' => 'Av. XXX',
            'telefono' => '0000000',
            'celular' => '0000000',
            'nit_id' => '111111',
            'company_id' => '1'
        ]);
    }
}
