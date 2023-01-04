<?php

namespace Database\Seeders;

use App\Models\DetalleEntradaProductos;
use App\Models\IngresoProductos;
use App\Models\Lote;
use App\Models\Product;
use App\Models\ProductosDestino;
use Illuminate\Database\Seeder;

class ProductoDestino2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lista_de_productos = Product::all();

        foreach ($lista_de_productos as $p)
        {
            //Ingresando unidades del Producto
            $ProductoDestino = ProductosDestino::create([
                'product_id'=> $p->id,
                'destino_id' => rand(1,3),
                'stock' => 1000,
            ]);


            $stock_producto = $ProductoDestino->stock;

            //Determinando la cantidad de lotes que tendrá el producto
            for($i = 0; $i < 100; $i++)
            {

                //INGRESANDO LOTE

                //Registrando en tabla ingreso_productos
                $ip1 = IngresoProductos::create([
                    'destino' => $ProductoDestino->destino_id,
                    'user_id' => rand(1,3),
                    'concepto' => 'INICIAL',
                    'observacion' => 'Inventario inicial'
                ]);

                //Registrando en tabla lotes
                $lote1 = Lote::create([
                    'existencia' => 10,
                    'costo' => 50 + $i,
                    'pv_lote' => 60 + $i,
                    'status' => 'Activo',
                    'product_id' => $ProductoDestino->product_id
                ]);

                //Registrando en tabla detalle_entrada_productos
                DetalleEntradaProductos::create([
                    'product_id' => $ProductoDestino->product_id,
                    'cantidad' => $lote1->existencia,
                    'costo' => $lote1->costo,
                    'id_entrada' => $ip1->id,
                    'lote_id' => $lote1->id
                ]);



            }




            


        }
    }
    public function metodo()
    {

    }
}
