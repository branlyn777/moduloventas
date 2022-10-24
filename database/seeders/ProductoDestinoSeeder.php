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
            'stock' => '50',
        ]);
        $ip = IngresoProductos::create([
            'destino' => 1,
            'user_id' => 1,
            'concepto' => 'INICIAL',
            'observacion' => 'Inventario inicial'
        ]);
        $lote = Lote::create([
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
            'id_entrada' => $ip->id,
            'lote_id' => $lote->id
        ]);
    }
}
