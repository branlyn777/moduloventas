<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\ProcedenciaCliente;
use Illuminate\Database\Seeder;

class ProcedenciaClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProcedenciaCliente::create([
            'procedencia' => 'Facebook'
        ]);
        ProcedenciaCliente::create([
            'procedencia' => 'Bolantes'
        ]);
        ProcedenciaCliente::create([
            'procedencia' => 'Venta'
        ]);
    }
}
