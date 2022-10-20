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
        $dd=Destino::create([
            'nombre'=>'Tienda',
            'observacion'=>'ninguna',
            'sucursal_id'=>'1'           
        ]);
        Permission::create([
            'name' => $dd->nombre.'_'.$dd->id,
            'areaspermissions_id' => '4',
            'descripcion' => 'Ingresar a Tienda',
            'guard_name' => 'web'
        ]);




        $ss = Destino::create([
            'nombre'=>'Deposito',
            'observacion'=>'ninguna',
            'sucursal_id'=>'1'           
        ]);
        Permission::create([
            'name' => $ss->nombre.'_'.$ss->id,
            'areaspermissions_id' => '4',
            'descripcion' => 'Ingresar a depósito',
            'guard_name' => 'web'
        ]);

       
        
        

        $pg=Destino::create([
            'nombre'=>'Almacen Devoluciones',
            'observacion'=>'ninguna',
            'sucursal_id'=>'1'           
        ]);
        Permission::create([
            'name' => $pg->nombre.'_'.$pg->id,
            'areaspermissions_id' => '4',
            'descripcion' => 'Ingresar a almacén devoluciones',
            'guard_name' => 'web'
        ]);

    }
}
