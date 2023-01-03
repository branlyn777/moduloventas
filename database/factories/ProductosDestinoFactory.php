<?php

namespace Database\Factories;

use App\Models\Destino;
use App\Models\DetalleEntradaProductos;
use App\Models\IngresoProductos;
use App\Models\Lote;
use App\Models\Product;
use App\Models\ProductosDestino;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductosDestinoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id'=> rand(1,Product::all()->count()),
            'destino_id' => rand(1,Destino::all()->count()),
            'stock' => $this->faker->randomElement([10,20,30,40,50,60,70,80,90,100,200,300,400,500,600,700,800,900]),
        ];
    }
}
