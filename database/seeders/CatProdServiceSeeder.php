<?php

namespace Database\Seeders;

use App\Models\CatProdService;
use Illuminate\Database\Seeder;

class CatProdServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CatProdService::create([
            'nombre' => 'Accesorio',
            'estado' => 'Activo'
        ]);
        CatProdService::create([
            'nombre' => 'Computadora',
            'estado' => 'Activo'
        ]);
        CatProdService::create([
            'nombre' => 'Equipos de Sonido',
            'estado' => 'Activo'
        ]);
        CatProdService::create([
            'nombre' => 'Tablets',
            'estado' => 'Activo'
        ]);
        CatProdService::create([
            'nombre' => 'Electrodomésticos',
            'estado' => 'Activo'
        ]);
        CatProdService::create([
            'nombre' => 'Impresoras',
            'estado' => 'Activo'
        ]);
        CatProdService::create([
            'nombre' => 'Celular',
            'estado' => 'Activo'
        ]);
        CatProdService::create([
            'nombre' => 'Portatil',
            'estado' => 'Activo'
        ]);
    }
}
