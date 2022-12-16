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
            'precio_venta' => 60,
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
            'precio_venta' => 110,
            'image' => 'Mouse_Inalambrico.png',
            'category_id' => 1,
        ]);
        //ID=3
        Product::create([
            'nombre' => 'Teclado Nord',
            'costo' => 350,
            'caracteristicas'=>'Nuevo',
            'codigo' => '251214236',
            'lote'=>'2122',
            'unidad'=>'pieza',
            'marca'=>'Studiologic',
            'garantia' => '2',
            'cantidad_minima' => '2',
            'industria'=>'China',
            'precio_venta' => 380,
            'image' => 'Mouse_Inalambrico.png',
            'category_id' => 1,
        ]);
        Product::create([
            'nombre' => 'Módem',
            'costo' => 180,
            'caracteristicas'=>'Nuevo',
            'codigo' => '251214237',
            'lote'=>'2122',
            'unidad'=>'pieza',
            'marca'=>'Explore',
            'garantia' => '2',
            'cantidad_minima' => '2',
            'industria'=>'Japon',
            'precio_venta' => 200,
            'image' => 'Mouse_Inalambrico.png',
            'category_id' => 1,
        ]);
        Product::create([
            'nombre' => 'Tinta',
            'costo' => 40,
            'caracteristicas'=>'Nuevo',
            'codigo' => '251214238',
            'lote'=>'2122',
            'unidad'=>'pieza',
            'marca'=>'Havi',
            'garantia' => '2',
            'cantidad_minima' => '2',
            'industria'=>'Estados Unidos',
            'precio_venta' => 65,
            'image' => 'Mouse_Inalambrico.png',
            'category_id' => 1,
        ]);
        Product::create([
            'nombre' => 'Case',
            'costo' => 35,
            'caracteristicas'=>'Nuevo',
            'codigo' => '251214239',
            'lote'=>'2122',
            'unidad'=>'pieza',
            'marca'=>'Xiaomi',
            'garantia' => '2',
            'cantidad_minima' => '2',
            'industria'=>'Japon',
            'precio_venta' => 50,
            'image' => 'Mouse_Inalambrico.png',
            'category_id' => 1,
        ]);
        Product::create([
            'nombre' => 'Tinta 544 Black',
            'costo' => 55,
            'caracteristicas'=>'Nuevo',
            'codigo' => '251214240',
            'lote'=>'2122',
            'unidad'=>'pieza',
            'marca'=>'Epson',
            'garantia' => '2',
            'cantidad_minima' => '2',
            'industria'=>'Australia',
            'precio_venta' => 78,
            'image' => 'Mouse_Inalambrico.png',
            'category_id' => 1,
        ]);
        Product::create([
            'nombre' => 'Cable optico',
            'costo' => 36,
            'caracteristicas'=>'Nuevo',
            'codigo' => '251214241',
            'lote'=>'2122',
            'unidad'=>'pieza',
            'marca'=>'High Speed',
            'garantia' => '2',
            'cantidad_minima' => '2',
            'industria'=>'España',
            'precio_venta' => 53,
            'image' => 'Mouse_Inalambrico.png',
            'category_id' => 1,
        ]);
        Product::create([
            'nombre' => 'Cable Otg',
            'costo' => 10,
            'caracteristicas'=>'Nuevo',
            'codigo' => '251214242',
            'lote'=>'2122',
            'unidad'=>'pieza',
            'marca'=>'Huawei',
            'garantia' => '2',
            'cantidad_minima' => '2',
            'industria'=>'Estados Unidos',
            'precio_venta' => 25,
            'image' => 'Mouse_Inalambrico.png',
            'category_id' => 1,
        ]);
        Product::create([
            'nombre' => 'Cable Hdmi',
            'costo' => 35,
            'caracteristicas'=>'Nuevo',
            'codigo' => '251214243',
            'lote'=>'2122',
            'unidad'=>'pieza',
            'marca'=>'Samsumg',
            'garantia' => '2',
            'cantidad_minima' => '2',
            'industria'=>'Estados Unidos',
            'precio_venta' => 50,
            'image' => 'Mouse_Inalambrico.png',
            'category_id' => 1,
        ]);
        Product::create([
            'nombre' => 'Pendrevi Usb',
            'costo' => 65,
            'caracteristicas'=>'Nuevo',
            'codigo' => '251214244',
            'lote'=>'2122',
            'unidad'=>'pieza',
            'marca'=>'Huawei',
            'garantia' => '2',
            'cantidad_minima' => '2',
            'industria'=>'Estados Unidos',
            'precio_venta' => 85,
            'image' => 'Mouse_Inalambrico.png',
            'category_id' => 1,
        ]);
    }
}
