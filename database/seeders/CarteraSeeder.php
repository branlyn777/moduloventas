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
            'nombre' => 'Banco Central',
            'saldocartera' => 0,
            'descripcion' => 'Cuenta Bancaria',
            'tipo' => 'digital',
            'telefonoNum' => null,
            'caja_id' => '1',
        ]);
        Cartera::create([
            'nombre' => 'Efectivo',
            'saldocartera' => 0,
            'descripcion' => 'Dinero en Efectivo',
            'tipo' => 'efectivo',
            'telefonoNum' => null,
            'caja_id' => '2',
        ]);
        Cartera::create([
            'nombre' => 'Efectivo',
            'saldocartera' => 0,
            'descripcion' => 'Dinero en Efectivo',
            'tipo' => 'efectivo',
            'telefonoNum' => null,
            'caja_id' => '3',
        ]);
    }
}
