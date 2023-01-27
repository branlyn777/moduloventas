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



        
    
    }
}
