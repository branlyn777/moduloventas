<?php

namespace Database\Seeders;

use App\Models\Cartera;
use Illuminate\Database\Seeder;

class CarteraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cartera::create([
            'nombre' => 'Banco',
            'descripcion' => 'Cuenta Bancaria',
            'tipo' => 'Banco',
            'telefonoNum' => null,
            'caja_id' => '1',
        ]);
        Cartera::create([
            'nombre' => 'Caja Física',
            'descripcion' => 'Dinero en Efectivo',
            'tipo' => 'CajaFisica',
            'telefonoNum' => null,
            'caja_id' => '2',
        ]);
    }
}
