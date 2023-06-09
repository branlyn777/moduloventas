<?php

namespace Database\Seeders;

use App\Models\DetalleEntradaProductos;
use App\Models\IngresoProductos;
use App\Models\Lote;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductosDestino;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::create([
            'nombre' => 'Tarjeta Tigo',
            'caracteristicas'=>'Recarga de 10 Bs',
            'codigo' => '251214233',
            'unidad'=>'pieza',
            'marca'=>'no definido',
            'garantia' => '2',
            'cantidad_minima' => '3',
            'industria'=>'China',
            'image' => 'tigo.png',
            'category_id' => 2,
        ]);



        $lote = Lote::create([
            'existencia' => '5',
            'costo' => 9.7,
            'pv_lote'=>'10',
            'product_id' => $product->id
        ]);
        $entrada = IngresoProductos::create([
            'destino' => 1,
            'user_id' => 1,
            'concepto' => "INICIAL",
            'observacion' => "Producto Prueba"
        ]);

        DetalleEntradaProductos::create([
            "product_id" => $product->id,
            "cantidad" => 5,
            "costo" => 9.7,
            "id_entrada" => $entrada->id,
            "lote_id" => $lote->id,
        ]);


        $lote2 = Lote::create([
            'existencia' => '5',
            'costo' => 9.8,
            'pv_lote'=>'10',
            'product_id' => $product->id
        ]);
        $entrada2 = IngresoProductos::create([
            'destino' => 1,
            'user_id' => 1,
            'concepto' => "INICIAL",
            'observacion' => "Producto Prueba"
        ]);
        DetalleEntradaProductos::create([
            "product_id" => $product->id,
            "cantidad" => 5,
            "costo" => 9.8,
            "id_entrada" => $entrada2->id,
            "lote_id" => $lote2->id,
        ]);


        ProductosDestino::create([
            'product_id' => $product->id,
            'destino_id' => 1,
            'stock' => 10,
        ]);

    }
}
