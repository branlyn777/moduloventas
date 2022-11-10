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
        $deposito = Destino::create([
            'nombre'=>'Deposito',
            'observacion'=>'ninguna',
            'sucursal_id'=>'1'           
        ]);
        Permission::create([
            'name' => $deposito->nombre . '_' . $deposito->id,
            'areaspermissions_id' => '2',
            'descripcion' => 'Ingresar a Depósito',
            'guard_name' => 'web'
        ]);
        

        $devoluciones = Destino::create([
            'nombre'=>'Almacen Devoluciones',
            'observacion'=>'ninguna',
            'sucursal_id'=>'1'           
        ]);
        Permission::create([
            'name' => $devoluciones->nombre . '_' . $devoluciones->id,
            'areaspermissions_id' => '2',
            'descripcion' => 'Ingresar a Almacén Devoluciones',
            'guard_name' => 'web'
        ]);
    }
}
