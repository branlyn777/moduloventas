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
        //Ingresando 100 unidades del Producto Cable USB C
        ProductosDestino::create([
            'product_id'=> 1,
            'destino_id' => 1,
            'stock' => '10',
        ]);

        // Ingresando lote 1 del producto (Costo de 50 Bs)
        $ip1 = IngresoProductos::create([
            'destino' => 1,
            'user_id' => 1,
            'concepto' => 'INICIAL',
            'observacion' => 'Inventario inicial'
        ]);
        $lote1 = Lote::create([
            'existencia' => 3,
            'costo' => 50,
            'pv_lote' => 60,
            'status' => 'Activo',
            'product_id' => 1
        ]);
        DetalleEntradaProductos::create([
            'product_id' => 1,
            'cantidad' => 3,
            'costo' => 50,
            'id_entrada' => $ip1->id,
            'lote_id' => $lote1->id
        ]);

        // Ingresando lote 2 del producto (Costo de 55 Bs)
        $ip2 = IngresoProductos::create([
            'destino' => 1,
            'user_id' => 1,
            'concepto' => 'INGRESO',
            'observacion' => 'Segundo Lote'
        ]);
        $lote2 = Lote::create([
            'existencia' => 7,
            'costo' => 55,
            'pv_lote' => 65,
            'status' => 'Activo',
            'product_id' => 1
        ]);
        DetalleEntradaProductos::create([
            'product_id' => 1,
            'cantidad' => 7,
            'costo' => 55,
            'id_entrada' => $ip2->id,
            'lote_id' => $lote2->id
        ]);





















        
        //Ingresando 100 unidades del Producto Mouse Inalambrico
        ProductosDestino::create([
            'product_id'=> 2,
            'destino_id' => 1,
            'stock' => '10',
        ]);

        // Ingresando lote 1 del producto (Costo de 50 Bs)
        $mouse1 = IngresoProductos::create([
            'destino' => 1,
            'user_id' => 1,
            'concepto' => 'INICIAL',
            'observacion' => 'Inventario inicial'
        ]);
        $mouse_lote1 = Lote::create([
            'existencia' => 5,
            'costo' => 100,
            'pv_lote' => 110,
            'status' => 'Activo',
            'product_id' => 2
        ]);
        DetalleEntradaProductos::create([
            'product_id' => 2,
            'cantidad' => 5,
            'costo' => 100,
            'id_entrada' => $mouse1->id,
            'lote_id' => $mouse_lote1->id
        ]);

        // Ingresando lote 2 del producto (Costo de 55 Bs)
        $mouse2 = IngresoProductos::create([
            'destino' => 1,
            'user_id' => 1,
            'concepto' => 'INGRESO',
            'observacion' => 'Segundo Lote'
        ]);
        $mouse_lote2 = Lote::create([
            'existencia' => 5,
            'costo' => 90,
            'pv_lote' => 105,
            'status' => 'Activo',
            'product_id' => 2
        ]);
        DetalleEntradaProductos::create([
            'product_id' => 2,
            'cantidad' => 5,
            'costo' => 90,
            'id_entrada' => $mouse2->id,
            'lote_id' => $mouse_lote2->id
        ]);
    }
}
