<?php

namespace Database\Seeders;

use App\Models\Destino;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class DestinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $deposito = Destino::create([
        //     'nombre'=>'Deposito',
        //     'observacion'=>'ninguna',
        //     'sucursal_id'=>'1',          
        //     'codigo_almacen' => 0
        // ]);
        // $deposito->save();
        // $deposito->Update([
        //     'codigo_almacen'=>substr(strtoupper($deposito->nombre),0,3) .'-'.str_pad($deposito->id,4,0,STR_PAD_LEFT)
        // ]);


        // Permission::create([
        //     'name' => $deposito->codigo_almacen,
        //     'areaspermissions_id' => '2',
        //     'descripcion' => 'Ingresar a Depósito',
        //     'guard_name' => 'web'
        // ]);
        

    }
}
