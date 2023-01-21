<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ID = 1
        Category::create([
            'name' => 'Otros',
            'descripcion' => 'ninguna',
            'categoria_padre' => '0',
        ]);
        Category::create([
            'name' => 'Televisores',
            'descripcion' => 'ninguna',
            'categoria_padre' => '0',
        ]);
        Category::create([
            'name' => 'Teclados',
            'descripcion' => 'ninguna',
            'categoria_padre' => '0',
        ]);
        Category::create([
            'name' => 'Cables',
            'descripcion' => 'ninguna',
            'categoria_padre' => '0',
        ]);
        Category::create([
            'name' => 'Accesorios',
            'descripcion' => 'ninguna',
            'categoria_padre' => '0',
        ]);
        Category::create([
            'name' => 'Pantallas',
            'descripcion' => 'ninguna',
            'categoria_padre' => '0',
        ]);
     

    }
}
