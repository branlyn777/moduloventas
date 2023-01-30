<?php

namespace Database\Seeders;

use App\Models\Cartera;
use App\Models\CarteraMovCategoria;
use Illuminate\Database\Seeder;

class CarteraMovCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Categorias de ingresos
        // CarteraMovCategoria::create([
        //     'nombre' => "Ingreso por Inversión",
        //     'detalle' => "Para registrar ingresos generales",
        //     'tipo' => 'INGRESO',
        //     'subcategoria' => ""
        // ]);
        // CarteraMovCategoria::create([
        //     'nombre' => "Ajuste Ingreso",
        //     'detalle' => "Para ajustar algun egreso",
        //     'tipo' => 'INGRESO',
        //     'subcategoria' => ""
        // ]);


        // //Categorias de ingresos
        // CarteraMovCategoria::create([
        //     'nombre' => "Adelanto de Sueldos",
        //     'detalle' => "Para registrar adelanto de sueldos de los empleados",
        //     'tipo' => 'EGRESO',
        //     'subcategoria' => ""
        // ]);
        // CarteraMovCategoria::create([
        //     'nombre' => "Ajuste Egreso",
        //     'detalle' => "Para ajustar algun ingreso",
        //     'tipo' => 'EGRESO',
        //     'subcategoria' => ""
        // ]);


        //Categorias de ingresos TigoMoney
        CarteraMovCategoria::create([
            'nombre' => "Ingreso por TigoMoney",
            'detalle' => "Para registrar ingresos TigoMoney",
            'tipo' => 'INGRESO',
            'subcategoria' => ""
        ]);
        //Categorias de egresos TigoMoney
        CarteraMovCategoria::create([
            'nombre' => "Egreso por TigoMoney",
            'detalle' => "Para registrar egresos TigoMoney",
            'tipo' => 'EGRESO',
            'subcategoria' => ""
        ]);



    }
}