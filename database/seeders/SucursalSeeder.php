<?php

namespace Database\Seeders;

use App\Models\Destino;
use App\Models\DestinoSucursal;
use App\Models\Permission;
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
        $sucursal = Sucursal::create([
            'name' => 'Sucursal Central',
            'adress' => 'Avenida América esq G René Moreno',
            'telefono' => '4240013',
            'celular' => '79771777',
            'nit_id' => '8796546',
            'company_id' => '1'
        ]);
        $sucursal->save();

        //Creando el destino que servira para realizar las ventas de la sucursal recien creada
        $destino = Destino::create([
            'nombre' => "Tienda Sucursal Central",
            'observacion' => "Destino donde se almacenarán todos los productos para la venta de la sucursal Sucursal Central",
            'sucursal_id' => $sucursal->id,
            'codigo_almacen' => 0
        ]);
        $destino->save();
        $destino->Update([
            'codigo_almacen'=>substr(strtoupper($destino->nombre),0,3) .'-'.str_pad($destino->id,4,0,STR_PAD_LEFT)
        ]);

        Permission::create([
            'name' => $destino->codigo_almacen,
            'guard_name' => 'web',
            'areaspermissions_id' => '2',
            'descripcion' => 'Ingresar al destino',
        ]);

        DestinoSucursal::create([
            'destino_id' => $destino->id,
            'sucursal_id' => $sucursal->id,
        ]);


    }
}
