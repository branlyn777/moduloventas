<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ID=1
        Product::create([
            'nombre' => 'Cable Usb C',
            'costo' => 50,
            'caracteristicas'=>'Nuevo',
            'codigo' => '251214233',
            'lote'=>'2102',
            'unidad'=>'pieza',
            'marca'=>'no definido',
            'garantia' => '2',
            'cantidad_minima' => '3',
            'industria'=>'China',
            'precio_venta' => 70,
            'image' => 'cable_usb_c.png',
            'category_id' => 1,
        ]);
        //ID=2
        Product::create([
            'nombre' => 'Mouse Inalambrico',
            'costo' => 100,
            'caracteristicas'=>'Usado',
            'codigo' => '251214235',
            'lote'=>'2122',
            'unidad'=>'pieza',
            'marca'=>'no definido',
            'garantia' => '2',
            'cantidad_minima' => '2',
            'industria'=>'China',
            'precio_venta' => 140,
            'image' => 'Mouse_Inalambrico.png',
            'category_id' => 1,
        ]);
    }
}
