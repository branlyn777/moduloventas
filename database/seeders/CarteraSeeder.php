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
            'nombre' => 'Bancos',
            'saldocartera' => 0,
            'descripcion' => 'Cuenta Bancaria xxxx',
            'tipo' => 'digital',
            'telefonoNum' => null,
            'caja_id' => '1',
        ]);



        Cartera::create([
            'nombre' => 'Sistema 75006327',
            'descripcion' => 'Sistema tigo Money',
            'tipo' => 'Sistema',
            'telefonoNum' => 75006327,
            'caja_id' => '1',
        ]);

        Cartera::create([
            'nombre' => 'Telefono 75997054',
            'descripcion' => 'Telefono tigo money',
            'tipo' => 'Telefono',
            'telefonoNum' => 75997054,
            'caja_id' => '1',
        ]);

        Cartera::create([
            'nombre' => 'Telefono 62229011',
            'descripcion' => 'Telefono tigo money',
            'tipo' => 'Telefono',
            'telefonoNum' => '62229011',
            'caja_id' => '1',
        ]);

        Cartera::create([
            'nombre' => 'Sistema',
            'descripcion' => 'Sistema tigo Money',
            'tipo' => 'Sistema',
            'telefonoNum' => null,
            'caja_id' => '1',
        ]);

        Cartera::create([
            'nombre' => 'Telefono 76444657',
            'descripcion' => 'Telefono tigo money',
            'tipo' => 'Telefono',
            'telefonoNum' => '76444657',
            'caja_id' => '1',
        ]);
        Cartera::create([
            'nombre' => 'Sistema',
            'descripcion' => 'Sistema tigo Money',
            'tipo' => 'Sistema',
            'telefonoNum' => null,
            'caja_id' => '1',
        ]);
    
    }
}
