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
        Category::create([
            'name' => 'No definido',
            'descripcion' => 'ninguna',
            'categoria_padre' => '0',
        ]);
        Category::create([
            'name' => 'Varios',
            'descripcion' => 'ninguna',
            'categoria_padre' => '0',
        ]);
    }
}
