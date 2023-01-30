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
        // Categorias de ingresos
        CarteraMovCategoria::create([
            'nombre' => "Ajuste de Efectivo Sobrante",
            'detalle' => "Para registrar Ajuste de caja por sobrante de efectivo",
            'tipo' => 'EGRESO',
            'subcategoria' => ""
        ]);
        CarteraMovCategoria::create([
            'nombre' => "Ajuste de Efectivo faltante",
            'detalle' => "Para registrar Ajuste de caja por faltante de efectivo",
            'tipo' => 'INGRESO',
            'subcategoria' => ""
        ]);


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
    }
}