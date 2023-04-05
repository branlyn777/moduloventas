<?php

namespace Database\Seeders;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\CarteraMov;
use App\Models\Movimiento;
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
            'monto_base' => 0,
            'estado' => 'Cerrado',
            'sucursal_id' => '1',
        ]);
        $caja= Caja::create([
            'nombre' => 'Caja 1',
            'monto_base' => 100,
            'estado' => 'Cerrado',
            'sucursal_id' => '1',
        ]);
        Cartera::create([
            'nombre' => 'Efectivo-'.$caja->nombre,
            'saldocartera' => '0',
            'descripcion' => 'Cuenta de dinero en efectivo',
            'tipo' => 'efectivo',
            'estado' => 'ACTIVO',
            'caja_id' => $caja->id
        ]);

        //Aperturando Caja
        $movimiento = Movimiento::create([
            'type' => 'APERTURA',
            'status' => 'ACTIVO',
            'import' => 0,
            'user_id' => 1
        ]);
        CarteraMov::create([
            'type' => 'APERTURA',
            'tipoDeMovimiento' => 'CORTE',
            'comentario' => 'Primera Apertura',
            'cartera_id' => 1,
            'movimiento_id' => $movimiento->id,
        ]);
        $caja = Caja::find(1);
        $caja->update([
            'estado' => 'Abierto',
        ]);
        $caja->save();



        // $caja=Caja::create([
        //     'nombre' => 'Caja 2',
        //     'monto_base' => 100,
        //     'estado' => 'Cerrado',
        //     'sucursal_id' => '1',
        // ]);
        // Cartera::create([
        //     'nombre' => 'Efectivo-'.$caja->nombre,
        //     'saldocartera' => '0',
        //     'descripcion' => 'Cuenta de dinero en efectivo',
        //     'tipo' => 'efectivo',
        //     'estado' => 'ACTIVO',
        //     'caja_id' => $caja->id
        // ]);
    }
}
