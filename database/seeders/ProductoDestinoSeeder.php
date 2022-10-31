<?php

namespace Database\Seeders;

use App\Models\DetalleEntradaProductos;
use App\Models\IngresoProductos;
use App\Models\Lote;
use Illuminate\Database\Seeder;
use App\Models\ProductosDestino;
class ProductoDestinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Ingresando Producto 1
        ProductosDestino::create([
            'product_id'=> 1,
            'destino_id' => 1,
            'stock' => '110',
        ]);






        $ip1 = IngresoProductos::create([
            'destino' => 1,
            'user_id' => 1,
            'concepto' => 'INICIAL',
            'observacion' => 'Inventario inicial'
        ]);
        $lote1 = Lote::create([
            'existencia' => 50,
            'costo' => 60,
            'pv_lote' => 70,
            'status' => 'Activo',
            'product_id' => 1
        ]);
        DetalleEntradaProductos::create([
            'product_id' => 1,
            'cantidad' => 50,
            'costo' => 60,
            'id_entrada' => $ip1->id,
            'lote_id' => $lote1->id
        ]);


        $ip2 = IngresoProductos::create([
            'destino' => 1,
            'user_id' => 1,
            'concepto' => 'INGRESO',
            'observacion' => 'Segundo Lote'
        ]);
        $lote2 = Lote::create([
            'existencia' => 60,
            'costo' => 70,
            'pv_lote' => 80,
            'status' => 'Activo',
            'product_id' => 1
        ]);
        DetalleEntradaProductos::create([
            'product_id' => 1,
            'cantidad' => 60,
            'costo' => 70,
            'id_entrada' => $ip2->id,
            'lote_id' => $lote2->id
        ]);








    }
}
