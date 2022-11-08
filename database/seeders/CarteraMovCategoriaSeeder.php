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
        CarteraMovCategoria::create([
            'nombre' => "Ingreso General",
            'detalle' => "Para registrar ingresos generales",
            'tipo' => 'INGRESO',
            'subcategoria' => ""
        ]);
        CarteraMovCategoria::create([
            'nombre' => "Ajuste",
            'detalle' => "Para ajustar algun egreso",
            'tipo' => 'INGRESO',
            'subcategoria' => ""
        ]);


        //Categorias de ingresos
        CarteraMovCategoria::create([
            'nombre' => "Egreso General",
            'detalle' => "Para registrar egresos generales",
            'tipo' => 'EGRESO',
            'subcategoria' => ""
        ]);
        CarteraMovCategoria::create([
            'nombre' => "Ajuste",
            'detalle' => "Para ajustar algun ingreso",
            'tipo' => 'EGRESO',
            'subcategoria' => ""
        ]);
    }
}
